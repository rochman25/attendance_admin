<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public function attendance_student() {
        return $this->hasMany(AttendanceStudent::class,'attendance_id');
    }

}
