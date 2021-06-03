<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceStudent extends Model
{
    use HasFactory;
    protected $fillable = ["attendance_id", "student_id", "check_in", "check_out", "note", "status"];

    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }

    public function attendance(){
        return $this->belongsTo(Attendance::class,'attendance_id');
    }

}
