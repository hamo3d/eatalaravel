<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\SacrificeFollowup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class SacrificeFollowupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    if (Auth::check()) {
        $userId = Auth::id();
        $user = User::find($userId);

        if ($user) {
                $data = Donation::where('user_id', $userId)
                    ->where('donations_type', 3)
                    ->with('sacrificeFollowup')
                    ->get();
                    return response()->json(['status' => !is_null($data) ? true : false , 'message' => !is_null($data) ? 'Success' : 'Failed' ,'data' =>$data]);
        } else {
            return response()->json(['message' => 'حدث خطأ أثناء جلب بيانات المستخدم.']);
        }
    } else {
        echo "يرجى تسجيل الدخول للوصول إلى هذه الصفحة.";
    }
}


    public function create(Request $request){
        $donation_id = $request->input('donations->id');
        return response()->view('cms.sacrificeFollowups.create',['donation_id' => $donation_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{

    $donation_id = $request->input('donation_id');
        $donation = Donation::where('id', $donation_id)->first();

        if (!$donation) {
            return response()->json(['error' => 'لم يتم العثور على التبرع المطابق'], 404);
        }

        $followUp = new SacrificeFollowup();
        $followUp->slaughtered = $request->input('slaughtered');
        $followUp->donation_id = $donation->id;
        $followUp->note = $request->input('note');
        $followUp->save();

        if($request->wantsJson()){
            return response()->json([
                'data' => $followUp
            ]);
        }
        return redirect()->back();
    }


    public function show(string $id)
    {
        //
    }


     public function edit(string $donation_id){

     }


    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
