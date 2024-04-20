<?php

use Model\Student;
use Model\StudentsGroupe;
use Model\Disciplines;
use Model\TypeOfControl;
use Model\GroupeDisciplines;
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
            ['GET', ['surname' => '', 'name' => '', 'patronymic' => '', 'birthdate' => '', 'gender' => '', 'adress' => '', 'group_id' => ''], '<h3></h3>'],
            ['POST', ['surname' => '', 'name' => '', 'patronymic' => '', 'birthdate' => '', 'gender' => '', 'adress' => '', 'group_id' => ''], '<h3>{"surname":["Поле :attribute должно содержать только кириллицу","Поле :attribute пусто"],"name":["Поле :attribute должно содержать только кириллицу","Поле :attribute пусто"],"gender":["Поле :attribute пусто"],"birthdate":["Поле :attribute пусто"],"adress":["Поле :attribute должно содержать только кириллицу","Поле :attribute пусто"],"group_id":["Поле :attribute пусто"]}</h3>'],
            ['POST', ['surname' => 'Petrov', 'name' => 'Vasilii', 'patronymic' => 'Николаевич', 'birthdate' => '2024-04-18', 'gender' => 'Мужской', 'adress' => 'Tomsk', 'group_id' => '10'], '<h3>{"surname":["Поле :attribute должно содержать только кириллицу"],"name":["Поле :attribute должно содержать только кириллицу"],"adress":["Поле :attribute должно содержать только кириллицу"],"group_id":["Поле :attribute пусто"]}</h3>'],
            ['POST', ['surname' => 'Сотников', 'name' => 'Геннадий', 'patronymic' => 'Aleksandrovich', 'birthdate' => '2024-04-18', 'gender' => 'Женский', 'adress' => 'неизвестно', 'group_id' => '10'], '<h3></h3>'],
        ];
    }

//Тест на прикрепление дисциплины к группе

//    public function testAddDisciplinesGroup(string $httpMethod, array $userData, string $message): void
//    {
//        $request = $this->createMock(\Src\Request::class);
//        $request->expects($this->any())
//            ->method('all')
//            ->willReturn($userData);
//        $request->method = $httpMethod;
//
//        //Сохраняем результат работы метода в переменную
//        $result = (new \Controller\Employees())->addDisciplineGroupe($request);
//
//        if (!empty($result)) {
//            $message = '/' . preg_quote($message, '/') . '/';
//            $this->expectOutputRegex($message);
//            return;
//        }
//
//        //Проверяем прикрепилась ли дисциплина к группе
//        $this->assertTrue((bool)GroupeDisciplines::where('group_id', $userData['group_id'])->count());
//        GroupeDisciplines::where('group_id', $userData['group_id'])->delete();
//    }
//
//    public static function additionProvider(): array
//    {
//        return [
//            ['GET', ['group_id' => '', 'discipline_id' => '', 'type_of_control_id' => '', 'number_of_hours' => '', 'course' => '', 'semester' => ''], '<h3>{"group_name":["Поле :attribute должно быть заполнено"],"discipline_name":["Поле :attribute должно быть заполнено"],"type_of_control_name":["Поле :attribute должно быть заполнено"],"number_of_hours":["Поле :attribute должно быть заполнено"],"course":["Поле :attribute должно быть заполнено"],"semester":["Поле :attribute должно быть заполнено"]}</h3>'],
//            ['POST', ['group_id' => '', 'discipline_id' => '', 'type_of_control_id' => '', 'number_of_hours' => '', 'course' => '', 'semester' => ''], '<h3>{"group_name":["Поле :attribute должно быть заполнено"],"discipline_name":["Поле :attribute должно быть заполнено"],"type_of_control_name":["Поле :attribute должно быть заполнено"],"number_of_hours":["Поле :attribute должно быть заполнено"],"course":["Поле :attribute должно быть заполнено"],"semester":["Поле :attribute должно быть заполнено"]}</h3>'],
//            ['POST', ['group_id' => '12', 'discipline_id' => '3', 'type_of_control_id' => '1', 'number_of_hours' => '18', 'course' => '25', 'semester' => '2'], '<h3>{"course":["Номер курса не может превышать 6"]</h3>'],
//            ['POST', ['group_id' => '13', 'discipline_id' => '2', 'type_of_control_id' => '1', 'number_of_hours' => '48', 'course' => '3', 'semester' => '78'], '<h3>{"semester":["Номер семестра не может превышать 12"]</h3>'],
//            ['POST', ['group_id' => '11', 'discipline_id' => '9', 'type_of_control_id' => '2', 'number_of_hours' => '666', 'course' => '2', 'semester' => '3'], '<h3></h3>'],
//        ];
//    }





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