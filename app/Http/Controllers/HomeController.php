<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        # code...
        // dd($request->session()->get('permission'));
        // return redirect()->route('front');
        // return view("front.all_project",[
        //     'uuid'=>$request->session()->get('uuid'),
        //     'account'=>$request->session()->get('account'),
        //     'name'=>$request->session()->get('name')]);
    }
}
