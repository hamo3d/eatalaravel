<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Category::with(['campaigns' => function($query) {
            $query->withCount('donations');
        }])->get();
        $campaign = Campaign::all();
        if($request->wantsJson()){
            return response()->json(['status' => true, 'message' => 'success', 'data' => $data], Response::HTTP_OK);
        }
        return response()->view('cms.categories.index', ['data'=>$data]);
    }


    public function create(Request $request) {
        return response()->view('cms.categories.create');
    } 

    

    public function store(Request $request)
    {

        if($request->wantsJson()){
            $validator = Validator($request->all(),[
                'name' => 'required|unique:categories'
            ]);
    
            if($validator->fails()){
                return response()->json(['errors' => $validator->getMessageBag()->first()], 400);
            }
            $category = new Category();
            $category->name = $request->input('name');
            $category->save();
            return response()->json(['status' => true, 'message' => 'success', 'data' => $category], Response::HTTP_OK);
        }

        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->save();
        return redirect()->route('categories.index');

    }


    public function show(string $id)
    {
        $data = Category::with('campaigns')->findOrfail($id);
        return Response()->json(['status' => true  ,  'message' =>    'success', 'object' => $data],Response::HTTP_OK);
    }

    public function edit(string $id) {
        $category = Category::findOrFail($id);
        return response()->view('cms.categories.update',['category'=>$category]);
    }



    public function update(Request $request, string $id)
    {
        //
        //
        $request->validate([
            'name' => 'required|unique:categories'
        ]);
        $category = Category::findOrfail($id);
        $category->name = $request->input("name");
        $update = $category->save();
        if($request->wantsJson()){
            return Response()->json(['status' => $update, 'message' => $update ? 'success' : 'failed', 'object ' => $category], $update == 1 ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }
        return redirect()->route('categories.index');
    }


    public function destroy(string $id,Request $request)
    {
        //
        $category = Category::findOrFail($id);
        $deleted = $category->delete();
        if($request->wantsJson()){
            return response()->json(['status' => $deleted, 'message' => $deleted ? 'success' : 'failed'], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }
        return redirect()->back();

    }
}
