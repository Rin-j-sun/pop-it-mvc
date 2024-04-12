
<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/grade_students.css">
</head>


<div class="students_filters">
    <div class="students_block">
        <p>Список студентов :</p>
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
    <div class="filters">
        <h2>Отфильтровать</h2>
        <form method="post" class="form_filters">
                <div class="spisok">
                    <select class="students_filter">
                        <option value="">Фильтровать по :</option>
                        <option value="man">Дисциплины</option>
                        <option value="woman">Группы</option>
                    </select>
        </form>
        <button class="button_students_filter">Отфильтровать</button>
    </div>
</div>
