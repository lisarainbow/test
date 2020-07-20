<?php

namespace App\Http\Controllers;

use App\Http\Requests\EatUsersRequest;
use App\Http\Models\User\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * init
     */
    public function init()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('home', ['users' => User::all()]);
    }
}
