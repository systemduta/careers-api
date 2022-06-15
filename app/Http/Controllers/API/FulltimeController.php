<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fulltime;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FulltimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Fulltime::with(['recruitment','keluarga','prestasi'])
            ->orderBy('id','DESC')
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
    public function store(Request $request, $id)
    {
        $recruitment = Recruitment::where('id',$id)->first();

        $validator = Validator::make($request->all(),[
            'name'      => 'required',
            'email'     => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        if($request->hasFile('cv')){
            // ada file yang diupload
            $filenameWithExt = $request->file('cv')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cv')->getClientOriginalExtension();
            $filecvSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cv')->move(public_path('cv'),$filecvSimpan);

        }else{
            // tidak ada file yang diupload
            $filecvSimpan =  null;
        }

        if($request->hasFile('fortofolio')){
            // ada file yang diupload
            $filenameWithExt = $request->file('fortofolio')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('fortofolio')->getClientOriginalExtension();
            $filefortofolioSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('fortofolio')->move(public_path('fortofolio'),$filefortofolioSimpan);

        }else{
            // tidak ada file yang diupload
            $filefortofolioSimpan =  null;
        }

        if($request->hasFile('certificate')){
            // ada file yang diupload
            $filenameWithExt = $request->file('certificate')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('certificate')->getClientOriginalExtension();
            $filecertificateSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('certificate')->move(public_path('certificate'),$filecertificateSimpan);

        }else{
            // tidak ada file yang diupload
            $filecertificateSimpan =  null;
        }

        if($request->hasFile('foto')){
            // ada file yang diupload
            $filenameWithExt = $request->file('foto')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $filefotoSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('foto')->move(public_path('foto'),$filefotoSimpan);

        }else{
            // tidak ada file yang diupload
            $filefotoSimpan =  null;
        }

        $dataId = Fulltime::create([
            'recruitment_id'    => $recruitment->id,
            'name'              => $request->name,
            'place_birth'       => $request->place_birth,
            'date_birth'        => $request->date_birth,
            'gender'            => $request->gender,
            'email'             => $request->email,
            'age'               => $request->age,
            'address_domicili'  => $request->address_domicili,
            'address_ktp'       => $request->address_ktp,
            'nik'               => $request->nik,
            'religion'          => $request->region,
            'status'            => $request->status,
            'blood'             => $request->blood,
            'gaji'              => $request->gaji,
            'pt'                => $request->pt,
            'jurusan'           => $request->jurusan,
            'years'             => $request->years,
            'ipk'               => $request->ipk,
            'cv'                => $filecvSimpan,
            'portofolio'        => $filefortofolioSimpan,
            'sertificate'       => $filecertificateSimpan,
            'foto'              => $filefotoSimpan,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
