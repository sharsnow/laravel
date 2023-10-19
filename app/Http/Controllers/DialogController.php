<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Dialog;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DialogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        
    $data['user_token'] =  Session::get('userLogin', 'null');
    $value = Session::get('userLogin', 'null');
    if($value != 'null') {
        return view('dialogManagement')->with(['data' => $data]);
    }
    return redirect()->intended('/');
    }

    
}
