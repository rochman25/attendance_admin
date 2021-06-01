<?php

namespace App\Repositories;

use App\Models\AttendanceStudent;
use Carbon\Carbon;

class AttendanceStudentRepository {

    protected $attendanceStudent;

    public function __construct(AttendanceStudent $attendanceStudent)
    {
        $this->attendanceStudent = $attendanceStudent;        
    }

    public function getAttendanceStudentByToday($id_student, $id_attendance){
        return $this->attendanceStudent->where('student_id', $id_student)->where('attendance_id', $id_attendance)->whereDate('created_at',Carbon::today())->first();
    }

    public function createNewAttendance($data){
        return $this->attendanceStudent->create([
            "attendance_id" => $data['attendance_id'],
            "student_id" => $data['student_id'],
            "check_in" => $data['check_in'],
            "check_out" => $data['check_out'],
            "status" => $data['status'],
            "note" => $data['note']
        ]);
    }

    public function updateAttendance($data, $id){
        $this->attendanceStudent->find($id)->update([
            "attendance_id" => $data['attendance_id'],
            "student_id" => $data['student_id'],
            "check_in" => $data['check_in'],
            "check_out" => $data['check_out'],
            "status" => $data['status'],
            "note" => $data['note']
        ]);
        return $this->attendanceStudent->find($id);
    }

    public function getById($id){

    }

}