<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\User;
use Model\Image;
use Src\Auth\Auth;
use Src\Validator\Validator;


class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function hello(Request $request): string
    {
        $images = Image::all();

        if ($request->method === 'POST') {
                $image = $_FILES['image']['name'];
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/pop-it-mvc/public/img/";
                $uploaded_file = $imagePath . basename($image);
                move_uploaded_file($_FILES['image']['tmp_name'], $uploaded_file);

                if (Image::create(['image' => $uploaded_file, 'name' => $image])) {
                    app()->route->redirect('/hello');
                }
        }

        return new View('site.hello', ['message' => 'hello working', 'images' => $images]);
    }

    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
            return false;
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }



}
