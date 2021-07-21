<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Portfolio extends Model
{
    use HasFactory;
    protected $table = "photo";
     public function getAllItems()
    {
        $selectArray = [
            'photo.id as photoId', 
            'group.name as groupName', 
            'applicant.name as applicantName', 
            'photo.name as photoName',
            'photo.illustrate as photoIllustrate',
            'photo.path as photoPath',
            'applicant.community as applicantCommunity',
            'score.status as photoStatus',
            DB::raw('round(AVG(score.score_A*0.3+score.score_B*0.3+score.score_C*0.4),4) as total')
        ];
        $query = Items::join('group', 'photo.group_id', '=', 'group.id')
            ->join('applicant', 'photo.applicant_id', '=', 'applicant.id')
            ->join('score', 'photo.id', '=', 'score.photo_id')
            ->where('score.status',2)
            ->select($selectArray)
            ->groupBy('photo.id')
            ->paginate(8);
        return $query;
    }
    public function getGroupOfItem($groupID)
    {
       $selectArray = [
            'photo.id as photoId', 
            'group.name as groupName', 
            'applicant.name as applicantName', 
            'photo.name as photoName',
            'photo.illustrate as photoIllustrate',
            'photo.path as photoPath',
            'applicant.community as applicantCommunity',
            'score.status as photoStatus',
            DB::raw('round(AVG(score.score_A*0.3+score.score_B*0.3+score.score_C*0.4),4) as total')
        ];
        $query = Items::join('group', 'photo.group_id', '=', 'group.id')
            ->join('applicant', 'photo.applicant_id', '=', 'applicant.id')
            ->join('score', 'photo.id', '=', 'score.photo_id')
            ->select($selectArray)
            ->where('photo.group_id', $groupID)
            ->where('score.status',2)
            ->groupBy('photo.id')
            ->paginate(8);
        return $query;
    }
      /**
     * 以圖為單位取圖
     */
    public function getItemOfPhoto($id)
    {
        $selectArray = [
            'photo.id as photoId', 
            'group.id as groupId',
            'group.name as groupName', 
            'applicant.name as applicantName', 
            'photo.name as photoName',
            'photo.illustrate as photoIllustrate',
            'photo.path as photoPath',
            'applicant.community as applicantCommunity',
            'score.status as photoStatus',
            'score.comments as comments',
            'score.checkValue as checkValue',
             DB::raw('round(AVG(score.score_A*0.3+score.score_B*0.3+score.score_C*0.4),4) as total')
        ];
        $query = Portfolio::join('group', 'photo.group_id', '=', 'group.id')
            ->join('applicant', 'photo.applicant_id', '=', 'applicant.id')
            ->join('score', 'photo.id', '=', 'score.photo_id')
            ->select($selectArray)
            ->where('photo.id', $id)
            ->where('score.status',2)
            ->groupBy('photo.id')
            ->get();
        return $query;
    }
     /**
     * 獲取往後4筆作品
     */
    public function getItemOfNext($request,$pid,$gid)
    {
       $selectArray = [
            'photo.id as photoId', 
            'group.name as groupName', 
            'applicant.name as applicantName', 
            'photo.name as photoName',
            'photo.illustrate as photoIllustrate',
            'photo.path as photoPath',
            'applicant.community as applicantCommunity',
            'score.status as photoStatus',
            DB::raw('round(AVG(score.score_A*0.3+score.score_B*0.3+score.score_C*0.4),4) as total')
        ];
        $query = Portfolio::join('group', 'photo.group_id', '=', 'group.id')
            ->join('applicant', 'photo.applicant_id', '=', 'applicant.id')
            ->join('score', 'photo.id', '=', 'score.photo_id')
            ->select($selectArray)
            ->where('photo.group_id', $gid)
            ->where('photo.id','!=',$pid)
            ->where('score.status', 2)
            ->groupBy('photo.id')
            ->limit(4)
            ->get();
        return $query;
    }
}