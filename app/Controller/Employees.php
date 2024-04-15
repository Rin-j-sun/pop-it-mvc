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
    //    Добавление студентов готово
    public function addStudents(Request $request): string
    {
        $select_groups = StudentsGroupe::all();
        $select_students = Student::all();
        if ($request->method === 'POST') {
            $data = $request->all();
            $studentsGroup = StudentsGroupe::find($data['group_id']);
            if ($studentsGroup) {
                Student::create([
                    'surname' => $data['surname'],
                    'name' => $data['name'],
                    'patronymic' => $data['patronymic'],
                    'gender' => $data['gender'],
                    'birthdate' => $data['birthdate'],
                    'adress' => $data['adress'],
                    'users_groupe' => $studentsGroup->id
                ]);
                app()->route->redirect('/addStudents');
            }
        };
        return new View('employees.add_students', ['select_groups' => $select_groups, 'select_students' => $select_students]);
    }

//    Добавление групп работает
    public function addGroup(Request $request): string{

        $select_groups = StudentsGroupe::all();

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
        return new View('employees.add_group', ['select_groups' => $select_groups]);
    }

//    Добавление дисциплин работает
    public function addDiscipline(Request $request): string
    {
        $select_disciplines = Disciplines::all();
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

        return new View('employees.add_discipline',  ['select_disciplines' => $select_disciplines]);
    }

//    Добавление дисциплины к группе работает
    public function addDisciplineGroupe(Request $request): string{

        $select_groups = StudentsGroupe::all();
        $discipline_name=Disciplines::all();
        $type_of_control_name=TypeOfControl::all();
        if ($request->method === 'POST') {
            $data = $request->all();
            $studentsGroup = StudentsGroupe::find($data['group_name']);
            $discipline_id = Disciplines::where('discipline_name', $data['discipline_name'])->first();
            $type_of_control_id = TypeOfControl::where('type_of_control_name', $data['type_of_control_name'])->first();
                GroupeDisciplines::create([
                    'group_id' => $studentsGroup->id,
                    'discipline_id' => $discipline_id->discipline_id,
                    'type_of_control_id' => $type_of_control_id->type_of_control_id,
                    'number_of_hours' => $data['number_of_hours'],
                    'cource' => $data['cource'],
                    'semester' => $data['semester']
                ]);
        }
        return new View('employees.add_discipline_groupe', ['select_groups' => $select_groups, 'discipline_name'=>$discipline_name,'type_of_control_name'=>$type_of_control_name]);

    }

//Просмотр студентов
    public function students(Request $request): string
    {
        $students=Student::all();
        return new View('employees.students', ['students'=>$students]);
    }

// Просмотр групп
    public function groups(Request $request): string {
        return new View('employees.groups');
    }

//    Просмотр дисциплин
    public function disciplines(Request $request): string
    {

        return new View('employees.disciplines');
    }

//    Успеваемость студентов фильтрация
    public function gradeStudents(Request $request, $gradesQuery): string
    {
        $select_groups = StudentsGroupe::all();
        $discipline_name=Disciplines::all();
        $select_students = Student::all();
        $grades = $gradesQuery->get();
        $gradeList = [];
        $notEmpty=false;
        foreach ($grades as $grade) {
            // Если есть оценка, добавляем информацию о студенте, группе, дисциплине и оценке
            if ($grade->evaluations) {
                $studentName = $grade->student->surname . ' ' . $grade->student->name . ' ' . $grade->student->patronymic;
                $groupName = $grade->disciplinesGroup->info_group->name;
                $disciplineName = $grade->disciplinesGroup->discipline->name;
                $evaluation = $grade->evaluations->evaluation;

                $gradeList[] = [
                    'student' => $studentName,
                    'group' => $groupName,
                    'discipline' => $disciplineName,
                    'evaluation' => $evaluation
                ];
                $notEmpty=true;
            }
        }
        if (empty($gradeList)) {
            return new View('employees.grade_students', [
                'select_group' => $select_group,
                'discipline_name' => $discipline_name,
                'notEmpty'=>$notEmpty
            ]);
        }
        return new View('employees.grade_students', [
            'gradeList' => $gradeList,
            'select_group' => $select_group,
            'discipline_name' => $discipline_names,
            'notEmpty'=>$notEmpty
        ]);

       return new View('employees.grade_students' , ['select_students' => $select_students, 'select_groups' => $select_groups, 'discipline_name'=>$discipline_name, 'select_groups' => $select_groups]);
    }

    //    Страница студента
    public function vueStudent(Request $request): string
    {
        return new View('employees.student');
    }

}