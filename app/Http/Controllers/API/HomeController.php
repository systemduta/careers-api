<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Participant;
use App\Models\Recruitment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function filter(Request $request) {
        $name = $request->name;
        $category_id = $request->category_id;

        $filteredVacancies = DB::table('recruitments')
            ->select('*')
            ->where('name', 'like', "%$name%")
            ->where('category_id', 'like', "%$category_id%")
            ->get();

        if(!count($filteredVacancies)){
            return response()->json(['data' => 'Data yang dicari tidak ada'], 404);
        }

        return response()->json(['data' => $filteredVacancies ]);
    }
    // public function search($data)
    // {
    //     $lowongan =   Recruitment::where('name', 'LIKE', '%' . $data . '%')
    //                 ->orWhere('category_id', 'LIKE', '%' . $data . '%')
    //                 ->orWhere('jobdesc', 'LIKE', '%' . $data . '%')
    //                 ->orWhere('qualification', 'LIKE', '%' . $data . '%')
    //                 ->orWhere('address', 'LIKE', '%' . $data . '%')
    //                 ->get();
    //                 if(count($lowongan)){
    //                     return response()->json(['data' => $lowongan ]);
    //                 }
    //                 else
    //                 {
    //                     return response()->json(['data' => 'Data yang dicari tidak ada'], 404);
    //                 }
    // }
    public function lowongan()
    {
        $data = Recruitment::where('date', date('Y-m-d H:i:s'))-> orderBy('id','DESC');

        if (Carbon::now() >= $data) {
            return response()->json(['data' => $data]);
        }else {
            return response()->json(['message','Data tidak ditemukan']);
        }
    }

    // public function recruitment()
    // {
    //     $data = Recruitment::where('category_id')->get();
    //     return response()->json(['data' => $data]);
    // }

    public function show($id)
    {
        $lowongan = Recruitment::where('id', $id)->first();
        if($lowongan == false)
        {
            $response['status'] = false;
            $response['message'] = 'Lowongan tidak tersedia';
            // $response['error'] = $validate->errors();

            return response()->json($response, 404);
        }else{
            return response()->json(['message' => 'Masuk Detail Lowongan', 'data' => $lowongan]);
        }
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
            'cv'            => 'required|mimes:png,jpg,jpeg,pdf|max:2048',
            'fortofolio'    => 'required|mimes:png,jpg,jpeg,pdf|max:2048',
            'foto'          => 'required|mimes:png,jpg,jpeg,pdf|max:2048',
        ]);
        if($validate->fails())
            {
                return response()->json(['response' => 'Lowongan Gagal Dilamar', $validate->errors()], 400);
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


        $peserta                  = new File();
        $peserta->participant_id  = $peserta_lamar->id;
        $peserta->cv              = $filecvSimpan;
        $peserta->fortofolio      = $filefortofolioSimpan;
        $peserta->certificate     = $filecertificateSimpan;
        $peserta->foto            = $filefotoSimpan;
        $peserta->save();

        return response()->json(['message' => 'Berkas Berhasil Ditambahkan']);
    }
}
