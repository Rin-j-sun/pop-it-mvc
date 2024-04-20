<?php

use Model\User;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
class AdminFunctionTest extends TestCase
{
    #[DataProvider('additionProvider')]
//Тест на проверку регистрации (создания нового сотрудника)

    public function testAddEmployee(string $httpMethod, array $userData, string $message): void
    {
        //Берём любой существующий логин из базы данных
        if ($userData['login'] === 'cat2') {
            $userData['login'] = User::get()->first()->login;
        }

        // Создаем заглушку для класса Request.
        $request = $this->createMock(\Src\Request::class);
        // Переопределяем метод all() и свойство method
        $request->expects($this->any())
            ->method('all')
            ->willReturn($userData);
        $request->method = $httpMethod;

        //Сохраняем результат работы метода в переменную
        $result = (new \Controller\Admin())->addEmployees($request);

        if (!empty($result)) {
            //Проверяем варианты с ошибками валидации
            $message = '/' . preg_quote($message, '/') . '/';
            $this->expectOutputRegex($message);
            return;
        }

        //Проверяем добавился ли пользователь в базу данных
        $this->assertTrue((bool)User::where('login', $userData['login'])->count());
        //Удаляем созданного пользователя из базы данных
        User::where('login', $userData['login'])->delete();
    }

    //Метод, возвращающий набор тестовых данных
    public static function additionProvider(): array
    {
        return [
            ['GET', ['login' => '', 'password' => ''], '<h3></h3>'],
            ['POST', ['login' => '', 'password' => ''], '<h3>{"login":["Поле login пусто","Логин должен содержать от 5 до 8 символов","Логин должен содержать только английские буквы и цифры"],"password":["Поле password пусто","Пароль должен содержать от 8 до 20 символов","Логин должен содержать только английские буквы и цифры"]}</h3>'],
            ['POST', ['login' => 'пользователь', 'password' => ''], '<h3>{"login":["Логин должен содержать от 5 до 8 символов","Логин должен содержать только английские буквы и цифры"],"password":["Поле password пусто","Пароль должен содержать от 8 до 20 символов","Логин должен содержать только английские буквы и цифры"]}</h3>'],
            ['POST', ['login' => 'testusr', 'password' => '123'], '<h3>{"password":["Пароль должен содержать от 8 до 20 символов"]}</h3>'],
            ['POST', ['login' => 'cat2', 'password' => '987654321'], '<h3>{"login":["Поле login должно быть уникальным"]}</h3>'],
        ];
    }

    //Настройка конфигурации окружения
    protected function setUp(): void
    {
        //Установка переменной среды
        $_SERVER['DOCUMENT_ROOT'] = '/srv/users/rpyxnfsi/kagnufd-m1';

        //Создаем экземпляр приложения
        $GLOBALS['app'] = new Src\Application(new Src\Settings([
            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/pop-it-mvc/config/app.php',
            'db' => include $_SERVER['DOCUMENT_ROOT'] . '/pop-it-mvc/config/db.php',
            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/pop-it-mvc/config/path.php',
        ]));

        //Глобальная функция для доступа к объекту приложения
        if (!function_exists('app')) {
            function app()
            {
                return $GLOBALS['app'];
            }
        }
    }

}