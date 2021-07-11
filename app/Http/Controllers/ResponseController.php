<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Validator;

class ResponseController extends Controller
{
    /**
     * 格式 { 行為_狀態 } Ex: LOGIN_0為登入成功
     * 各狀態數字所表
     * {
     *      0=>success
     *      1=>error
     *      2=>未知錯誤
     *      3=>某筆資料已存在    
     * }
     */
    public static $LOGIN_SUCCESS = 'LOGIN_0';
    public static $LOGIN_ERROR = 'LOGIN_1';
    public static $LOGIN_UNKNOWN_ERROR = 'LOGIN_2';
    public static $REGISTER_SUCCESS = 'REGISTER_0';
    public static $REGISTER_ERROR = 'REGISTER_1';
    public static $REGISTER_UNKNOWN_ERROR = 'REGISTER_2';
    public static $REGISTER_UNIQUE_ERROR = 'REGISTER_3';
    public static $API_SUCCESS = 'API_0';
    public static $API_ERROR = 'API_1';
    public static $API_UNKNOWN_ERROR = 'API_2';
}
