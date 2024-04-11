<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\User;


class Admin
{
    public function addEmployees(Request $request): string
    {
        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/hello');
        }
        return new View('admin.add_employees');
    }
}