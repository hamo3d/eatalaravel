<?php

namespace App\Http\Controllers;

use App\Models\QuestionAnswer;
use Illuminate\Http\Request;

class QuestionAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $data = QuestionAnswer::all();
        if($request->wantsJson()){
            return response()->json(['status'=>true , 'message' => 'Success' , 'data' => $data]);
        }
        return response()->view('cms.question_and_answer.index',compact('data'));
        
    }


    public function create(){
        return response()->view('cms.question_and_answer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
         ]);

         $questionAndAnswer = new QuestionAnswer();
         $questionAndAnswer->question = $request->input('question');
         $questionAndAnswer->answer = $request->input('answer');
         $questionAndAnswer->save();
         return redirect()->route('questionAndAnswer.index');
        }


    public function edit($id){
        $questionAndAnswer = QuestionAnswer::findOrFail($id);
        return response()->view('cms.question_and_answer.update',['data'=>$questionAndAnswer]);
    }


    public function show(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
         ]);

         $questionAndAnswer =  QuestionAnswer::findOrFail($id);
         $questionAndAnswer->question = $request->input('question');
         $questionAndAnswer->answer = $request->input('answer');
         $questionAndAnswer->save();
         return redirect()->route('questionAndAnswer.edit');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $questionAnswer = QuestionAnswer::findOrFail($id);
         $questionAnswer->delete();
        return redirect()->back();
        
    }
}
