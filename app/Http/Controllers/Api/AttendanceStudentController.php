<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\AttendanceRepository;
use App\Repositories\AttendanceStudentRepository;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceStudentController extends Controller
{
    protected $attendanceStudentRepository, $attendanceRepository, $studentRepository;

    public function __construct(
        AttendanceStudentRepository $attendanceStudentRepository,
        AttendanceRepository $attendanceRepository,
        StudentRepository $studentRepository
    ) {
        $this->attendanceStudentRepository = $attendanceStudentRepository;
        $this->attendanceRepository = $attendanceRepository;
        $this->studentRepository = $studentRepository;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'attendance_id' => 'required',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            $msg = $this->validationError;
            return $this->responseError($msg, $validator->errors(), 400);
        }

        $attendance = $this->attendanceRepository->getById($request->attendance_id);

        if ($attendance) {

            if ($attendance->status === 0) {
                $data['message'] = "Presensi ini sudah tidak aktif.";
                $data['data'] = [];
                return $this->responseSukses($data);
            }

            $student = $this->studentRepository->getById($request->student_id);

            if ($student === null) {
                $data['message'] = "Siswa tidak ditemukan.";
                $data['data'] = [];
                return $this->responseSukses($data);
            }
            $this->nis = $student->nis;
            $attendanceStudent = $this->attendanceStudentRepository->getAttendanceStudentByToday($request->student_id, $request->attendance_id);
            $dataAttendance = [
                "attendance_id" => $request->attendance_id,
                "student_id" => $request->student_id,
                "status" => "present",
                "check_in" => ($request->type == "check_in") ? date("Y-m-d H:i:s") : null,
                "check_out" => ($request->type == "check_out") ? date("Y-m-d H:i:s") : null,
                "note" => $request->note
            ];
            if ($attendanceStudent) {
                $dataAttendance = [
                    "attendance_id" => $request->attendance_id,
                    "student_id" => $request->student_id,
                    "status" => "present",
                    "check_in" => ($request->type == "check_in") ? date("Y-m-d H:i:s") : $attendanceStudent->check_in,
                    "check_out" => ($request->type == "check_out") ? date("Y-m-d H:i:s") : $attendanceStudent->check_out,
                    "note" => $request->note
                ];

                if ($request->type == "check_out") {
                    if ($attendanceStudent->check_out != null) {
                        $studentAttendance = $attendanceStudent;
                        $data['message'] = "NIS ".$student->nis. " : ".$this->attendanceSignOutLimit;
                    } else {
                        $studentAttendance = $this->attendanceStudentRepository->updateAttendance($dataAttendance, $attendanceStudent->id);
                        $data['message'] = "NIS ".$student->nis. " : ".$this->attendanceSignOut;
                    }
                } else {
                    if ($attendanceStudent->check_in != null) {
                        $studentAttendance = $attendanceStudent;
                        $data['message'] = "NIS ".$student->nis. " : ".$this->attendanceSignInLimit;
                    } else {
                        $studentAttendance = $this->attendanceStudentRepository->updateAttendance($dataAttendance, $attendanceStudent->id);
                        $data['message'] = "NIS ".$student->nis. " : ".$this->attendanceSignIn;
                    }
                }
            } else {
                $studentAttendance = $this->attendanceStudentRepository->createNewAttendance($dataAttendance);
                $data['message'] = "NIS ".$student->nis. " : ".$this->attendanceSignIn;
            }
            $data['data'] = $studentAttendance;
        } else {
            $data['message'] = "Data presensi tidak ditemukan.";
            $data['data'] = [];
        }
        return $this->responseSukses($data);
    }

    public function storeBulk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'attendance_id' => 'required',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            $msg = $this->validationError;
            return $this->responseError($msg, $validator->errors(), 400);
        }

        $attendance = $this->attendanceRepository->getById($request->attendance_id);
        $student_id = explode(",", $request->student_id);
        if ($attendance) {

            if ($attendance->status === 0) {
                $data['message'] = "Presensi ini sudah tidak aktif.";
                $data['data'] = [];
                return $this->responseSukses($data);
            }

            foreach ($student_id as $index => $item) {
                $attenanceInstance = true;
                $student = $this->studentRepository->getById($item);

                if ($student === null) {
                    $attenanceInstance = false;
                }

                if ($attenanceInstance) {
                    // $this->nis = $student->nis;
                    $attendanceStudent = $this->attendanceStudentRepository->getAttendanceStudentByToday($item, $request->attendance_id);
                    $dataAttendance = [
                        "attendance_id" => $request->attendance_id,
                        "student_id" => $item,
                        "status" => "present",
                        "check_in" => ($request->type == "check_in") ? date("Y-m-d H:i:s") : null,
                        "check_out" => ($request->type == "check_out") ? date("Y-m-d H:i:s") : null,
                        "note" => $request->note
                    ];
                    if ($attendanceStudent) {
                        $dataAttendance = [
                            "attendance_id" => $request->attendance_id,
                            "student_id" => $item,
                            "status" => "present",
                            "check_in" => ($request->type == "check_in") ? date("Y-m-d H:i:s") : $attendanceStudent->check_in,
                            "check_out" => ($request->type == "check_out") ? date("Y-m-d H:i:s") : $attendanceStudent->check_out,
                            "note" => $request->note
                        ];

                        if ($request->type == "check_out") {
                            if ($attendanceStudent->check_out != null) {
                                $studentAttendance = $attendanceStudent;
                                $data['message'][] = "NIS ".$student->nis. " : ".$this->attendanceSignOutLimit;
                            } else {
                                $studentAttendance = $this->attendanceStudentRepository->updateAttendance($dataAttendance, $attendanceStudent->id);
                                $data['message'][] = "NIS ".$student->nis. " : ".$this->attendanceSignOut;
                            }
                        } else {
                            if ($attendanceStudent->check_in != null) {
                                $studentAttendance = $attendanceStudent;
                                $data['message'][] = "NIS ".$student->nis. " : ".$this->attendanceSignInLimit;
                            } else {
                                $studentAttendance = $this->attendanceStudentRepository->updateAttendance($dataAttendance, $attendanceStudent->id);
                                $data['message'][] = "NIS ".$student->nis. " : ".$this->attendanceSignIn;
                            }
                        }
                    } else {
                        $studentAttendance = $this->attendanceStudentRepository->createNewAttendance($dataAttendance);
                        $data['message'][] = "NIS ".$student->nis. " : ".$this->attendanceSignIn;
                    }
                    $data['data'][] = $studentAttendance;
                }else{
                    $data['data'][] = [];
                    $data['message'][] = "Siswa tidak ditemukan";
                }
            }
        } else {
            $data['message'] = "Data presensi tidak ditemukan.";
            $data['data'] = [];
        }
        return $this->responseSukses($data);
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
