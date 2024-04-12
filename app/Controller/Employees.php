<?php

namespace Controller;

use Model\Group;
use Model\Student;
use Src\View;
use Src\Request;
use Model\User;

class Employees
{
    //    Добавление студентов
    public function addStudents(Request $request): string
    {
        return new View('employees.add_students');
    }

//    Добавление групп
    public function addGroup(Request $request): string
    {
        return new View('employees.add_group');
    }

//    Добавление дисциплин
    public function addDiscipline(Request $request): string
    {
        return new View('employees.add_discipline');
    }

//Просмотр студентов
    public function students(Request $request): string
    {
        $students=Student::all();
        return new View('employees.students', ['students'=>$students]);
    }

//    Просмотр групп
    public function groups(Request $request): string
    {
        $groups=Group::all();
        return new View('employees.groups', ['groups'=>$groups]);
    }

//    Просмотр дисциплин
    public function disciplines(Request $request): string
    {

        return new View('employees.disciplines');
    }

//    Успеваемость студентов
    public function gradeStudents(Request $request): string
    {
        return new View('employees.grade_students');
    }

    //    Страница студента
    public function vueStudent(Request $request): string
    {
        return new View('employees.student');
    }

    public function addDisciplineGroupe(Request $request): string
    {
        return new View('employees.add_discipline_groupe');
    }

    public function groupInf(Request $request): string
    {
        return new View('employees.groupInf');
    }

    public function addMark(Request $request): string
    {
        return new View('employees.addMark');
    }
}

