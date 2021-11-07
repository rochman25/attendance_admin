<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $total_teacher = Teacher::count();
        $total_student = Student::count();
        $attendances = Attendance::with('attendance_student')->whereHas('attendance_student',function($query){
            $query->whereDate('created_at','=',date("Y-m-d"));
        })->get();

        return view('pages.dashboard',compact('total_teacher','total_student','attendances'));
    }
}
