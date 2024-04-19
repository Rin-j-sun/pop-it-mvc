<?php

use Model\User;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SiteTest extends TestCase
{

    #[DataProvider('additionProvider')]


    public function testAddEmployees(string $httpMethod, array $userData, string $message): void
    {
        // Подготовка данных для теста
        $userData = [
            'login' => 'testuser',
            'password' => 'passw123',
        ];

        // Создание заглушки для класса Request.
        $request = $this->createMock(\Src\Request::class);
        // Переопределяем метод all() и свойство method
        $request->expects($this->any())
            ->method('all')
            ->willReturn($userData);
        $request->method = 'POST';

        // Вызов метода контроллера для добавления сотрудника
        $controller = new \Controller\Admin();
        $result = $controller->addEmployees($request);

        // Проверка результата
        if ($result instanceof Src\View) {
            // Ошибка валидации
            $this->assertStringContainsString('<h3>', $result->render());
        } else {
            // Проверка успешного добавления сотрудника
            $this->assertTrue((bool)User::where('login', $userData['login'])->count());
            // Удаление созданного пользователя из базы данных
            User::where('login', $userData['login'])->delete();
        }
    }


    //Метод, возвращающий набор тестовых данных
    public static function additionProvider(): array
    {
        return [
            ['GET', ['login' => '', 'password' => ''], '<h3></h3>'],
            ['POST', ['login' => '', 'password' => ''], '<h3>{"login":["Поле login пусто","Поле login использует кириллицу"],"password":["Поле password пусто","Пароль должен содержать минимум 8 символов","Поле password использует кириллицу"]}</h3>'],
            ['POST', ['login' => 'sabrina5', 'password' => '987654321'], '<h3>{"login":["Поле login должно быть уникально"]}</h3>'],
            ['POST', ['login' => md5(time()), 'password' => 'admin1'], 'Location: /pop-it-mvc/hello'],
        ];
    }

    //Настройка конфигурации окружения
    protected function setUp(): void
    {
        //Установка переменной среды
        $_SERVER['DOCUMENT_ROOT'] = '/xampp/htdocs';

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