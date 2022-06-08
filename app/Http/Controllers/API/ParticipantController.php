<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Recruitment;
use App\Models\File;
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

        // $deliveries = Delivery::with('order.product')
        //         ->whereHas('order', function($query) use ($customerID) {
        //                     $query->whereUserId($customerID);
        //                 })
        //         ->orderBy('date')
        //         ->get();

        // $data = Participant::with(['recruitment', 'file'])
        //         ->when('recruitment', function($q) use ($r) {
        //             $q->where($r);
        //         })
        //         ->get();
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
    public function downloadCv()
    {
        // $data = Participant::where('id', $id)->first();
        $filePath = public_path('cv');
    	$headers = ['Content-Type: application/jpg'];
    	$fileName = time().'.jpg';
        // return response()->download(public_path('FOTO'), 'cv file');
        return response()->download($filePath, $fileName, $headers);
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
