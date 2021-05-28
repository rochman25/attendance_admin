<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\AttendanceRepository;
use App\Repositories\AttendanceStudentRepository;
use Illuminate\Http\Request;

class AttendanceStudentController extends Controller
{
    protected $attendanceStudentRepository;
    protected $attendanceRepository;

    public function __construct(AttendanceStudentRepository $attendanceStudentRepository, AttendanceRepository $attendanceRepository)
    {
        $this->attendanceStudentRepository = $attendanceStudentRepository;
        $this->attendanceRepository = $attendanceRepository;
    }

    public function store(Request $request){

    }

    public function getDetailAttendance(Request $request, $id)
    {
        $attendanceEmployee = $this->attendanceRepository->getReportAttendanceById($id);
        $data['data'] = $this->handleNullMultiDimensi($attendanceEmployee);
        $data['message'] = "Request sukses";
        return $this->responseSukses($data, 200);
    }

    public function getEmployeeReportAttendance(Request $request, $id)
    {
        $attendanceEmployee = $this->attendanceRepository->getReportAttendanceWithStudentById($id, $request->id_student);
        $dataReport = ["data" => $this->handleNullMultiDimensi($attendanceEmployee)];
        $data['message'] = "Request sukses";
        return $this->responseSukses($data, 200, json_decode(json_encode($dataReport), true));
    }


}
