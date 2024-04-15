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

//    Метод поиска дисциплин по названию
    public function searchDisciplines(Request $request): string
    {
        $message = null;
        $select_disciplines = [];

        // Check if the request method is POST
        if ($request->method === 'POST') {
            // Get the search term from the request
            $searchTerm = $request->get('search');

            // If a search term is provided, perform the search
            if ($searchTerm) {
                // Perform the search for disciplines by name
                $select_disciplines = Disciplines::where('discipline_name', 'like', '%' . $searchTerm . '%')->get();
            }

            // If no disciplines are found, set a message
            if ($select_disciplines->isEmpty()) {
                $message = 'Дисциплины с таким названием отсутствуют';
            }
        } else {
            // If the request method is not POST, fetch all disciplines
            $select_disciplines = Disciplines::all();
        }

        // Return the view with the filtered disciplines and the message
        return new View('employees.disciplines_search', ['select_disciplines' => $select_disciplines, 'message' => $message]);
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

// Просмотр групп реализовано успешно
    public function groups(Request $request): string {

        $select_groups = StudentsGroupe::all();

        return new View('employees.groups', ['select_groups' => $select_groups]);
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
        $discipline_name = Disciplines::all();
        $select_students = Student::all();

        // Initialize query with eager loading relationships
        $gradesQuery = $gradesQuery->with(['student', 'disciplinesGroup.info_group', 'disciplinesGroup.discipline', 'evaluations']);

        // Apply filters if provided
        if ($request->isMethod('post')) {
            $groupId = $request->input('group_name');
            $disciplineId = $request->input('discipline_name');

            if ($groupId) {
                $gradesQuery->whereHas('disciplinesGroup.info_group', function ($query) use ($groupId) {
                    $query->where('group_id', $groupId);
                });
            }

            if ($disciplineId) {
                $gradesQuery->whereHas('disciplinesGroup.discipline', function ($query) use ($disciplineId) {
                    $query->where('discipline_id', $disciplineId);
                });
            }
        }

        // Fetch filtered grades
        $grades = $gradesQuery->get();

        $gradeList = [];
        $notEmpty = false;

        // Build the list of grades
        foreach ($grades as $grade) {
            // If there's an evaluation, add information about the student, group, discipline, and evaluation
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
                $notEmpty = true;
            }
        }

        // Pass data to the view for rendering
        return new View('employees.grade_students', [
            'gradeList' => $gradeList,
            'select_students' => $select_students,
            'select_groups' => $select_groups,
            'discipline_name' => $discipline_name,
            'notEmpty' => $notEmpty
        ]);
}


    //    Страница студента и его оценивания
    public function vueStudent(Request $request): string
    {
        $select_students = Student::all();
        $discipline_name=Disciplines::all();
        return new View('employees.student');
    }

    //    Страница студентов в группе
    public function groupInf(Request $request): string
    {
        $groupId = $request->id;
        $group = StudentsGroupe::find($groupId);
        $groupName = $group->name;

        // Query to retrieve the list of disciplines for the group with optional filtering
        $groupDisciplinesQuery = GroupeDisciplines::where('group_id', $request->id);

        if ($request->getMethod() === 'POST') {
            $semester = $request->get('semester');
            $course = $request->get('course');

            if (!empty($semester)) {
                $groupDisciplinesQuery->where('semester', $semester);
            }
            if (!empty($course)) {
                $groupDisciplinesQuery->where('course', $course);
            }
        }

        // Execute the query to get the list of group disciplines
        $groupDisciplines = $groupDisciplinesQuery->get();

        // Render the view with the fetched data
        return new View('employees.group', [
            'group' => $groupDisciplines,
            'groupName' => $groupName,
            'groupId' => $groupId,
        ]);

}

}