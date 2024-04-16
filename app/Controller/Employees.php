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
    //    Добавление студентов готово и валидатор на кириллицу работает, но ломается столбец вывода студентов
    public function addStudents(Request $request): string
    {
        $select_groups = StudentsGroupe::all();
        $select_students = Student::all();

        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'surname' => ['cyrillic','required:students,surname'],
                'name' => ['cyrillic','required:students,name'],
                'patronymic' => ['patronymic'],
                'gender' => ['required'],
                'birthdate' => ['required'],
                'adress' => ['cyrillic','required'],
                'group_id' => ['required'],
            ], [
                'required' => 'Поле :attribute пусто',
                'cyrillic' => 'Поле :attribute должно содержать только кириллицу',
            ]);

            if ($validator->fails()) {
                return new View('employees.add_students', [
                    'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)
                ]);
            }

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
        }

        return new View('employees.add_students', ['select_groups' => $select_groups, 'select_students' => $select_students]);
    }

//    Добавление групп работает и валидатор тоже
    public function addGroup(Request $request): string
    {
        $select_groups = StudentsGroupe::all();

        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'group_name' => ['required']
            ], [
                'required' => 'Поле :field должно быть заполнено'
            ]);

            if ($validator->fails()) {
                return new View('employees.add_group', ['select_groups' => $select_groups, 'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

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


//    Добавление дисциплин работает и валидатор тоже
    public function addDiscipline(Request $request): string
    {
        // Получаем все дисциплины
        $select_disciplines = Disciplines::all();

        // Проверяем, была ли отправлена форма методом POST
        if ($request->method === 'POST') {
            // Определяем правила валидации
            $validator = new Validator($request->all(), [
                'discipline_name' => ['required']
            ], [
                'required' => 'Поле :attribute должно быть заполнено'
            ]);

            // Если валидация не прошла, возвращаем страницу с ошибками валидации
            if ($validator->fails()) {
                return new View('employees.add_discipline', ['select_disciplines' => $select_disciplines, 'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            // Если валидация прошла успешно, создаем новую дисциплину
            $data = $request->all();
            $disciplines = Disciplines::all();
            if ($disciplines) {
                Disciplines::create([
                    'discipline_name' => $data['discipline_name'],
                ]);
                app()->route->redirect('/addDiscipline');
            }
        }

        // Возвращаем представление для добавления дисциплины
        return new View('employees.add_discipline', ['select_disciplines' => $select_disciplines]);
    }

//    Метод поиска дисциплин по названию готово
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




//    Добавление дисциплины к группе работает и валидатор уникальности дисциплины не работает
    public function addDisciplineGroupe(Request $request): string
    {
        // Получаем все группы, дисциплины и типы контроля
        $select_groups = StudentsGroupe::all();
        $discipline_name = Disciplines::all();
        $type_of_control_name = TypeOfControl::all();
        $cource = GroupeDisciplines::all();
        $semester = GroupeDisciplines::all();
        $data = $request->all();

        // Проверяем, была ли отправлена форма методом POST
        if ($request->method === 'POST') {
            // Определяем правила валидации
            $validator = new Validator($request->all(), [
                'group_name' => ['required'],
                'discipline_name' => [
                    function ($attribute, $value, $fail) use ($request) {
                        // Проверка уникальности дисциплины для данной группы
                        $groupId = $request->select('group_name');
                        if (!empty($groupId)) {
                            $exists = Capsule::table('groupe_disciplines')
                                ->where('group_id', $groupId)
                                ->where('discipline_id', $value)
                                ->exists();

                            if ($exists) {
                                $fail('Такая дисциплина уже есть у группы');
                            }
                        }
                    },
                    'required',
                ],
                'type_of_control_name' => ['required'],
                'number_of_hours' => ['required'],
                'cource' => ['required', 'course'],
                'semester' => ['required', 'semester']
            ], [
                'required' => 'Поле :attribute должно быть заполнено',
                'course' => 'Номер курса не может превышать 6',
                'semester' => 'Номер семестра не может превышать 12',
                'uniquenessDiscipline' => 'Такая дисциплина уже есть у группы',
            ]);

            // Если валидация не прошла, возвращаем страницу с ошибками валидации
            if ($validator->fails()) {
                return new View('employees.add_discipline_groupe', [
                    'select_groups' => $select_groups,
                    'discipline_name' => $discipline_name,
                    'type_of_control_name' => $type_of_control_name,
                    'cource' => $cource,
                    'semester' => $semester,
                    'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)
                ]);
            }

            // Если валидация прошла успешно, создаем новую запись в таблице
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

            // Перенаправляем пользователя на страницу добавления дисциплин
            app()->route->redirect('/addDiscipline');
        }

        // Возвращаем представление для добавления дисциплин групп
        return new View('employees.add_discipline_groupe', [
            'select_groups' => $select_groups,
            'discipline_name' => $discipline_name,
            'type_of_control_name' => $type_of_control_name
        ]);
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

//    Успеваемость студентов фильтрация не работает
    public function gradeStudents(Request $request, $gradesQuery): string
    {
        $select_groups = StudentsGroupe::all();
        $discipline_name = Disciplines::all();
        $select_students = Student::all();




        // Pass data to the view for rendering
        return new View('employees.grade_students', [
            'select_students' => $select_students,
            'select_groups' => $select_groups,
            'discipline_name' => $discipline_name,
        ]);
}


    //    Страница студента и его оценивания не работает
    public function vueStudent(Request $request): string
    {
        $select_students = Student::all();
        $select_groups = StudentsGroupe::all();
        $select_balls = Evaluations::all();
        $discipline_name = Disciplines::all();

        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'discipline_name' => ['required'],
                'ball' => ['required'],
            ], [
                'required' => 'Поле :attribute пусто',
            ]);

            if ($validator->fails()) {
                return new View('employees.student', [
                    'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)
                ]);
            }

            $data = $request->all();
            $studentsGroup = StudentsGroupe::find($data['group_id']);
            if ($studentsGroup) {
                GroupeGrade::create([
                    'groupe_discipline_id' => $data['groupe_discipline_id'],
                    'evaluations_id' => $data['evaluations_id'],
                    'data' => $data['data'],
                    'student_id' => $data['student_id'],
                ]);
                app()->route->redirect('/student');
            }
        }

        return new View('employees.student', [
            'select_groups' => $select_groups,
            'discipline_name' => $discipline_name,
            'select_students' => $select_students,
            'select_balls' => $select_balls,
        ]);
    }

    //    Страница студентов в группе не работает
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