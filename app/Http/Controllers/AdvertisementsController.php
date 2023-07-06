<?php

namespace App\Http\Controllers;

use App\Models\Advertisements;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class AdvertisementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */ 
    public function index(Request $request)
    {

        $data = Advertisements::with('category')->get();
        if($request->wantsJson()){
            return response()->json(['status' => true, 'message' => 'success', 'data' => $data], Response::HTTP_OK);
        }
        return response()->view('cms.advertisement.index', ['data' => $data]);
    }
    
    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $data = Category::latest()->get();    
        return response()->view('cms.advertisement.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $path = 'uploads/images';
        $imageName = time() + rand(1, 1000000) . '.' . $image->getClientOriginalExtension();
        $imageFullPath = $path . $imageName;
        Storage::disk('public')->put($path . $imageName, file_get_contents($image));

        $advertisement = new Advertisements();
        $advertisement->image = $imageFullPath;
        $advertisement->category_id = $request->input('category_id');
        $advertisement->save();    

        if($request->wantsJson()){
            return response()->json([
                'message' => 'Image uploaded successfully.',
                'success' => $advertisement ? "true" : 'false',
                'data' => $advertisement,
            ]);    
        }
        return redirect()->route('advertisement.index');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advertisements $advertisements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advertisements $advertisements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $advertisement = Advertisements::findOrFail($id);
        Advertisements::where('id', $advertisement->id)->decrement("donation_count", 1);
        $deleted = $advertisement->delete();
        return response()->json(['status' => $deleted, 'message' => $deleted ? 'success' : 'failed'], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
