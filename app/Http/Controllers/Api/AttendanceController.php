<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\AttendanceRepository;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $attendanceRepository, $studentRepository;

    public function __construct(AttendanceRepository $attendanceRepository, StudentRepository $studentRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
        $this->studentRepository = $studentRepository;
    }

    public function index(Request $request){
        $attendances = $this->attendanceRepository->getActiveAttendance();
        $data['data'] = $this->handleNullMultiDimensi($attendances);
        $data['message'] = "Request sukses";
        return $this->responseSukses($data, 200);

    }

    public function indexStudentsById(Request $request, $id){
        $studentsHasAttend = $this->studentRepository->getListStuentByTodayAttendanceId();
        $arrStudentId = [];
        foreach($studentsHasAttend as $index => $item){
            $arrStudentId[] = $item->id;
        }
        $students = $this->studentRepository->getStudentsExcept($arrStudentId);
        $data['data'] = $this->handleNullMultiDimensi($students);
        $data['message'] = "Request sukses";
        return $this->responseSukses($data, 200);
    }

}
