<?php

namespace App\Http\Controllers;

use App\Models\Sacrifice;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SacrificeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Sacrifice::all();
        if($request->wantsJson()){
            return response()->json(['status' => true , 'message' => 'Success' , 'data' => $data]);
        }
        return response()->view('cms.sacrifices.index',compact('data'));

    }


    public function create(Request $request) {
        return response()->view('cms.sacrifices.create');
    } 


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'item' => 'required',
            'details' => 'required',
            'sacrificesPrice' => 'required'
        ]);

            $sacrifice = new Sacrifice();
            $sacrifice->item = $request->input('item');
            $sacrifice->details = $request->input('details');
            $sacrifice->sacrificesPrice = $request->input('sacrificesPrice');
            $saved = $sacrifice->save();
            if($request->wantsJson()){
                return response()->json(['status' =>$saved , 'message' => $saved ? 'Success' : 'Failed'],$saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
            }
            return redirect()->route('sacrifices.index');
        }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function edit(string $id) {
        $sacrifice = Sacrifice::findOrFail($id);
        return response()->view('cms.sacrifices.update',['data'=>$sacrifice]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'item' => 'required',
            'details' => 'required',
            'sacrificesPrice' => 'required'
        ]);

            $sacrifice = Sacrifice::findOrFail($id);
            $sacrifice->item = $request->input('item');
            $sacrifice->details = $request->input('details');
            $sacrifice->sacrificesPrice = $request->input('sacrificesPrice');

            $updated = $sacrifice->save();
            if($request->wantsJson()){
                return response()->json(['status' =>$updated , 'message' => $updated ? 'Success' : 'Failed'],$updated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
            }
            return redirect()->route('sacrifices.index');
        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $sacrifice = Sacrifice::findOrFail($id);
        $sacrifice->delete();
        return redirect()->back();
        
    }
}
