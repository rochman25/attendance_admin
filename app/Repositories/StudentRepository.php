<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository {

    protected $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function getAll(){
        return $this->student->all();
    }

    public function getById($id){
        return $this->student->find($id);
    }

    public function createNewStudent($data){
        return $this->student->create([
            "nis" => $data['nis'],
            "name" => $data['name'],
            "gender" => $data['gender'],
            "pob" => $data['pob'],
            "dob" => $data['dob']
        ]);
    }

    public function updateStudent($data, $id){
        return $this->getById($id)->update([
            "nis" => $data['nis'],
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