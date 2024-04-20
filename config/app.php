<?php
return [
    //Класс аутентификации
    'auth' => \Src\Auth\Auth::class,
    //Клас пользователя
    'identity' => \Model\User::class,
    //Классы для middleware
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
        'role' => \Middlewares\RoleMiddleware::class,
        'roleEmployees' => \Middlewares\RoleEmployeesMiddleware::class,
    ],

    'validators' => [
    'required' => \Validators\RequireValidator::class,
    'unique' => \Validators\UniqueValidator::class,
    'usernameLength'=>\Validators\UsernameLengthValidator::class,
    'uniquenessDiscipline'=>\Validators\UniquenessDisciplineValidator::class,
    'passwordLength'=>\Validators\PasswordLengthValidator::class,
    'passwordComplexity'=>\Validators\PasswordComplexityValidator::class,
    'cyrillic'=>\Validators\CyrillicValidator::class,
],

    'routeAppMiddleware' => [
        'csrf' => \Middlewares\CSRFMiddleware::class,
        'trim' => \Middlewares\TrimMiddleware::class,
        'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
    ],

    'providers' => [
        'kernel' => \Providers\KernelProvider::class,
        'route' => \Providers\RouteProvider::class,
        'db' => \Providers\DBProvider::class,
        'auth' => \Providers\AuthProvider::class,
    ],


];
