<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Participant;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function lowongan()
    {
        $lowongan = Recruitment::all();
        return response()->json(['data' => $lowongan]);
    }

    // public function recruitment()
    // {
    //     $data = Recruitment::where('category_id')->get();
    //     return response()->json(['data' => $data]);
    // }

    public function show($id)
    {
        $lowongan = Recruitment::where('id', $id)->first();
        return response()->json(['message' => 'Masuk Detail Lowongan', 'data' => $lowongan]);
    }

    public function daftar(Request $request, $id)
    {
        $lowongan = Recruitment::where('id', $id)->first();
        $validate = Validator::make($request->all(), [
            'name'          => 'required|string',
            'gender'        => 'required',
            'place_birth'   => 'required',
            'date_birth'    => 'required|date',
            'email'         => 'required|email|string',
            'age'           => 'required',
            'address'       => 'required',
            'city'          => 'required',
            'education'     => 'required',
            'major'         => 'required',
            'univercity'    => 'required',
            // 'media_social'  => 'required',
            // 'information'   => 'required',
            // 'cv'            => 'required',
            // 'portofolio'    => 'required',
            // 'foto'          => 'required',
        ]);
        if($validate->fails())
            {
                $response['status'] = false;
                $response['message'] = 'Lowongan Gagal Dilamar';
                $response['error'] = $validate->errors();
                return response()->json('response', 401);
            }

        $lamar = Participant::where('recruitment_id', $lowongan->id)->first();

        $peserta_lamar                  = new Participant();
        $peserta_lamar->recruitment_id  = $lowongan->id;
        // $peserta_lamar->category_id     = $lowongan->category_id;
        $peserta_lamar->name            = $request->name;
        $peserta_lamar->gender          = $request->gender;
        $peserta_lamar->place_birth     = $request->place_birth;
        // $peserta_lamar->date_birth      = date('Y-m-d', ($request->date_birth));
        $peserta_lamar->date_birth      = $request->date_birth;
        $peserta_lamar->email           = $request->email;
        $peserta_lamar->age             = $request->age;
        $peserta_lamar->address         = $request->address;
        $peserta_lamar->city            = $request->city;
        $peserta_lamar->education       = $request->education;
        $peserta_lamar->major           = $request->major;
        $peserta_lamar->univercity      = $request->univercity;
        $peserta_lamar->media_social    = $request->media_social;
        $peserta_lamar->information     = $request->information;
        $peserta_lamar->save();

        $file_foto  = $request->foto;
        $filefoto   = $file_foto->getClientOriginalExtension();
        $nama_foto = date('YmdHis').".$filefoto";
        $upload_path = 'profile';
        $file_foto->move($upload_path, $nama_foto);

        $file_cv    = $request->cv;
        $filecv   = $file_cv->getClientOriginalExtension();
        $nama_cv = date('YmdHis').".$filecv";
        $upload_cv = 'cv';
        $file_cv->move($upload_cv, $nama_foto);;

        $file_portofolio       = $request->fortofolio;
        $fileportofolio        = $file_portofolio->getClientOriginalExtension();
        $nama_portofolio = date('YmdHis').".$fileportofolio";
        $upload_portofolio = 'resume';
        $file_portofolio->move($upload_portofolio, $nama_portofolio);

        $file_certivicate      = $request->certificate;
        $certivicate           = $file_certivicate->getClientOriginalExtension();
        $nama_certivicate      = date('YmdHis').".$certivicate";
        $upload_certivicate    = 'certivicate';
        $file_certivicate->move(public_path($upload_certivicate, $file_certivicate));

        $peserta                  = new File();
        $peserta->participant_id  = $peserta_lamar->id;
        $peserta->cv              = $nama_cv;
        $peserta->fortofolio      = $nama_portofolio;
        $peserta->certificate     = $nama_certivicate;
        $peserta->foto            = $nama_foto;
        $peserta->save();

        return response()->json(['message' => 'Berkas Berhasil Ditambahkan']);
    }
}
