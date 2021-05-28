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
        return $this->attendance->create([
            "nis" => $data['nis'],
            "name" => $data['name'],
            "gender" => $data['gender'],
            "pob" => $data['pob'],
            "dob" => $data['dob']
        ]);
    }

    public function updateAttendance($data, $id){
        return $this->getById($id)->update([
            "nis" => $data['nis'],
            "name" => $data['name'],
            "gender" => $data['gender'],
            "pob" => $data['pob'],
            "dob" => $data['dob']
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

}