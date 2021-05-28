<?php

namespace App\Repositories;

use App\Models\Teacher;

class TeacherRepository {

    protected $teacher;

    public function __construct(Teacher $teacher)
    {
        $this->teacher = $teacher;
    }

    public function getAll(){
        return $this->teacher->all();
    }

    public function getById($id){
        return $this->teacher->find($id);
    }

    public function createNewTeacher($data){
        return $this->teacher->create([
            "nip" => $data['nip'],
            "name" => $data['name'],
            "gender" => $data['gender'],
            "pob" => $data['pob'],
            "dob" => $data['dob']
        ]);
    }

    public function updateTeacher($data, $id){
        return $this->getById($id)->update([
            "nip" => $data['nip'],
            "name" => $data['name'],
            "gender" => $data['gender'],
            "pob" => $data['pob'],
            "dob" => $data['dob']
        ]);
    }

    public function delete($id){
        return $this->getById($id)->delete();
    }

}