<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = "user";

    public function getAllUser()
    {
        $query = User::select('id','name','account','permission')->get();
        return $query;
    }
    public function getAllChair()
    {
        $query = User::select('id','name','account','permission')->where('permission',1)->get();
        return $query;

    }
    public function updatePermission($data)
    {
        $newPermission = $data['permission']==1?2:1;
        $query = User::where('id',$data['user_id'])->update(array("permission"=>$newPermission));
        return $query;
    }
    public function hasChair($account)
    {
        # code...
        $query = User::select('id')->where('account',$account)->get();
        return $query;
    }
    public function appendChair($data)
    {
        # code...
        $array = array(
            "name"=>$data['name'],
            "account"=>$data['account'],
            "password"=>sha1($data['password']),
            "permission"=>$data['permission']
        );
        $query = User::insert($array);
        return $query;
    }
    public function deleteChair($id)
    {
        $query=User::where('id',$id)->delete();
        return $query;
    }
}