<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Repositories\StudentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{

    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.students.index');
    }

    public function getStudents(Request $request){
        // if ($request->ajax()) {
            $data = $this->studentRepository->getAll();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    return '<a href="'. route('students.show',$row->id).'">'.$row->name.'</a>';
                })
                ->addColumn('updated_at', function($row){
                    return Carbon::parse($row->updated_at)->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('students.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> 
                    <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-url="'.route('students.destroy',$row->id).'">Delete</a>';
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
        return view('pages.students.create');
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
            "nis" => "required|unique:students,nis",
            "name" => "required",
            "gender" => "required"
        ]);

        try {
            DB::beginTransaction();
            $this->studentRepository->createNewStudent($request->all());
            DB::commit();
            return redirect()->route('students.index')->with('success','Siswa berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error','Siswa gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = $this->studentRepository->getById($id);
        return view('pages.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "nis" => "required|unique:students,nis,".$id,
            "name" => "required",
            "gender" => "required"
        ]);

        try {
            DB::beginTransaction();
            $this->studentRepository->updateStudent($request->all(),$id);
            DB::commit();
            return redirect()->route('students.index')->with('success','Siswa berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error','Siswa gagal disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            $this->studentRepository->delete($id);
            DB::commit();
            return response()->json(['status' => 'success','message' => "Data berhasil dihapus"]);
        }catch(\Throwable $e){
            DB::rollBack();
            // dd($e);
            return response()->json(['status' => 'error','message' => $e->getMessage()]);
        }
    }
}
