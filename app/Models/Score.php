<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $table = "score";
    protected $fillable = ['photo_id', 'user_id','score_A','score_B','score_C','comments','status'];
    /**
     * 取圖片分數
     */
    public function getPhotoScore($id)
    {
        $query = Score::join('user', 'score.user_id', '=', 'user.id')
            ->select('user.name as userName', 'score_A as scoreA', 'score_B as scoreB', 'score_C as scoreC', 'comments','status')
            ->where('photo_id', $id)
            ->get();
        return $query;
    }

    /**
     * 當前評審之評分
     */
    public function getScoreOfChair($request, $id)
    {
        # code...
        $query = Score::join('user', 'score.user_id', '=', 'user.id')
            ->select('user.name as userName', 'score_A as scoreA', 'score_B as scoreB', 'score_C as scoreC', 'comments','status')
            ->where('photo_id', $id)
            ->where('user_id', $request->session()->get('uuid'))
            ->get();
        return $query;
    }
    /**
     * 確認評審是否為此筆資料評分
     */
    public function isScore($request)
    {
        # code...
        $data = $request->all();
        $query = Score::select('user_id')
            ->where('user_id', $request->session()->get('uuid'))
            ->where('photo_id', $data['photoId'])
            ->get();
        return $query;
    }
    public function updateScore($request)
    {
        $data = $request->all();
        $query = Score::where('photo_id', $data['photoId'])
            ->where('user_id', $request->session()->get('uuid'))
            ->update([
                'score_A' => $data['scoreA'],
                'score_B' => $data['scoreB'],
                'score_C' => $data['scoreC'],
                'comments' => $data['comments'],
                'status' => 2
            ]);
        return $query;
    }
    public function insertScore($request)
    {
        $data = $request->all();
        $query = Score::insert([
            'photo_id' => $data['photoId'],
            'user_id' => $request->session()->get('uuid'),
            'score_A' => $data['scoreA'],
            'score_B' => $data['scoreB'],
            'score_C' => $data['scoreC'],
            'comments' => $data['comments'],
            'status' => 2
        ]);
        return $query;
    }
}