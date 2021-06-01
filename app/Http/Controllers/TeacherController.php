<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Repositories\TeacherRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TeacherController extends Controller
{
    protected $teacherRepository;

    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.teachers.index');
    }


    public function getTeachers(Request $request){
        // if ($request->ajax()) {
            $data = $this->teacherRepository->getAll();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    return '<a href="'. route('teachers.show',$row->id).'">'.$row->name.'</a>';
                })
                ->addColumn('updated_at', function($row){
                    return Carbon::parse($row->updated_at)->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('teachers.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> 
                    <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-url="'.route('teachers.destroy',$row->id).'">Delete</a>';
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
        return view('pages.attendances.index');
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
            "nip" => "required|unique:teachers,nip",
            "name" => "required",
            "gender" => "required"
        ]);

        try {
            DB::beginTransaction();
            $this->teacherRepository->createNewTeacher($request->all());
            DB::commit();
            return redirect()->route('teachers.index')->with('success','Guru berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error','Guru gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = $this->teacherRepository->getById($id);
        return view('pages.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "nip" => "required|unique:teachers,nip,".$id,
            "name" => "required",
            "gender" => "required"
        ]);

        try {
            DB::beginTransaction();
            $this->teacherRepository->updateTeacher($request->all(), $id);
            DB::commit();
            return redirect()->route('teachers.index')->with('success','Guru berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error','Guru gagal disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            $this->teacherRepository->delete($id);
            DB::commit();
            return response()->json(['status' => 'success','message' => "Data berhasil dihapus"]);
        }catch(\Throwable $e){
            DB::rollBack();
            // dd($e);
            return response()->json(['status' => 'error','message' => $e->getMessage()]);
        }
    }
}
