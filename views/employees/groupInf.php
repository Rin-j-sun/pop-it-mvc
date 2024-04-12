
<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/grade_students.css">
</head>


<div class="students_filters">
    <div class="students_block">
        <p>Список дисциплин группы :</p>
        <table>
            <tr>
                <th>Фио Студента</th>
                <th>№ группы</th>
                <th>Дисциплина</th>
                <th>Оценка</th>
            </tr>
            <tr><td><a href="<?= app()->route->getUrl('/student') ?>">Сотникова Сабрина</a></td><td>421</td><td>Английский</td><td>3</td></tr>
            <tr><td><a href="<?= app()->route->getUrl('/student') ?>">Сотникова Сабрина</a></td><td>421</td><td>Английский</td><td>3</td></tr>
            <tr><td><a href="<?= app()->route->getUrl('/student') ?>">Сотникова Сабрина</a></td><td>421</td><td>Английский</td><td>3</td></tr>
            <tr><td><a href="<?= app()->route->getUrl('/student') ?>">Сотникова Сабрина</a></td><td>421</td><td>Английский</td><td>3</td></tr>
            <tr><td><a href="<?= app()->route->getUrl('/student') ?>">Сотникова Сабрина</a></td><td>421</td><td>Английский</td><td>3</td></tr>
            <tr><td><a href="<?= app()->route->getUrl('/student') ?>">Сотникова Сабрина</a></td><td>421</td><td>Английский</td><td>3</td></tr>
        </table>

    </div>
    <a class="filters">
        <h2>Добавить оценку</h2>
        <a href="<?= app()->route->getUrl('/addMark') ?>"><button class="button_students_filter">Добавить</button></a>
    </div>
</div>
