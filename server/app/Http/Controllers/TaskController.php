<?php

namespace App\Http\Controllers;

use App\Models\Plan;

class TaskController extends Controller
{   
    public function index()
    {
        $plans = Plan::orderBy('id','desc')->get();
      
        return view('welcome',['plans' => $plans]);
    }
}
