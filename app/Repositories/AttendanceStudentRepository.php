<?php

namespace App\Repositories;

use App\Models\AttendanceStudent;

class AttendanceStudentRepository {

    protected $attendanceStudent;

    public function __construct(AttendanceStudent $attendanceStudent)
    {
        $this->attendanceStudent = $attendanceStudent;        
    }

    

}