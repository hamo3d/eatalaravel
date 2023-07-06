<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{



    public function index(Request $request){
        $data = About::all();
        if($request->wantsJson()){
            return response()->json($data);
        }
        return response()->view('cms.about.index', ['data' => $data]);
    }

    public function create(Request $request) {
        return response()->view('cms.about.create');
    }


    public function store(Request $request){

        $request->validate([
            'content' => 'required|string'
        ]);

        $content = $request->input('content');
        $about = new About();
        $about->content = $content;
        $about->save();
        return redirect()->route('about.index');

    }
}
