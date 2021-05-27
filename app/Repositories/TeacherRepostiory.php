<?php

namespace App\Repositories;

use App\Models\Teacher;

class TeacherRepository {

    protected $teacher;

    public function __construct(Teacher $teacher)
    {
        $this->teacher = $teacher;
    }

    

}