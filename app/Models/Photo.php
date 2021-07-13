<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $table = "photo";
    protected $fillable = ['group_id', 'applicant_id', 'name','path','illustrate','status'];
}