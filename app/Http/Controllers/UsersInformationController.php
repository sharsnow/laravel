<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UsersInformation;
class UsersInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //顯示所有使用者的列表
    public function index()
    {
        //
        $users = DB::select('SELECT * FROM `users_information` where active = ?', [1]);

        return view('user.index', ['users' => $users]);
    }
    public function add(Request $request)
    {
        // 获取formData中的数据
        $formData = $request->all();

        // 可以通过 $formData['fieldName'] 获取相应的字段值
        $userName = $formData['userName'];
        $sex = $formData['sex'];
        $inputAccount = $formData['InputAccount'];
        $inputPassword = encrypt($formData['InputPassword']);
        $emailAddress = $formData['emailAddress'];

        $user = new UsersInformation();
        $user->username = $userName;
        $user->account = $inputAccount; 
        $user->sex = $sex;
        $user->password = $inputPassword ;
        $user->email = $emailAddress;
        $user->save();
        Log::info($user);
        return response()->json([
            'status' => true,
            'message' => "register ok"
        ], 200);

    }
    public function login(Request $request)
    {
        $formData = $request->all();
        $account = $formData['InputAccount'];
        $password = $formData['InputPassword'];
       
        try {
            $user = UsersInformation::where('account', $account)->first();
            $decryptPassword =  decrypt($user->password);

            if($password == $decryptPassword) {
                if (!Session::has('userLogin'))
                {
                    Session::put('userLogin', 'success');
                }
                
                return response()->json([
                    'status' => true,
                    'password' => true
                ], 200);
                
            } 
            else if($password != $decryptPassword) {
                return response()->json([
                    'status' => true,
                    'password' => false
                ], 200);
            }
        } catch (\Throwable $th) {
            // Log::info($th);
            return response()->json([
                'status' => false,
                'password' => false
            ], 200);
        }

    }
}
