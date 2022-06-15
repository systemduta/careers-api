<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Recruitment;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Storage;

class RecruitmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        // $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Recruitment::with(['category','participant'])->orderBy('id','DESC')->get();

        if ($data > 0 )
        return response()->json(['message' => 'Jobs Tidak bisa di hapus Karena ada Data Pelamar'],500);

        for($i=0; $i<count($data); $i++)
        {
            $lowongan = Carbon::parse($data[$i]->date);
            if($lowongan->isPast())
            {
                $data[$i]->status=0;
            }else{
                $data[$i]->status=1;
            }
        }
        return response()->json(['success' => true, 'message' => 'List Semua Data', 'data' => $data], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'          => 'required',
            'jobdesc'       => 'required',
            'qualification' => 'required',
            'image'         => 'image:jpeg,png,jpg|max:2048'
        ]);
        if($validate->fails())
        {
            $response['status'] = false;
            $response['message'] = 'Lowongan Gagal Ditambahkan';
            $response['error'] = $validate->errors();

            return response()->json($validate->errors(), 401);
        }

        if($request->hasFile('image')){
            // ada file yang diupload
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileimageSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->move(public_path('images'),$fileimageSimpan);

        }else{
            // tidak ada file yang diupload
            $fileimageSimpan =  null;
        }

        $lowongan = new Recruitment();
        // dd($lowongan);
        $lowongan->category_id      = $request->category_id;
        $lowongan->name             = $request->name;
        $lowongan->jobdesc          = $request->jobdesc;
        $lowongan->qualification    = $request->qualification;
        $lowongan->address          = $request->address;
        $lowongan->type             = $request->type;
        $lowongan->image            = $fileimageSimpan;
        $lowongan->date             = $request->date;
        $lowongan->save();

        // $lowongan['status'] = true;
        // $lowongan['message'] = 'Lowongan Berhasil Ditambahkan';
        return response()->json(['message' => 'Data Berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lowongan = Recruitment::where('id', $id)->first();
        $peserta = Participant::where('recruitment_id', $lowongan->id)->get();
        return response()->json(['message' => 'Data Peserta', 'data' => $peserta]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name'          => 'required',
            'jobdesc'       => 'required',
            'qualification' => 'required',
            'image'         => 'mimes:jpeg,png,jpg|max:2048'
        ]);
        if($validate->fails())
        {
            return response()->json($validate->errors(), 401);
        }

        $jobs = Recruitment::where('id',$id)->first();

        if($request->hasFile('image')){
            // ada file yang diupload
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileimageSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->move(public_path('images'),$fileimageSimpan);

        }else{
            // tidak ada file yang diupload
            $fileimageSimpan =  $jobs->image;
        }

         Recruitment::where('id', $id)->update([
                "category_id"   => $request->category_id,
                "name"          => $request->name,
                "jobdesc"       => $request->jobdesc,
                "qualification" => $request->qualification,
                "address"       => $request->address,
                "type"          => $request->type,
                "image"         => $fileimageSimpan,
                "date"          => $request->date
            ]);
        return response()->json(['message' => 'Data Berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lowongan = Recruitment::findOrFail($id);

        $lowongan->delete();

        return response()->json(['message' => 'Lowongan berhasil dihapus']);
    }
}
