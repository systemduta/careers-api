<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Recruitment;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('recruitments')
                ->join('participants', 'recruitments.id', '=', 'participants.recruitment_id')
                ->join('files','participants.id', '=', 'files.participant_id')
                ->select('recruitments.name as position', 'participants.*','files.*')
                ->where('category_id', 2)
                ->orderBy('recruitments.id', 'DESC')
                ->get();
        return response()->json(['data' => $data]);
    }

    public function recruitment()
    {
        $data = DB::table('recruitments')
                ->join('participants', 'recruitments.id', '=', 'participants.recruitment_id')
                ->join('files','participants.id', '=', 'files.participant_id')
                ->select('recruitments.name as position', 'participants.*','files.*')
                ->where('category_id', 1)
                ->orderBy('recruitments.id', 'DESC')
                ->get();

        return response()->json(['data' => $data]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Participant::with(['recruitment','file'])->findOrFail($id);
        return response()->json(['message' => 'Menampilkan File Participant', 'data' => $data]);
    }
    // public function downloadCv($id, $idFile)
    // {
    //     // $data = Participant::where('id', $id)->first();
    //     // $file = File::where('participant_id', $data->id)->first();
    //     // $file = File::where('id', $idFile)->first();
    //     $url = Storage::url($id, $idFile);
    //     $download=DB::table('files')->get();
    //     return Storage::download($url);
    //     // $pathToFile = storage_path('public/cv' . $file->cv);
    //     // $filePath = public_path('cv');
    // 	// $headers = ['Content-Type: application/pdf'];
    // 	// $fileName = time().'.jpg';
    //     // return response()->download(public_path('FOTO'), 'cv file');

    //     // return response()->download($id);
    // }

    public function downloadCv($id)
    {
        $data = File::where('participant_id',$id)->first();
        return response()->download(public_path(
                'cv/'.$data->cv,
            ),
            'File CV'
        );
    }

    public function downloadFT(Request $request, $id)
    {
        $data = File::where('participant_id',$id)->first();
        // $headers = ['Content-Type: application/jpg'];
        return response()->download(public_path(
                'fortofolio/'.$data->fortofolio,
            ),
            'File Fortofolio'
        );
    }

    public function downloadFoto($id)
    {
        $data = File::where('participant_id',$id)->first();
        return response()->download(public_path(
                'foto/'.$data->foto,
            ),
            'File FOTO'
        );
    }

    public function downloadCFT($id)
    {
        $data = File::where('participant_id',$id)->first();
        return response()->download(public_path(
                'certificate/'.$data->cv,
            ),
            'File CERTIFICATE'
        );
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
    public function updateStatus(Request $request, $id)
    {
        // $data = Participant::with(['recruitment', 'file'])->where('id', $id)->get();
        $validate = Validator::make($request->all(), [
            'status'          => 'required',
        ]);
        if($validate->fails())
        {
            $response['status'] = false;
            $response['message'] = 'Status Gagal Diubah';
            $response['error'] = $validate->errors();
            return response()->json(['response'=> $response], 401);
        }

        Participant::with(['recruitment', 'file'])->where('id', $id)->update([
                "status"   => $request->status,
            ]);
        return response()->json(['message' => 'Status Berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
