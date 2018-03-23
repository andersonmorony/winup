<?php

namespace winUp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use winUp\Http\Controllers\Controller;

class homeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }
}
