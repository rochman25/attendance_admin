<?php

namespace App\Repositories;

use App\Models\UserTeacher;

class UserTeacherRepository {

    protected $userTeacher;

    public function __construct(UserTeacher $userTeacher)
    {
        $this->userTeacher = $userTeacher;
    }

    public function create($data){
        return $this->userTeacher->create([
            "user_id" => $data['user_id'],
            "teacher_id" => $data['teacher_id']
        ]);
    }

    public function removeByTeacherId($id){
        return $this->userTeacher->where('teacher_id',$id)->delete();
    }



}