<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Repositories\AttendanceRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AttendanceController extends Controller
{

    protected $attendanceRepository;

    public function __construct(AttendanceRepository $attendanceRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.attendances.index');
    }

    public function getAttendances(Request $request){
        // if ($request->ajax()) {
            $data = $this->coverNoteService->getAll();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    return '<a href="'. route('attendances.show',$row->id).'">'.$row->name.'</a>';
                })
                ->addColumn('updated_at', function($row){
                    return Carbon::parse($row->updated_at)->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('attendances.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> 
                    <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-url="'.route('attendances.destroy',$row->id).'">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action','name'])
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
        return view('pages.attendances.create'  );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|unique:attendances,name",
            "check_in" => "required",
            "check_out" => "required",
            "days" => "required",
            "status" => "required"
        ]);

        try {
            DB::beginTransaction();
            $this->attendanceRepository->createNewAttendance($request->all());
            DB::commit();
            return redirect()->route('teachers.index')->with('success','Absensi berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error','Absensi gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attendance = $this->attendanceRepository->getById($id);
        return view('pages.attendances.edit', compact('attendance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required|unique:attendances,name,".$id,
            "check_in" => "required",
            "check_out" => "required",
            "days" => "required",
            "status" => "required"
        ]);

        try {
            DB::beginTransaction();
            $this->attendanceRepository->updateAttendance($request->all(), $id);
            DB::commit();
            return redirect()->route('teachers.index')->with('success','Absensi berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error','Absensi gagal disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            $this->attendanceRepository->delete($id);
            DB::commit();
            return response()->json(['status' => 'success','message' => "Data berhasil dihapus"]);
        }catch(\Throwable $e){
            DB::rollBack();
            // dd($e);
            return response()->json(['status' => 'error','message' => $e->getMessage()]);
        }
    }
}
