<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Items;
use App\Models\Score;
use Illuminate\Http\Request;

use Validator;
use function PHPUnit\Framework\isNull;

class ItemsController extends Controller
{

    public $items;
    public $score;
    public $group;
    public function __construct()
    {
        // $this->middleware('backpermission');
        $this->items = new Items();
        $this->score = new Score();
        $this->group = new Group();
    }
    /**
     * return view
     * {id => groupID}
     */
    public function getItemOfGroup(Request $request,$id)
    {
        $groupItems = $this->items->getItemOfGroup($id);
        $groupName = $this->group->getGroupName($id);
        return view('items.groupItems',compact('groupItems','groupName'));
    }
    /**
     * 取得所有作品
     */
    public function getAllItems(Request $request,$id)
    {
        $Items = $this->items->getAllItems($request,$id);
        $groupName = $this->group->getGroupName($id);
        return view('front.all_project',compact('Items','groupName'));
    }
    /**
     * 取得目前評審已評完分作品
     * {id => groupID}
     */
    public function getItemOfDone(Request $request,$id)
    {
        $groupItems = $this->items->getItemOfDone($request,$id);
        $groupName = $this->group->getGroupName($id);
        return view('front.done',compact('groupItems','groupName'));
        
    }
     /**
     * 取得目前評審未評完分作品
     * {id => groupID}
     */
    public function getItemOfUnDone(Request $request,$id)
    {
        $groupItems = $this->items->getItemOfUnDone($request,$id);
        $groupName = $this->group->getGroupName($id);
        return view('front.undone',compact('groupItems','groupName'));
        
    }
    public function getItemOfPhoto(Request $request,$id)
    {
        $photoInfos = $this->items->getItemOfPhoto($id);
        $chairScore = $this->score->getScoreOfChair($request,$id);
        $photoID = $id;
        if(count($photoInfos)==0){
            return view('404');
        }else{
            $getItemOfNexts = $this->items->getItemOfNext($request,$id,$photoInfos[0]["groupId"]);
            $photoScoreArray = $this->score->getPhotoScore($id);
            if(count($photoScoreArray)==0){
                $totalScore = "尚未評分";
                $compactArray = array('photoID','photoInfos','photoScoreArray','totalScore','getItemOfNexts','chairScore');
            }else{
                $unitScore=0;
                foreach($photoScoreArray as $data){
                    $score = ($data['scoreA']+$data['scoreB']+$data['scoreC'])/3;
                    $unitScore+=$score;
                }
                $totalScore =round($unitScore/count($photoScoreArray), 4); 
                $compactArray = array('photoID','photoInfos','photoScoreArray','totalScore','getItemOfNexts','chairScore');
            }
            return view('items.item',compact($compactArray));
        }
        
       
    }
    /**
     * 分數修改
     */
    public function scoreSheet(Request $request)
    {
        # code...
        $data = $request->all();
        $rules = [
            'scoreA' => 'required|numeric|min:0|max:100',
            'scoreB' => 'required|numeric|min:0|max:100',
            'scoreC' => 'required|numeric|min:0|max:100',
        ];
        $messages = [
            'numeric' => '請確認您所輸入之分數是否為數字',
            'min' => '請確認您所輸入之分數是否小於0分',
            'max' => '請確認您所輸入之分數是否超過100分',
        ];
        $validator = Validator::make($data, $rules,$messages);
        if ($validator->fails()) {
            $result =  ['status' => ResponseController::$API_ERROR, 'msg' => $validator->errors()];
        }else{
            $isScore = $this->score->isScore($request);
            if(count($isScore)!=0){
                $updateScore = $this->score->updateScore($request);
                if($updateScore){
                    $result = array('status' => ResponseController::$API_SUCCESS,'msg' =>"分數修改成功");
                }else{
                    $result = array('status' => ResponseController::$API_ERROR,'msg' =>"分數修改失敗，請聯絡系統管理員");
                }
            }else{
                $insertScore = $this->score->insertScore($request);
                if($insertScore){
                    $result = array('status' => ResponseController::$API_SUCCESS,'msg' =>"評分成功");
                }else{
                    $result = array('status' => ResponseController::$API_ERROR,'msg' =>"評分失敗，請聯絡系統管理員");
                }
            }
            
        }
        return response()->json($result);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

}