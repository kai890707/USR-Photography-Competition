<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\ResponseController;

class LoginController extends Controller
{
    public $login;
    public function __construct()
    {
        $this->login = new Login();
    }
    public function index(Request $request)
    {
        //
        if ($request->session()->has('uuid')) {
            // return redirect('home');
            if ($request->session()->get('permission') == 1) {
                return redirect('front');
            }else if($request->session()->get('permission') == 2){
                return redirect('back');
            }else{
                // return redirect('home');
            }
        } else {
            return view('login.login');
        }
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'account' => 'required',
            'password' => 'required',
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            $result =  ['status' => ResponseController::$LOGIN_ERROR, 'msg' => $validator->errors()];
        } else {
            $isUser = $this->login->checkLogin($data['account'], $data['password']);
            if ($isUser != null) {
                $request->session()->put('uuid', $isUser->id);
                $request->session()->put('name', $isUser->name);
                $request->session()->put('account', $isUser->account);
                $request->session()->put('permission', $isUser->permission);
                $result = ['status' => ResponseController::$LOGIN_SUCCESS, 'msg' => '登入成功'];
            } else {
                $result = ['status' => ResponseController::$LOGIN_UNKNOWN_ERROR, 'msg' => '登入失敗'];
            }
        }
        return response()->json($result);
    }
    public function destroy(Request $request)
    {
        $request->session()->flush();
        return response()->json(array("status"=>"success","msg"=>"Bye!"));
    }
}
