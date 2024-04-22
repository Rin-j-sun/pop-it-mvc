<?php

namespace Controller;

use Model\TypeOfControl;
use Model\Disciplines;
use Model\GroupeDisciplines;
use Model\Group;
use Model\Student;
use Model\StudentsGroupe;
use Model\User;
use Src\Auth\Auth;
use Src\Request;
use Validator\Validator;
use Src\View;

class Api
{
    public function index(): void
    {
        $students = Student::all()->toArray();

        (new View())->toJSON($students);
    }

    public function echo(Request $request): void
    {
        (new View())->toJSON(Auth::user()->toArray());
    }

//    Исправлено
    public function login(Request $request): void
    {
        $data = $request->all();
        if (Auth::attempt($data)) {
            $user = Auth::user();
            $token = bin2hex(random_bytes(25));
            $user->token = ($token);
            $user->save();
            (new View())->toJSON(['token' => $token, 'message' => 'Вы авторизованы'], 200);
        }

        (new View())->toJSON(['message' => 'Вы неавторизованы'], 401);
    }

//    Исправлено
    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->token = '';
        $user->save();
        (new View())->toJSON(['message' => 'Успешный выход из аккаунта'], 200);
    }


//    Здесь функция добавления студента

    public function addStudents(Request $request): string
    {
        $select_groups = StudentsGroupe::all();
        $select_students = Student::all();

        if ($request->method === 'POST') {
            $validator = new \Validator\Validator($request->all(), [
                'surname' => ['cyrillic', 'required:students,surname'],
                'name' => ['cyrillic', 'required:students,name'],
                'patronymic' => ['patronymic'],
                'gender' => ['required'],
                'birthdate' => ['required'],
                'adress' => ['cyrillic', 'required'],
                'group_id' => ['required'],
            ], [
                'required' => 'Поле :attribute пусто',
                'cyrillic' => 'Поле :attribute должно содержать только кириллицу',
            ]);

            if ($validator->fails()) {
                (new View())->toJSON(['message' => $validator->errors()], 422);
            }

            $data = $request->all();
            $studentsGroup = StudentsGroupe::find($data['group_id']);
                Student::create([
                    'surname' => $data['surname'],
                    'name' => $data['name'],
                    'patronymic' => $data['patronymic'],
                    'gender' => $data['gender'],
                    'birthdate' => $data['birthdate'],
                    'adress' => $data['adress'],
                    'users_groupe' => $studentsGroup->id
                ]);
                if ($studentsGroup) {
                    (new View())->toJSON(['message' => 'Студент успешно добавлен !'], 200);
                }
            }

        (new View())->toJSON($request->all());
//        return new View('employees.add_students', ['select_groups' => $select_groups, 'select_students' => $select_students]);
    }
}

