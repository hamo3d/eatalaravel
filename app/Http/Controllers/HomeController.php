<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function home()
    {
        $categories_count = Category::query()->get()->count();
        $campaigns_count = Campaign::query()->get()->count();
        $users_count = User::query()->get()->count();
        $admins_count = Admin::query()->get()->count();

        return response()->view('cms.home', compact('categories_count','campaigns_count','users_count','admins_count'));
    }

}
