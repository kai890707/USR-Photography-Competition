<?php

namespace App\Http\Controllers;

use App\Models\Back;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use App\Models\Group;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ResponseController;
use App\Models\User;
use Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\HeadingRowImport;

class BackController extends Controller
{
    public $back;
    public $group;
    public $user;
    public function __construct()
    {
        $this->middleware('backpermission');
        $this->back = new Back();
        $this->group = new Group();
        $this->user = new User();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('back.control');
    }
    public function setView()
    {
        return view('back.setting');
    }
    public function getGroup(Request $request)
    {
        # code...
        $allGroup  = $this->group->getGroup();
        return response()->json($allGroup);
    }
    public function setGroup(Request $request)
    {
        $data = $request->all();
        $array = explode(',', $data["groupName"]);
        $isUpdate = $this->group->updateGroup($array);
        if ($isUpdate) {
            $result = array("status" => ResponseController::$API_SUCCESS);
        } else {
            $result = array("status" => ResponseController::$API_ERROR);
        }
        return response()->json($result);
    }
    public function getAllUser()
    {
        $result = $this->user->getAllUser();
        // dd($result);
        return DataTables::of($result)
            ->addColumn('action', function ($result) {
                $userNow = $result->permission == 1 ? '評審' : '管理員';
                $userafter = $result->permission == 1 ? '管理員' : '評審';
                return "<select class='form-select' aria-label='Default select example' id='selected-permission' onchange='Group.updatePermission(" . $result->id . ")'>
                        <option value='1'>$userNow</option>
                        <option value='2'>$userafter</option>
                    </select>";
            })
            ->addColumn('action2', function ($result) {
                return "<button class='btn btn-outline-danger w-100' type='submit' onclick='Group.deleteChair(" . $result->id . ")'><i class='bi bi-trash'></i></button>";
            })
            ->rawColumns(['action', 'action2'])
            ->make(true);
    }
    public function updatePermission(Request $request)
    {
        # code...
        $data = $request->all();
        $query = $this->user->updatePermission($data);
        if ($query) {

            $result = array('status' => ResponseController::$API_SUCCESS);
        } else {
            $result = array('status' => ResponseController::$API_ERROR);
        }
        return response()->json($result);
    }
    public function appendChair(Request $request)
    {
        # code...
        $data = $request->all();
        $rules = [
            'account' => 'required',
            'password' => 'required',
            'name' => 'required',
            'permission' => 'required'
        ];
        $messages = [
            'required' => '為空白輸入',
        ];
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            $result =  ['status' => ResponseController::$API_ERROR, 'msg' => $validator->errors()];
        } else {
            $hasChair = $this->user->hasChair($data['account']);
            if (sizeof($hasChair) == 0) {
                $appendQuery = $this->user->appendChair($data);
                if ($appendQuery) {
                    $result = array('status' => ResponseController::$REGISTER_SUCCESS, 'msg' => "新增成功");
                } else {
                    $result = array('status' => ResponseController::$REGISTER_ERROR, 'msg' => "新增失敗，請重新輸入");
                }
            } else {
                $result = array('status' => ResponseController::$REGISTER_UNIQUE_ERROR, 'msg' => "帳號存在，請重新輸入");
            }
        }
        return response()->json($result);
    }
    public function deleteChair(Request $request)
    {
        $data = $request->all();
        $delete = $this->user->deleteChair($data['id']);
        if ($delete) {
            $result = array('status' => ResponseController::$API_SUCCESS, 'msg' => "刪除成功");
        } else {
            $result = array('status' => ResponseController::$API_SUCCESS, 'msg' => "刪除失敗");
        }
        return response()->json($result);
    }
    public function uploadCSV(Request $request)
    {
        if($request->hasFile('file')){
            $file = $request->file('file');
            Excel::import(new UsersImport,$file);
            return response()->json(array('status' => ResponseController::$API_SUCCESS, 'msg' => "匯入成功"));
        }else{
             return response()->json(array('status' => ResponseController::$API_SUCCESS, 'msg' => "匯入失敗"));
        }
    
    
    }

}