<?php

namespace Controller;

use Model\Group;
use Model\Student;
use Src\View;
use Src\Request;
use Model\User;

class Employees
{
    public function addStudents(Request $request): string
    {
        return new View('employees.add_students');
    }

    public function addGroup(Request $request): string
    {
        return new View('employees.add_group');
    }

    public function addDiscipline(Request $request): string
    {
        return new View('employees.add_discipline');
    }

    public function cabinet(Request $request): string
    {
        return new View('employees.cabinet');
    }

    public function students(Request $request): string
    {
        $students=Student::all();
        return new View('employees.students', ['students'=>$students]);
    }
    public function groups(Request $request): string
    {
        $groups=Group::all();
        return new View('employees.groups', ['groups'=>$groups]);
    }

    public function disciplines(Request $request): string
    {

        return new View('employees.disciplines');
    }
    public function gradeStudents(Request $request): string
    {

        return new View('employees.gradeStudents');
    }
}