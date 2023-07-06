<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminWepController extends Controller
{
    public function index()
    {
        $data = Admin::all();
        return response()->view('cms.admins.index', ['data' => $data]);
    }
}
