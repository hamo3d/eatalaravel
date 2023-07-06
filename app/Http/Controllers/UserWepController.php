<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserWepController extends Controller
{
    public function index()
    {
        $data = User::all();
        return response()->view('cms.users.index', ['data' => $data]);
    }
}
