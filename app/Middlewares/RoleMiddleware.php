<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class RoleMiddleware
{
    public function handle(Request $request)
    {
        //Если пользователь не админ, то редирект на главную страницу
        if (!Auth::checkRole()) {
            app()->route->redirect('/hello');
        }
    }

}
