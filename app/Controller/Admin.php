<?php

namespace Controller;

use Src\Validator\Validator;
use Src\View;
use Src\Request;
use Model\User;

class Admin
{
    public function addEmployees(Request $request): string
    {
        if ($request->method === 'POST') {
            // Определяем правила валидации
            $validator = new Validator($request->all(), [
                'login' => ['required', 'unique:users,login', 'usernameLength', 'passwordComplexity::users,login'],
                'password' => [
                    'required', 'passwordLength', 'passwordComplexity::users,password'
                ],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникальным',
                'passwordLength' => 'Пароль должен содержать от 8 до 20 символов',
                'passwordComplexity' => 'Пароль должен содержать только английские буквы и цифры',
                'passwordComplexity' => 'Логин должен содержать только английские буквы и цифры',
                'usernameLength' => 'Логин должен содержать от 5 до 8 символов',
            ]);

            // Если валидация не прошла, возвращаем страницу с ошибками валидации
            if ($validator->fails()) {
                return new View('admin.add_employees', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            // Если валидация прошла успешно, создаем нового пользователя
            if (User::create($request->all())) {
                app()->route->redirect('/hello');
            }
        }

        // Возвращаем представление для добавления сотрудников
        return new View('admin.add_employees');
    }

}
