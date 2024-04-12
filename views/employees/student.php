<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/student.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/add_group.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/grade_students.css">
</head>


<div class="student_content">
    <div class="student_block">
        <table>
            <tr>
                <th>Фио Студента</th>
                <th>№ группы</th>
                <th>Дисциплина</th>
                <th>Оценка</th>
            </tr>
            <tr><td><a href="<?= app()->route->getUrl('/student') ?>">Сотникова Сабрина</a></td><td><a href="<?= app()->route->getUrl('/groups') ?>">421</a></td><td><a href="<?= app()->route->getUrl('/addDiscipline') ?>">Английский</a></td><td>3</td></tr>
        </table>
    </div>
    <div class="studentcontent_block">
        <h2>Работа с группами </h2>
        <div class="button_student_inf">
            <a href="<?= app()->route->getUrl('/addGroup') ?>"><button>Посмотреть группы</button><a>
            <a href="<?= app()->route->getUrl('/addGroup') ?>"><button>Добавить группу</button></a>
        </div>
</div>
    </div>
</div>