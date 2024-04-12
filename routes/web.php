<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello']);
Route::add(['GET', 'POST'], '/addEmployees', [Controller\Admin::class, 'addEmployees'])->middleware('auth', 'role');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'],'/addStudents', [Controller\Employees::class, 'addStudents'])->middleware('auth', 'roleEmployees');
Route::add(['GET', 'POST'],'/addGroup', [Controller\Employees::class, 'addGroup'])->middleware('auth', 'roleEmployees');
Route::add('GET','/groups', [Controller\Employees::class, 'groups'])->middleware('auth', 'roleEmployees');
Route::add(['GET', 'POST'],'/addDiscipline', [Controller\Employees::class, 'addDiscipline'])->middleware('auth', 'roleEmployees');
Route::add('GET','/student', [Controller\Employees::class, 'vueStudent'])->middleware('auth', 'roleEmployees');
Route::add('GET','/disciplines', [Controller\Employees::class, 'disciplines'])->middleware('auth', 'roleEmployees');
Route::add('GET','/gradeStudents', [Controller\Employees::class, 'gradeStudents'])->middleware('auth', 'roleEmployees');
