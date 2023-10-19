<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Action;
class ActionController extends Controller
{
    //
    const UPDATED_AT = null;
    const CREATED_AT = null;
    public $timestamps = false;

    public function index() {

        $action = Action::all();
        return  response()->json($action);
    }
    public function view() {
                
        $data['user_token'] =  Session::get('userLogin', 'null');
        $value = Session::get('userLogin', 'null');
        if($value != 'null') {
            return view('action')->with(['data' => $data]);
        }
        return redirect()->intended('/');
    }
}
