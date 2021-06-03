<?php

namespace App\Repositories;

use App\Models\Attendance;

class AttendanceRepository {

    protected $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    public function getAll(){
        return $this->attendance->all();
    }

    public function getById($id){
        return $this->attendance->find($id);
    }

    public function createNewAttendance($data){
        // dd($data);
        $days = implode(",",$data['days']);
        return $this->attendance->create([
            "name" => $data['name'],
            "check_in" => $data['check_in'],
            // "check_out" => $data['check_out'],
            "days" => $days,
            "status" => $data['status']
        ]);
    }

    public function updateAttendance($data, $id){
        $days = implode(",",$data['days']);
        return $this->getById($id)->update([
            "name" => $data['name'],
            "check_in" => $data['check_in'],
            // "check_out" => $data['check_out'],
            "days" => $days,
            "status" => $data['status']
        ]);
    }

    public function delete($id){
        return $this->getById($id)->delete();
    }

    public function getReportAttendanceById($id){
        return $this->attendance->with(['attendance_student'])->where('id',$id)->get();
    }

    public function getReportAttendanceWithStudentById($id_attendance, $id_student){
        return $this->attendance->with(['attendance_student' => function($query)use($id_student){
            return $query->where('id',$id_student);
        }])->where('id',$id_attendance)->get();
    }

    public function getActiveAttendance(){
        return $this->attendance->where('status','1')->get();
    }

}