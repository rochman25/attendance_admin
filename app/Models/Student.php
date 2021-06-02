<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ["nis","name","gender","dob","pob"];

    public function attendances(){
        return $this->hasMany(AttendanceStudent::class,'student_id');
    }

}
