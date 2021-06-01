<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = ["nip","name","gender","dob","pob"];

    public function user(){
        return $this->hasOne(UserTeacher::class,'teacher_id');
    }

}
