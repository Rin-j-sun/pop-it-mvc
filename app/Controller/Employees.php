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
            $studentsGroup = StudentsGroupe::find($data['id']);
            var_dump($data, $data['id'], $studentsGroup);
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
        };
        return new View('employees.add_students', ['select_groups' => $select_groups]);
    }

//    Добавление групп работает
    public function addGroup(Request $request): string{

        if ($request->method === 'POST') {
            $data = $request->all();
            $studentsGroup = StudentsGroupe::all();
            if ($studentsGroup) {
                StudentsGroupe::create([
                    'group_name' => $data['group_name'],
                ]);
                app()->route->redirect('/addGroup');
            }
        }
        return new View('employees.add_group');
    }

//    Добавление дисциплин работает
    public function addDiscipline(Request $request): string
    {
        if ($request->method === 'POST') {
            $data = $request->all();
            $disciplines = Disciplines::all();
            if ($disciplines) {
                Disciplines::create([
                    'discipline_name' => $data['discipline_name'],
                ]);
                app()->route->redirect('/addDiscipline');
            }
        }

        return new View('employees.add_discipline');
    }

    public function addDisciplineGroupe(Request $request): string{
        $groupId = $request->id;
        $discipline_name=Disciplines::all();
        $type_of_control_name=TypeOfControl::all();
        $group = GroupeDisciplines::where('id_group', $request->id)->get();
        if ($request->method === 'POST') {
            $data = $request->all();
            $group = StudentsGroupe::find($data['group_id']);
            $discipline_id = Disciplines::where('name', $data['discipline_name'])->first();
            $id_control = TypeOfControl::where('name', $data['type_of_control_name'])->first();
            if ($group && $id_control && $discipline_id) {
                GroupeDisciplines::create([
                    'group_id' => $group->id,
                    'discipline_id' => $discipline_id->id,
                    'type_of_control_id' => $id_control->id,
                    'number_of_hours' => $data['num_hours'],
                    'cource' => $data['course'],
                    'semester' => $data['semester']
                ]);
                app()->route->redirect('/addDisciplineGroupe');
            }
        }
        $groupName = StudentsGroupe::find($groupId)->name;
        return new View('employees.group', ['group' => $group, 'discipline_name'=>$discipline_name,'type_of_control_name'=>$type_of_control_name, 'groupName' => $groupName, 'groupId' => $groupId, ]);


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
        // Показ только столбца наименований группы
        $groups = StudentsGroupe::select('group_name')->get();
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