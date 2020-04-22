<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;

class StatesController extends Controller
{
    public function index()
    {
        $states = State::paginate(20);
        return view('state.index',compact('states'));
    }

    public function getCounties(State $state) {
        return view('state.counties',compact('state'));
        
    }
}
