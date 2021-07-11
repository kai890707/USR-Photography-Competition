<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Back extends Model
{
    use HasFactory;
    protected $table = "photo";
    // public function insertGroup($array)
    // {
    //     # code...
    //     $insertData = array();
    //     $arrlen = count($array);
    //     for($i = 0 ;$i < $arrlen  ; $i++ ){
    //         array_push($insertData,array("name"=>$array[$i]));
    //     }
    //     dd( Back::insert($insertData));
    //     $query = Back::insert($insertData);
    //     return $query;
    // }
}
