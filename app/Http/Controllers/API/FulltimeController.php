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
            'nik'               => $request->name,
            'religion'          => $request->name,
            'status'            => $request->name,
            'blood'             => $request->name,
            'gaji'              => $request->name,
            'pt'                => $request->name,
            'jurusan'           => $request->name,
            'years'             => $request->name,
            'ipk'               => $request->name,
            'cv'                => $request->name,
            'portofolio'        => $request->name,
            'sertificate'       => $request->name,
            'foto'              => $request->name,
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
