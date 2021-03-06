<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Repositories\TeacherRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserTeacherRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        return view('pages.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UserRepository $userRepository, UserTeacherRepository $userTeacherRepository)
    {
        $request->validate([
            "nip" => "required|unique:teachers,nip|max:18",
            "name" => "required|max:255",
            "gender" => "required",
            "username" => "required|unique:users,username|max:25",
            "password" => "required|min:4|confirmed",
            "email" => "required|email|unique:users,email"
        ]);

        try {
            DB::beginTransaction();
            $teacher = $this->teacherRepository->createNewTeacher($request->all());
            $userData = [
                "username" => $request->input('username'),
                "email" => $request->input('email'),
                "name" => $request->input('name'),
                "password" => $request->input('password')
            ];
            $user = $userRepository->createNewUser($userData);
            $dataUserTeacher = [
                "user_id" => $user->id,
                "teacher_id" => $teacher->id
            ];
            $userTeacherRepository->create($dataUserTeacher);
            DB::commit();
            return redirect()->route('teachers.index')->with('success','Guru berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
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
    public function update(Request $request,UserRepository $userRepository,UserTeacherRepository $userTeacherRepository, $id)
    {
        $id_user = $request->input('id_user');
        $request->validate([
            "nip" => "required|max:18|unique:teachers,nip,".$id,
            "name" => "required|max:255",
            "gender" => "required",
            "username" => "required|max:25|unique:users,username,".$id_user,
            "password" => "nullable|min:4|confirmed",
            "email" => "nullable|email|unique:users,email,".$id_user
        ]);

        try {
            DB::beginTransaction();
            $user = $userRepository->getUserById($id_user);
            $userData = [
                "username" => $request->input('username'),
                "email" => $request->input('email'),
                "name" => $request->input('name'),
                "password" => (!empty($request->input('password'))) ? Hash::make($request->input('password')) : $user->password
            ];
            $this->teacherRepository->updateTeacher($request->all(), $id);
            if($user){
                $userRepository->updateUser($userData, $id_user);
            }else{
                $user = $userRepository->createNewUser($userData);
                $userTeacher = [
                    "user_id" => $user->id,
                    "teacher_id" => $id,
                ];
                $userTeacherRepository->create($userTeacher);
            }
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
    public function destroy(UserRepository $userRepository, UserTeacherRepository $userTeacherRepository, $id)
    {
        try{
            DB::beginTransaction();
            $id_user = $userTeacherRepository->getByTeacherId($id)->user_id;
            $userRepository->deleteUser($id_user);
            $userTeacherRepository->removeByTeacherId($id);
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
