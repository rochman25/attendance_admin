<?php

namespace App\Http\Controllers;

use App\Models\AttendanceStudent;
use App\Repositories\AttendanceStudentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AttendanceStudentController extends Controller
{
    protected $attendanceStudentRepository;

    public function __construct(AttendanceStudentRepository $attendanceStudentRepository)
    {
        $this->attendanceStudentRepository = $attendanceStudentRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.attendance_students.index');
    }

    public function getStudentAttendances(Request $request){
        // if ($request->ajax()) {
            $data = $this->attendanceStudentRepository->getAll();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    return '<a href="'. route('students.edit',$row->student->id).'">'.$row->student->nis.'</a>';
                })
                ->addColumn('attendance', function($row){
                    return $row->attendance->name;
                })
                ->addColumn('updated_at', function($row){
                    return Carbon::parse($row->updated_at)->diffForHumans();
                })
                ->addColumn('check_in', function($row){
                    return Carbon::parse($row->created_at)->format("d-M-Y")." ".$row->check_in;
                })
                ->addColumn('action', function($row){
                    return '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-url="'.route('attendance_students.destroy',$row->id).'">Delete</a>';
                })
                ->rawColumns(['name','action'])
                ->make(true);
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AttendanceStudent  $attendanceStudent
     * @return \Illuminate\Http\Response
     */
    public function show(AttendanceStudent $attendanceStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AttendanceStudent  $attendanceStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(AttendanceStudent $attendanceStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AttendanceStudent  $attendanceStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttendanceStudent $attendanceStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttendanceStudent  $attendanceStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            $this->attendanceStudentRepository->delete($id);
            DB::commit();
            return response()->json(['status' => 'success','message' => "Data berhasil dihapus"]);
        }catch(\Throwable $e){
            DB::rollBack();
            // dd($e);
            return response()->json(['status' => 'error','message' => $e->getMessage()]);
        }
    }
}
