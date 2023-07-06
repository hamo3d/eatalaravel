<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request,)
    {
        $data = Donation::with('campaign','user','sacrificeFollowup')->get();
        if($request->wantsJson()){
            return response()->json(['status' => true, 'message' => 'success' , 'data' => $data], Response::HTTP_OK);
            }
            return view('cms.donations.index_campaign')->with('data',$data);
    }

    public function getDonationsZka(){
        $data = Donation::where('donations_type',1)->get();
        return response()->view('cms.donations.index_zka',compact('data'));
    }


    public function getDonationFast(){
        $data = Donation::where('donations_type',2)->get();
        return response()->view('cms.donations.index_general',compact('data'));
        
    }


    public function getDonationSacrifices(){
        $data = Donation::where('donations_type',3)->get();
        return response()->view('cms.donations.index_sacrificial',compact('data'));
    }


    public function getDonationsByUser(){
        $user = auth()->user();
        $donations = $user->donations;
        $totalDonations = $donations->sum('amount');
        return response()->json(['status' => true , 'message' => 'success', 'total_donations' => $totalDonations , 'donations' =>$donations], Response::HTTP_OK);
    }


    public function store(Request $request)
    {
        if($request->donations_type == 0)

        $validator = Validator($request->all(), [
            'campaign_id' => 'required|exists:campaigns,id',
            'amount' => 'required|numeric|min:0',
            'donations_type' => 'required|integer',
        ]);

        else if($request->donations_type == 1 || $request->donations_type == 2)

        $validator = Validator($request->all(), [
            'amount' => 'required|numeric|min:0',
            'donations_type' => 'required|integer',
        ]);

        else if($request->donations_type == 3)

        $validator = Validator($request->all(), [
            'amount' => 'required|numeric|min:0',
            'donations_type' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'item' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->first()], 400);
        }

        $donation = new Donation();
        $donation->user_id = Auth::id();
        $donation->campaign_id = $request->campaign_id;
        $donation->amount = $request->amount;
        $donation->donations_type = $request->donations_type;
        $donation->quantity = $request->quantity;
        $donation->item = $request->item;
        $donation->save();
        return Response()->json(['status' => true  ,  'message' => 'Donation completed successfully'],Response::HTTP_OK);
    }
    


    public function total(Request $request){
        $data = Donation::selectRaw('COUNT(*) as total_count,
            SUM(amount) as total_donations,
            SUM(CASE WHEN donations_type = 0 THEN amount ELSE 0 END) as campaign_donations,
            SUM(CASE WHEN donations_type = 1 THEN amount ELSE 0 END) as zakat_donations,
            SUM(CASE WHEN donations_type = 2 THEN amount ELSE 0 END) as general_donations,
            SUM(CASE WHEN donations_type = 3 THEN amount ELSE 0 END) as sacrifice_donations

        ')->first();
    
        $totalCount = $data->total_count;
        $totalDonations = $data->total_donations;
        $campaignDonations = $data->campaign_donations;
        $zakatDonations = $data->zakat_donations;
        $sacrificeDonations = $data->sacrifice_donations;
        $generalDonations = $data->general_donations;
    
        if($request->wantsJson()){
            return response()->json([
                'total_count' => $totalCount,
                'total_donations' => $totalDonations,
                'campaign_donations' => $campaignDonations,
                'zak_donations' => $zakatDonations,
                'sacrifice_donations' => $sacrificeDonations,
                'fast_donations' =>$generalDonations
            ]);
        }
        return view('cms.donations.index_total_donations', compact('totalCount', 'totalDonations', 'zakatDonations', 'generalDonations', 'campaignDonations','sacrificeDonations'));
    }
    
}