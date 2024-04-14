<?php

namespace Controller;

use Model\Disciplines;
use Model\StudentsGroupe;
use Model\Student;
use Model\TypeOfControl;
use Model\GroupeGrade;
use Model\GroupeDisciplines;
use Model\Evaluations;
use Src\Validator\Validator;
use Src\View;
use Src\Request;
use Model\User;

class Employees
{
    //    Добавление студентов
    public function addStudents(Request $request): string
    {
        $select_groups = StudentsGroupe::all();
        if ($request->method === 'POST') {
            $data = $request->all();
            $studentsGroup = StudentsGroupe::find($data['id_group']);
            if ($studentsGroup) {
                Student::create([
                    'surname' => $data['surname'],
                    'name' => $data['name'],
                    'patronymic' => $data['patronymic'],
                    'gender' => $data['gender'],
                    'date' => $data['date'],
                    'adress' => $data['adress'],
                    'users_groupe' => $studentsGroup->id
                ]);
                app()->route->redirect('/students');
            }
        }

        return new View('employees.add_students', ['select_groups' => $select_groups]);
    }

//    Добавление групп
    public function addGroup(Request $request): string{

        if ($request->method === 'POST'&& StudentsGroupe::create($request->all())) {
            $data = $request->all();
            $validator = new Validator($request->all(), [
                'group_name' => $data['group_name'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if($validator->fails()){
                return new View('employees.add_group', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            $studentsGroup = new StudentsGroup();
            $studentsGroup->group_name = $request->group_name;
            $studentsGroup->save();

            return app()->route->redirect('/groups');
        }

        return new View('employees.add_group');
    }

//    Добавление дисциплин
    public function addDiscipline(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'discipline_name' => ['required', 'exists:discipline,discipline_name'],
            ], [
                'required' => 'Поле :field пусто',
                'exists' => 'Выбранная :field не существует',
            ]);

            if($validator->fails()){
                return new View('employees.add_discipline', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            $disciplines = new Disciplines();
            $disciplines->discipline_name = $request->discipline_name;
            $disciplines->save();

            return app()->route->redirect('/addDiscipline');
        }

        return new View('employees.add_discipline');
    }

    public function addDisciplineGroupe(Request $request): string{
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'group_name' => ['required', 'exists:students_groupe,group_name'],
                'discipline_name' => ['required', 'exists:discipline,discipline_name'],
            ], [
                'required' => 'Поле :field пусто',
                'exists' => 'Выбранная :field не существует',
            ]);

            if($validator->fails()){
                return new View('employees.add_discipline_groupe', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            $disciplineGroup = new DisciplineGroup();
            $disciplineGroup->group_name = $request->group_name;
            $disciplineGroup->discipline_name = $request->discipline_name;
            $disciplineGroup->save();

            return app()->route->redirect('/addDisciplineGroupe');
        }

        return new View('employees.add_discipline_groupe');
    }

//Просмотр студентов
    public function students(Request $request): string
    {
        $students=Student::all();
        return new View('employees.students', ['students'=>$students]);
    }

// Просмотр групп
    public function groups(Request $request): string {
        $groups = StudentsGroupe::select('group_name')->get(); // Выборка только столбца group_name
        return new View('employees.groups', ['groups' => $groups]);
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

}