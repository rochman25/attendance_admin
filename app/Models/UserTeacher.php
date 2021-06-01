<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTeacher extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ["user_id","teacher_id"];


    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class,'teacher_id');
    }

    
}
