<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::all();
       return response()->json(['status' => true , 'message' => 'Success' , 'data' => $reservations],Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required',
            'mobile_number' => 'required',
            'name' => 'required',
            'blood_request_id' => 'required|exists:blood_requests,id',
        ]);
    
        $reservation = Reservation::create($data);
        return response()->json(['data' => $reservation], $reservation ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'date' => 'required',
            'mobile_number' => 'required',
            'name' => 'required',
            'blood_request_id' => 'required|exists:blood_requests,id',
        ]);
    
        $reservation = Reservation::findOrFail($id);
        $reservation->update($data);
    
        return response()->json(['data' => $reservation]);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        
    }
}
