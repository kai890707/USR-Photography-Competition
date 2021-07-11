<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = "group";
    /**
     * 取得組別名稱
     */
    public function getGroupName($id)
    {
        $query = Group::select('name as groupName')
                        ->where('id',$id)
                        ->first();
        return $query;
    }
    /**
     * 新增、更新組別
     */
    public function updateGroup($array)
    {
        $insertData = array();
        $arrlen = count($array);
        for($i = 0 ;$i < $arrlen  ; $i++ ){
            if($array[$i]!==""){
                array_push($insertData,array("name"=>$array[$i]));
            }
        }
        Group::query()->delete();
        $query = Group::insert($insertData);
        return $query;
    }
    public function getGroup()
    {
        # code...
        $query = Group::select('id','name')->get();
        return $query;
    }
    public function getGroupId($groupName)
    {
        $query = Group::select('id')  ->where('name', 'like', '%' . $groupName . '%')->first();
        return $query;
    }
}
