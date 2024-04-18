<?php

namespace Controller;

use Couchbase\Group;
use DateTime;
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
use Carbon\Carbon;

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
                return new View('employees.add_students',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
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
        return new View('employees.disciplines_search', ['select_disciplines' => $select_disciplines, 'message' => $message, 'request' => $request,]);
    }




//    Добавление дисциплины к группе работает и валидатор уникальности дисциплины не работает
    public function addDisciplineGroupe(Request $request): string
    {
        // Получаем все группы, дисциплины и типы контроля
        $select_groups = StudentsGroupe::all();
        $discipline_name = Disciplines::all();
        $type_of_control_name = TypeOfControl::all();
        $course = GroupeDisciplines::all();
        $semester = GroupeDisciplines::all();
        $data = $request->all();

        // Проверяем, была ли отправлена форма методом POST
        if ($request->method === 'POST') {
            // Определяем правила валидации
            $validator = new Validator($request->all(), [
                'group_name' => ['required'],
                'discipline_name' => [
                   'required',
                ],
                'type_of_control_name' => ['required'],
                'number_of_hours' => ['required'],
                'course' => ['required', 'course'],
                'semester' => ['required', 'semester']
            ], [
                'required' => 'Поле :attribute должно быть заполнено',
                'course' => 'Номер курса не может превышать 6',
                'semester' => 'Номер семестра не может превышать 12',
            ]);

            // Если валидация не прошла, возвращаем страницу с ошибками валидации
            if ($validator->fails()) {
                return new View('employees.add_discipline_groupe', [
                    'select_groups' => $select_groups,
                    'discipline_name' => $discipline_name,
                    'type_of_control_name' => $type_of_control_name,
                    'course' => $course,
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
                'course' => $data['course'],
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


    public function disciplineFiltering(Request $request): string
    {
        // Получаем данные из формы фильтров
        $course = $request->get('course');
        $semester = $request->get('semester');

        // Получаем дисциплины из базы данных с учетом фильтров
        $query = GroupeDisciplines::query();

        // Фильтрация по курсу
        if ($course) {
            $query->where('course', $course);
        }

        // Фильтрация по семестру
        if ($semester) {
            $query->where('semester', $semester);
        }

        // Получаем отфильтрованные дисциплины
        $select_disciplines = $query->get();

        // Передаем данные в представление
        return new View('employees.disciplineFiltering', [
            'select_disciplines' => $select_disciplines,
        ]);
    }





//    Фильтрация студентов работает
    public function gradeStudents(Request $request): string
    {

        $groupsGrades = StudentsGroupe::all();
        $disciplinesGrades = Disciplines::all();
        // Получаем все оценки со связанными моделями группы, студента и дисциплины
        $gradesQuery = GroupeGrade::with('disciplinesGroup.info_group', 'student', 'evaluations');
        if ($request->method === 'POST') {
            if ($request->get('groups')) {
                $groupId = $request->get('groups');
                // Добавляем условие фильтрации по выбранной группе
                $gradesQuery->whereHas('disciplinesGroup.info_group', function ($query) use ($groupId) {
                    $query->where('id', $groupId);
                });
            }
            if ($request->get('disciplines')) {
                $disciplineId = $request->get('disciplines');
                // Добавляем условие фильтрации по выбранной дисциплине
                $gradesQuery->whereHas('disciplinesGroup', function ($query) use ($disciplineId) {
                    $query->where('discipline_id', $disciplineId);
                });
            }
        }
        $grades = $gradesQuery->get();
        $gradeList = [];
        $notEmpty=false;
        foreach ($grades as $grade) {
            // Если есть оценка, добавляем информацию о студенте, группе, дисциплине и оценке
            if ($grade->evaluations) {
                $studentName = $grade->student->surname . ' ' . $grade->student->name . ' ' . $grade->student->patronymic;
                $groupName = $grade->disciplinesGroup->info_group->group_name;
                $disciplineName = $grade->disciplinesGroup->discipline->discipline_name;
                $evaluation = $grade->evaluations->balls;

                $studentId=$grade->student->id;

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
            return new View('employees.grade_students',  [
                'groupsGrades' => $groupsGrades,
                'disciplinesGrades' => $disciplinesGrades,
                'notEmpty'=>$notEmpty,
                'studentId'=>$studentId
            ]);
        }
        return new View('employees.grade_students',  [
            'gradeList' => $gradeList,
            'groupsGrades' => $groupsGrades,
            'disciplinesGrades' => $disciplinesGrades,
            'notEmpty'=>$notEmpty,
            'studentId'=>$studentId
        ]);

    }







    //    Страница студента и его оценивания не отправляется id студента
    public function vueStudent(Request $request): string
    {
        $select_balls = Evaluations::all();
        $studentId = $request->id;
        $studentInfo = Student::find($studentId);
        $studentName = $studentInfo->surname . ' ' . $studentInfo->name . ' ' . $studentInfo->patronymic;
        $groupName = $studentInfo->group->name;
        $groupId = $studentInfo->group->id;
        $disciplinesGroup = GroupeDisciplines::where('group_id', $groupId)->get();

        // Получение оценок студента
        $grades = GroupeGrade::where('student_id', $studentId)->get();

        $studentGrades = GroupeGrade::where('student_id', $studentId)
            ->with('student', 'evaluations', 'disciplinesGroup')
            ->get();


        // Проверка наличия оценки у студента по каждой дисциплине
        $hasGrade = [];
        foreach ($disciplinesGroup as $disciplineGroup) {
            $hasGrade[$disciplineGroup->discipline_grope_id] = $grades->where('groupe_discipline_id', $disciplineGroup->discipline_grope_id)->isNotEmpty();
        }

        $date = new DateTime();
        if ($request->method === 'POST') {
            $disciplineGroupId = $request->get('disciplineGroupId');
            $evaluationName = $request->get('evaluationName');
            $selectedEvaluation = Evaluations::where('balls', $evaluationName)->first();

            if ($selectedEvaluation) {
                $evaluationId = $selectedEvaluation->id;

                // Проверка, существует ли уже оценка у студента по выбранной дисциплине
                $existingGrade = GroupeGrade::where('groupe_discipline_id', $disciplineGroupId)
                    ->where('student_id', $studentId);

                if ($existingGrade->exists()) {
                    // Обновление существующей оценки
                    $existingGrade->update([
                        'evaluations_id' => $evaluationId,
                        'data' => $date
                    ]);
                } else {
                    // Создание новой оценки
                    GroupeGrade::create([
                        'groupe_discipline_id' => $disciplineGroupId,
                        'student_id' => $studentId,
                        'evaluations_id' => $evaluationId,
                        'data' => $date
                    ]);
                }
            }

            app()->route->redirect('/student?id=' .  $studentId);
        }



        return new View('employees.student', [
            'disciplinesGroup' => $disciplinesGroup,
            'studentName' => $studentName,
            'groupName' => $groupName,
            'select_balls' => $select_balls,
            'studentGrade' => $studentGrades,
        ]);
    }


    //    Страница студентов в группе не работает
    public function groupInf(Request $request): string
    {
        // Получаем id группы из запроса
        $groupId = $request->get('id');

        // Используем $groupId для получения информации о группе из базы данных
        $studentsGroup = StudentsGroupe::find($groupId);

        // Получаем список студентов для этой группы
        $students = $studentsGroup->students;

        // Возвращаем представление с информацией о группе и списком студентов
        return new View('employees.group_info', ['studentsGroup' => $studentsGroup, 'students' => $students]);
    }



}