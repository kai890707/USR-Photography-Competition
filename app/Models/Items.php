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
    public function getItemOfGroup($id)
    {
        $query = Items::join('group', 'photo.group_id', '=', 'group.id')
            ->join('applicant', 'photo.applicant_id', '=', 'applicant.id')
            ->select('photo.id as photoId', 'group.name as groupName', 'applicant.name as applicantName', 'photo.name as photoName', 'photo.illustrate as photoIllustrate', 'photo.status as photoStatus', 'photo.path as photoPath', 'applicant.community as applicantCommunity')
            ->where('photo.group_id', $id)
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
}