<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $data = Campaign::with('donations')->withCount('donations')->get();
        if($request->wantsJson()){
            return response()->json(['status' => true, 'message' => 'success', 'data' => $data], Response::HTTP_OK);
        }
        return response()->view('cms.campaign.index', ['data' => $data]);
    }




    public function create(Request $request) {
        $data = Category::latest()->get();
        return response()->view('cms.campaign.create',compact('data'));
    }



    public function completedCampaigns()
{
    $completedCampaigns = Campaign::whereExists(function ($query) {
        $query->selectRaw('campaign_id, SUM(amount) as total_amount')
            ->from('donations')
            ->whereColumn('campaigns.id', 'donations.campaign_id')
            ->groupBy('campaign_id')
            ->havingRaw('total_amount >= campaigns.required_amount');
        })->get();

        foreach ($completedCampaigns as $campaign) {
            $campaign->completed_date = date('Y-m-d');
            $campaign->save();
        }

    return response()->json(['status' => !is_null($completedCampaigns) , 'message' => !is_null($completedCampaigns) ? 'Success' : 'There are no completed campaigns' ,'data' =>$completedCampaigns]);
} 
 
    

    public function store(Request $request)
    {
        if($request->wantsJson()){

            $validator =  Validator($request->all(),[
                'title' => 'required|string|min:3|max:60',
                'sup_title' => 'required|string|min:10|max:150',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'required_amount' => 'required|integer',
                'category_id' => 'required'
            ]);

    
            $image = $request->file('image');
            $path = 'uploads/images';
            $imageName = time() + rand(1, 1000000) . '.' . $image->getClientOriginalExtension();
            $imageFullPath = $path . $imageName;
            Storage::disk('public')->put($path . $imageName, file_get_contents($image));

            $category_id = $request->category_id;
            $donation_opportunities_name = Category::where('id', $category_id)->value('name');
            
        
    
    
            if($validator->fails()){
                return response()->json(['errors' => $validator->getMessageBag()->first()], 400);
            }
    
            $campaign = new Campaign();
            $campaign->category_id = $request->category_id;
            $campaign->title = $request->input('title');
            $campaign->sup_title = $request->input('sup_title');
            $campaign->image = $imageFullPath;
            $campaign->required_amount = $request->input('required_amount');
            $campaign->category_id = $category_id;
            $campaign->donation_opportunities_name = $donation_opportunities_name;
            Category::where('id', $campaign->category_id)->increment("donation_count", 1);
            $campaign->save();
    
            return response()->json([
                'message' => 'Image uploaded successfully.',
                'success' => $campaign ? "true" : 'false',
                'data' => $campaign,
    
            ]);
            
        }

        $request->validate([
            'title' => 'required|string|min:3|max:60',
            'sup_title' => 'required|string|min:10|max:150',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'required_amount' => 'required|integer',
            'category_id' => 'required|string',
        ]);


        $image =  $request->file('image');
        $path = 'uploads/images';
        $file_name = time() + rand(1,1000000) . "." . $image->getClientOriginalExtension();
        $imageFullPath =$path . $file_name;
        Storage::disk('public')->put($path.$file_name,file_get_contents($image));
        $category_id = $request->category_id;
        $donation_opportunities_name = Category::where('id', $category_id)->value('name');


        $campaign = new Campaign();
        $campaign->title = $request->input('title');
        $campaign->sup_title = $request->input('sup_title');
        $campaign->image = $imageFullPath;
        $campaign->required_amount = $request->input('required_amount');
        $campaign->category_id = $request->input('category_id');
        $campaign->donation_opportunities_name = $donation_opportunities_name;
        Category::where('id', $campaign->category_id)->increment("donation_count", 1);
        $campaign->save();
        return redirect()->route('campaigns.index');

    }

    public function show(Campaign $campaign)
    {

    }

    public function edit(string $id) {
        $campaign = Campaign::findOrFail($id);
        $category = Category::all();
        return response()->view('cms.campaign.update',compact('campaign' , 'category'));
    }
    


    public function update(Request $request, string $id)
    {
        if($request->wantsJson()){
            $validator =  Validator($request->all(),[
                'title' => 'required|string|min:3|max:60',
                'sup_title' => 'required|string|min:10|max:150',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'required_amount' => 'required|integer',
                'category_id' => 'required'
            ]);

    
            $image = $request->file('image');
            $path = 'uploads/images';
            $imageName = time() + rand(1, 1000000) . '.' . $image->getClientOriginalExtension();
            $imageFullPath = $path . $imageName;
            Storage::disk('public')->put($path . $imageName, file_get_contents($image));
            $category_id = $request->category_id;
            $donation_opportunities_name = Category::where('id', $category_id)->value('name');
    
    
            if($validator->fails()){
                return response()->json(['errors' => $validator->getMessageBag()->first()], 400);
            }
    
            $campaign = Campaign::findOrfail($id);
            $campaign->category_id = $request->category_id;
            $campaign->title = $request->input('title');
            $campaign->sup_title = $request->input('sup_title');
            $campaign->image = $imageFullPath;
            $campaign->required_amount = $request->input('required_amount');
            $campaign->category_id = $category_id;
            $campaign->donation_opportunities_name = $donation_opportunities_name;
            Category::where('id', $campaign->category_id)->increment("donation_count", 1);
            $updated =  $campaign->save();
            return response()->json(['status'=> $updated, "message"=> $updated ? "Success" : "Failed"], $updated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

            
        }

        $request->validate([
            'title' => 'required|string|min:3|max:60',
            'sup_title' => 'required|string|min:10|max:150',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'required_amount' => 'required|integer',
            'category_id' => 'required|string'
        ]);


        $image =  $request->file('image');
        $path = 'uploads/images';
        $file_name = time() + rand(1,1000000) . "." . $image->getClientOriginalExtension();
        $imageFullPath =$path . $file_name;
        Storage::disk('public')->put($path.$file_name,file_get_contents($image));
        $category_id = $request->category_id;
        $donation_opportunities_name = Category::where('id', $category_id)->value('name');


        $campaign = Campaign::findOrfail($id);
        $campaign->title = $request->input('title');
        $campaign->sup_title = $request->input('sup_title');
        $campaign->image = $imageFullPath;
        $campaign->required_amount = $request->input('required_amount');
        $campaign->category_id = $request->input('category_id');
        $campaign->donation_opportunities_name = $donation_opportunities_name;
        Category::where('id', $campaign->category_id)->increment("donation_count", 1);
        $campaign->save();
        return redirect()->route('campaigns.index');
    }

    public function destroy(string $id,Request $request)
    {
        $campaign = Campaign::findOrFail($id);
        Category::where('id', $campaign->category_id)->decrement("donation_count", 1);
        $deleted = $campaign->delete();
        if($request->wantsJson()){
            return response()->json(['status' => $deleted, 'message' => $deleted ? 'success' : 'failed'], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }
        return redirect()->back();
    }
}
