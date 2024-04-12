
<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/addMark.css">
</head>


<div class="students_add_mark">
<div class="students_add_marks">
    <div class="students_block_add_mark">
        <p>Таблица студентов :</p>
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

    <div class="mark">
        <p>Оценка</p>

        <select class="spisok_add_mark">
            <option value=""></option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <select class="spisok_add_mark">
            <option value=""></option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <select class="spisok_add_mark">
            <option value=""></option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <select class="spisok_add_mark">
            <option value=""></option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <select class="spisok_add_mark">
            <option value=""></option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>

    </div>


        <button class="button_students_add_mark">Добавить</button>

</div>
