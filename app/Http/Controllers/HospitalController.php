<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data =  Hospital::with('bloodDonationRequests')->get();

        if($request->wantsJson()){
            return response()->json(['data' => $data]);
        }
        return response()->view('cms.blood_donation.hospital.index',compact('data'));
    }


    public function create(Request $request) {
        
        return response()->view('cms.blood_donation.hospital.create');
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'city' => 'required',
            'location' => 'required',
        ]);
    
        $hospital =  Hospital::create($data);
        if($request->wantsJson()){
            return response()->json(['data' => $hospital], 201);
        }
        return redirect()->route('hospital.index',compact('data'));
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        //
    }


    public function edit($id){
        $hospital = Hospital::findOrFail($id);
        return response()->view('cms.blood_donation.hospital.update',compact('hospital'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hospital = Hospital::findOrFail($id);

    $data = $request->validate([
        'name' => 'required',
        'city' => 'required',
        'location' => 'required',
      ]);

        $hospital->update($data);
        if($request->wantsJson()){
            return response()->json(['data' => $hospital]);
        }
        return redirect()->route('hospital.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hospital = Hospital::findOrFail($id);
        $deleted = $hospital->delete();
        return redirect()->back();
    }
}
