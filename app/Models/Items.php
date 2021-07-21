<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Items extends Model
{
    use HasFactory;
    protected $table = "photo";

    /**
     * 以組為單位取得圖片
     */
    public function getItemOfGroup($request,$id)
    {
        $query = Items::join('group', 'photo.group_id', '=', 'group.id')
            ->join('applicant', 'photo.applicant_id', '=', 'applicant.id')
             ->join('score', 'photo.id', '=', 'score.photo_id')
            ->select('photo.id as photoId', 'group.name as groupName', 'applicant.name as applicantName', 'photo.name as photoName', 'photo.illustrate as photoIllustrate', 'score.status as photoStatus', 'photo.path as photoPath', 'applicant.community as applicantCommunity')
            ->where('photo.group_id', $id)
            ->where('score.user_id',$request->session()->get('uuid'))
            ->paginate(8);
        return $query;
    }
    public function getAllItems($request,$id)
    {
        $selectArray = [
            'photo.id as photoId', 
            'group.name as groupName', 
            'applicant.name as applicantName', 
            'photo.name as photoName',
            'photo.illustrate as photoIllustrate',
            'photo.path as photoPath',
            'applicant.community as applicantCommunity',
            'score.status as photoStatus'
        ];
        $query = Items::join('group', 'photo.group_id', '=', 'group.id')
            ->join('applicant', 'photo.applicant_id', '=', 'applicant.id')
            ->join('score', 'photo.id', '=', 'score.photo_id')
            ->select($selectArray)
            ->where('photo.group_id', $id)
            ->where('score.user_id',($request->session()->get('uuid')))
            ->paginate(8);
        return $query;
    }
    /**
     * 已評分完成圖片
     */
    public function getItemOfDone($request,$id)
    {
        $selectArray = [
            'photo.id as photoId', 
            'group.name as groupName', 
            'applicant.name as applicantName', 
            'photo.name as photoName',
            'photo.illustrate as photoIllustrate',
            'photo.path as photoPath',
            'applicant.community as applicantCommunity',
            'score.status as photoStatus'
        ];
        $query = Items::join('group', 'photo.group_id', '=', 'group.id')
            ->join('applicant', 'photo.applicant_id', '=', 'applicant.id')
            ->join('score', 'photo.id', '=', 'score.photo_id')
            ->select($selectArray )
            ->where('photo.group_id', $id)
            ->where('score.status',2)
            ->where('score.user_id',($request->session()->get('uuid')))
            ->paginate(8);
        return $query;
    }
    /**
     * 未評分完成圖片
     */
    public function getItemOfUnDone($request,$id)
    {
        $selectArray = [
            'photo.id as photoId', 
            'group.name as groupName', 
            'applicant.name as applicantName', 
            'photo.name as photoName',
            'photo.illustrate as photoIllustrate',
            'photo.path as photoPath',
            'applicant.community as applicantCommunity',
            'score.status as photoStatus'
        ];
        $query = Items::join('group', 'photo.group_id', '=', 'group.id')
            ->join('applicant', 'photo.applicant_id', '=', 'applicant.id')
            ->join('score', 'photo.id', '=', 'score.photo_id')
            ->select($selectArray)
            ->where('photo.group_id', $id)
            ->where('score.status',1)
            ->where('score.user_id',($request->session()->get('uuid')))
            ->paginate(8);
        return $query;
    }
    // public function groupItemOfUndone($request,$id)
    // {
    //     $query = Items::join('group', 'photo.group_id', '=', 'group.id')
    //         ->join('applicant', 'photo.applicant_id', '=', 'applicant.id')
    //         ->join('score', 'photo.id', '=', 'score.photo_id')
    //         ->select('photo.id as photoId', 'group.name as groupName', 'applicant.name as applicantName', 'photo.name as photoName', 'photo.illustrate as photoIllustrate', 'photo.status as photoStatus', 'photo.path as photoPath', 'applicant.community as applicantCommunity')
    //         ->where('photo.group_id', $id)
    //         ->where('score.user_id','!=',($request->session()->get('uuid')))
    //         ->paginate(8);
    //     return $query;
    // }
    /**
     * 以圖為單位取圖
     */
    public function getItemOfPhoto($id)
    {
        $query = Items::join('group', 'photo.group_id', '=', 'group.id')
            ->join('applicant', 'photo.applicant_id', '=', 'applicant.id')
            ->select('photo.id as photoId', 'group.id as groupId', 'group.name as groupName', 'applicant.name as applicantName', 'photo.name as photoName', 'photo.illustrate as photoIllustrate', 'photo.status as photoStatus', 'photo.path as photoPath', 'applicant.community as applicantCommunity')
            ->where('photo.id', $id)
            ->get();
        return $query;
    }
    /**
     * 獲取往後4筆作品
     */
    public function getItemOfNext($request,$pid, $gid)
    {
        $query = Items::join('group', 'photo.group_id', '=', 'group.id')
            ->join('applicant', 'photo.applicant_id', '=', 'applicant.id')
            ->join('score', 'photo.id', '=', 'score.photo_id')
            ->select('photo.id as photoId', 'group.name as groupName', 'applicant.name as applicantName', 'photo.name as photoName', 'photo.illustrate as photoIllustrate', 'photo.status as photoStatus', 'photo.path as photoPath', 'applicant.community as applicantCommunity')
            // ->where('photo.id', ">", $pid)
            ->where('photo.group_id', $gid)
            ->where('score.status', 1)
            ->where('score.user_id', $request->session()->get('uuid'))
            ->limit(4)->get();
        return $query;
    }
    /**
     * 取得所有評分
     */
    public function getAllItemsDataTable($id)
    {
        $selectArray = [
            "group.name as groupName",
            "applicant.name as applicantName", //投稿人
            "photo.id as photoId",             //圖片ID
            "score.id as scoreId",             //評分表ID
            "photo.path as photoPath",         //圖片位置
            "user.name as userName",         //評審
            "score.score_A as scoreA",         //分數A
            "score.score_B as scoreB",
            "score.score_C as scoreC",
            "score.status as status",                    //評分狀態
        ];
       $query = Items::join('group', 'photo.group_id', '=', 'group.id')
            ->join('applicant', 'photo.applicant_id', '=', 'applicant.id')
            ->join('score', 'photo.id', '=', 'score.photo_id')
            ->join('user', 'score.user_id', '=', 'user.id')
            ->select($selectArray)
            ->where('photo.group_id', $id)
             ->orderBy('photoId','asc')
            ->groupBy('score.id')
            ->get();
        foreach ($query as $row){
            $row['total'] = $row['scoreA']*0.3+$row['scoreB']*0.3+$row['scoreC']*0.4;
     
        }
        return $query;
    }

    /**
     * 取得該評審評分表
     */
    public function getAllItemsDataTableWithChair($id)
    {
        $selectArray = [
            "group.name as groupName",
            "applicant.name as applicantName", //投稿人
            "photo.id as photoId",             //圖片ID
            "score.id as scoreId",             //評分表ID
            "photo.path as photoPath",         //圖片位置
            "user.name as userName",         //評審
            "score.score_A as scoreA",         //分數A
            "score.score_B as scoreB",
            "score.score_C as scoreC",
            "score.status as status",                    //評分狀態
        ];
       $query = Items::join('group', 'photo.group_id', '=', 'group.id')
            ->join('applicant', 'photo.applicant_id', '=', 'applicant.id')
            ->join('score', 'photo.id', '=', 'score.photo_id')
            ->join('user', 'score.user_id', '=', 'user.id')
            ->select($selectArray)
            ->where('score.user_id', $id)
            ->orderBy('photoId','asc')
            ->get();
         foreach ($query as $row){
            $row['total'] = $row['scoreA']*0.3+$row['scoreB']*0.3+$row['scoreC']*0.4;
        }   
        return $query;
    }
    /**
     * 以組別取得分數
     */
    public function getAllItemsRankDataTable($groupId)
    {
       $selectArray = [
            "group.name as groupName",
            "applicant.name as applicantName", //投稿人
            "photo.id as photoId",             //圖片ID
            "score.id as scoreId",             //評分表ID
            // "user.name as userName",         //評審
            DB::raw('round(AVG(score.score_A),4) as scoreA'),         //分數A
            DB::raw('round(AVG(score.score_B),4) as scoreB'),
            DB::raw('round(AVG(score.score_C),4) as scoreC'),
            DB::raw('round(AVG(score.score_A*0.3+score.score_B*0.3+score.score_C*0.4),4) as total'),
            // DB::raw('score.score_A*0.3+score.score_B*0.3+score.score_C*0.4 as total'),
        ];
       $query = Items::join('group', 'photo.group_id', '=', 'group.id')
            ->join('applicant', 'photo.applicant_id', '=', 'applicant.id')
            ->join('score', 'photo.id', '=', 'score.photo_id')
            ->join('user', 'score.user_id', '=', 'user.id')
            ->select($selectArray)
            ->where('group.id', $groupId)
            ->where('score.status',2)
            // ->where('photo.id',28)
            ->groupBy('photo.id')
            ->orderBy('total','desc')
            ->get();
            // dd($query);
        //  foreach ($query as $row){
        //     $row['total'] = $row['scoreA']*0.3+$row['scoreB']*0.3+$row['scoreC']*0.4;
        // }  
        return $query;

    }
    /**
     * 以組別取得分數
     */
    public function getAllItemsRankExport($groupId)
    {
       $selectArray = [
            "group.name as groupName",
            "applicant.name as applicantName", //投稿人
            "photo.id as photoId",             //圖片ID
          
            // "user.name as userName",         //評審
            DB::raw('round(AVG(score.score_A),4) as scoreA'),         //分數A
            DB::raw('round(AVG(score.score_B),4) as scoreB'),
            DB::raw('round(AVG(score.score_C),4) as scoreC'),
            DB::raw('round(AVG(score.score_A*0.3+score.score_B*0.3+score.score_C*0.4),4) as total'),
            "photo.path as photoPath",
        ];
       $query = Items::join('group', 'photo.group_id', '=', 'group.id')
            ->join('applicant', 'photo.applicant_id', '=', 'applicant.id')
            ->join('score', 'photo.id', '=', 'score.photo_id')
            ->join('user', 'score.user_id', '=', 'user.id')
            ->select($selectArray)
            ->where('group.id', $groupId)
            ->where('score.status',2)
            // ->where('photo.id',28)
            ->groupBy('photo.id')
            ->orderBy('total','desc')
            ->get();
            // dd($query);
         foreach ($query as $row){
            $row['photoPath'] = 'https://drive.google.com/uc?export=view&id='.$row['photoPath'];
        }  
        return $query;

    }
}