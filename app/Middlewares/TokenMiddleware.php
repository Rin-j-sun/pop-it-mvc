<?php

namespace Middlewares;


use Model\User;
use Src\Auth\Auth;
use Src\Request;
use Src\View;
use function PHPUnit\Framework\isEmpty;


class TokenMiddleware
{
    public function handle(Request $request)
    {
        $headers = getallheaders() ?? [];
        if (isset($headers['Authorization'])) {
            $token = explode(' ', $headers['Authorization'])[1];
            $user = User::where('token', $token)->first();
            if ($user) {
                Auth::login($user);
                return;
            }
        }
        (new View())->toJSON(['message' => 'Вы не авторизованы!'], 401);

    }
}