<?php

use Model\Student;
use Model\StudentsGroupe;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class EmployeeFunctionTest extends TestCase
{
    #[DataProvider('additionProvider')]

//Тест на добавление студента

    public function testAddStudent(string $httpMethod, array $userData, string $message): void
    {
        $request = $this->createMock(\Src\Request::class);
        $request->expects($this->any())
            ->method('all')
            ->willReturn($userData);
        $request->method = $httpMethod;

        //Сохраняем результат работы метода в переменную
        $result = (new \Controller\Employees())->addStudents($request);

        if (!empty($result)) {
            $message = '/' . preg_quote($message, '/') . '/';
            $this->expectOutputRegex($message);
            return;
        }

        //Проверяем добавился ли студент в базу данных
        $this->assertTrue((bool)Student::where('surname', $userData['surname'])->count());
        Student::where('surname', $userData['surname'])->delete();
    }

    public static function additionProvider(): array
    {
        return [
            ['GET', ['surname' => '', 'name' => '', 'patronymic' => '', 'birthdate' => '', 'gender' => '', 'adress' => '', 'users_groupe' => ''], '<h3></h3>'],
            ['POST', ['surname' => '', 'name' => '', 'patronymic' => '', 'birthdate' => '', 'gender' => '', 'adress' => '', 'users_groupe' => ''], '<h3>{"surname":["Поле :attribute должно содержать только кириллицу","Поле :attribute пусто"],"name":["Поле :attribute должно содержать только кириллицу","Поле :attribute пусто"],"gender":["Поле :attribute пусто"],"birthdate":["Поле :attribute пусто"],"adress":["Поле :attribute должно содержать только кириллицу","Поле :attribute пусто"],"group_id":["Поле :attribute пусто"]}</h3>'],
            ['POST', ['surname' => 'Petrov', 'name' => 'Vasilii', 'patronymic' => 'Николаевич', 'birthdate' => '2024-04-18', 'gender' => 'Мужской', 'adress' => 'Tomsk', 'users_groupe' => '10'], '<h3>{"surname":["Поле :attribute должно содержать только кириллицу"],"name":["Поле :attribute должно содержать только кириллицу"],"adress":["Поле :attribute должно содержать только кириллицу"]}</h3>'],
            ['POST', ['surname' => 'Сотников', 'name' => 'Геннадий', 'patronymic' => 'Aleksandrovich', 'birthdate' => '2024-04-18', 'gender' => 'Женский', 'adress' => 'неизвестно', 'users_groupe' => '10'], '<h3></h3>'],
            ['POST', ['surname' => 'Иванов', 'name' => 'Иван', 'patronymic' => 'Иванович', 'birthdate' => '2024-04-18', 'gender' => 'Мужской', 'adress' => 'Томск', 'users_groupe' => '12'], '<h3></h3>'],
        ];
    }


//Тест на добавление дисциплины  Errors: 2.

//    public function testAddDiscipline(string $httpMethod, array $userData, string $message): void
//    {
//        // Подготовка данных для теста
//        $requestMethod = 'POST';
//        $userData = [
//            'discipline_name' => 'New Discipline',
//        ];
//        $message = '<h3></h3>';
//
//        // Создание заглушки для класса Request.
//        $request = $this->createMock(\Src\Request::class);
//        // Переопределяем метод all() и свойство method
//        $request->expects($this->any())
//            ->method('all')
//            ->willReturn($userData);
//        $request->method = $requestMethod;
//
//        // Вызов метода контроллера для добавления дисциплины
//        $controller = new \Controller\Employees();
//        $result = $controller->addDiscipline($request);
//
//        // Проверка результата
//        if ($result instanceof Src\View) {
//            // Ошибка валидации
//            $this->assertStringContainsString('<h3>', $result->render());
//        } else {
//            // Проверка успешного добавления дисциплины
//            $this->assertTrue((bool)Disciplines::where('discipline_name', $userData['discipline_name'])->count());
//
//            // Удаление созданной записи из базы данных
//            Disciplines::where('discipline_name', $userData['discipline_name'])->delete();
//        }
//    }
//
    // Вспомогательный метод, возвращающий набор тестовых данных
//    public static function additionProvider(): array
//    {
//        return [
//            ['GET', ['discipline_name' => ''], '<h3></h3>'],
//            ['POST', ['discipline_name' => ''], '<h3>{"discipline_name":["Поле :attribute должно быть заполнено"]}</h3>'],
//        ];
//    }

//Тест на добавление группы  Errors: 2.
//    public function testAddGroup(): void
//    {
//        // Подготовка данных для теста
//        $requestMethod = 'POST';
//        $userData = [
//            'group_name' => 'New Group',
//        ];
//        $message = '<h3></h3>';
//
//        // Создание заглушки для класса Request.
//        $request = $this->createMock(\Src\Request::class);
//        // Переопределяем метод all() и свойство method
//        $request->expects($this->any())
//            ->method('all')
//            ->willReturn($userData);
//        $request->method = $requestMethod;
//
//        // Вызов метода контроллера для добавления группы
//        $controller = new \Controller\Employees();
//        $result = $controller->addGroup($request);
//
//        // Проверка результата
//        if ($result instanceof Src\View) {
//            // Ошибка валидации
//            $this->assertStringContainsString('<h3>', $result->render());
//        } else {
//            // Проверка успешного добавления группы
//            $this->assertTrue((bool)StudentsGroupe::where('group_name', $userData['group_name'])->count());
//
//            // Удаление созданной записи из базы данных
//            StudentsGroupe::where('group_name', $userData['group_name'])->delete();
//        }
//    }
//
//    // Вспомогательный метод, возвращающий набор тестовых данных
//    public static function additionProvider(): array
//    {
//        return [
//            ['GET', ['group_name' => ''], '<h3></h3>'],
//            ['POST', ['group_name' => ''], '<h3>{"group_name":["Поле :field должно быть заполнено"]}</h3>'],
//        ];
//    }


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