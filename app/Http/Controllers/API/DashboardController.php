<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Participant;
use App\Models\Recruitment;
use Illuminate\Support\Facades\Auth;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        // $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function index()
    {
        $data = Recruitment::all()->count();
        $internship = DB::table('participants')
                    ->join('recruitments', 'recruitments.id', '=', 'participants.recruitment_id')
                    ->where('recruitments.category_id', '=', 2)
                    ->count();
        $fulltime = DB::table('participants')
                ->join('recruitments', 'recruitments.id', '=', 'participants.recruitment_id')
                ->where('recruitments.category_id', '=', 1)
                ->count();

        return response()->json(['message' => 'Jumlah Lowongan', 'data' => $data,
                                'pesan'=> 'Jumlah Participant Internship', 'internship' => $internship,
                                'index'=> 'Jumlah Participant Fulltime', 'fulltime' => $fulltime]);
        // }
    }
    // public function recruitment()
    // {

    //         $data = DB::table('participants')
    //                 ->join('recruitments', 'recruitments.id', '=', 'participants.recruitment_id')
    //                 ->where('recruitments.category_id', '=', 1)
    //                 ->count();

    //         return response()->json(['message' => 'Jumlah Participant', 'data' => $data]);
    // }
}
