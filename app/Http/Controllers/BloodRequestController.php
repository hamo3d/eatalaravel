<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use App\Models\Hospital;
use Illuminate\Http\Request;

class BloodRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = BloodRequest::all();
        if($request->wantsJson()){
            return response()->json(['data' => $data]);
        }
        return response()->view('cms.blood_donation.blood_request.index',compact('data'));
    }


    public function create(Request $request) {
        $hospitalId = $request->input('hospital_id');
        return response()->view('cms.blood_donation.blood_request.create',compact('hospitalId'));
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'blood_types' => 'required',
            'units_required' => 'required',
            'highest_need' => 'required',
            'hospital_id' => 'required|exists:hospitals,id',
        ]);
    
        $bloodRequest = BloodRequest::create($data);

        if($request->wantsJson()){
            return response()->json(['data' => $bloodRequest], 201);
        }
        return redirect()->route('blood-request.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }


    public function edit(string $id){
        $bloodRequest = BloodRequest::findOrFail($id);
        return response()->view('cms.blood_donation.blood_request.update',compact('bloodRequest'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'blood_types' => 'required',
            'units_required' => 'required',
            'highest_need' => 'required',
            
        ]);
    
        $bloodRequest = BloodRequest::findOrFail($id);
        $bloodRequest->update($data);
        return redirect()->route('blood-request.index');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bloodRequest = BloodRequest::findOrFail($id);
        $deleted = $bloodRequest->delete();
        return redirect()->back();

        
    }
}
