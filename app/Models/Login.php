<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     public function checkLogin($account,$password)
     {
        $query = Login::where('account', $account)->where('password',sha1($password))->first();
        return $query;
     }
}
