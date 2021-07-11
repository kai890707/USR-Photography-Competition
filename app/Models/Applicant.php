<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    protected $table = "applicant";
    protected $fillable = ['name', 'phone', 'community'];
    public function getApplicantId($name)
    {
        $query = Applicant::select('id')  ->where('name', 'like', '%' . $name . '%')->first();
        return $query;
    }
}
