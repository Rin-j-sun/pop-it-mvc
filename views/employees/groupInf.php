
<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/grade_students.css">
</head>


<div class="students_filters">
    <div class="students_block">
        <p>Список дисциплин группы :</p>

            <a href="<?= app()->route->getUrl('/student') ?>">Сотникова Сабрина</a>


    </div>
    <a class="filters">
        <h2>Добавить оценку</h2>
        <a href="<?= app()->route->getUrl('/addMark') ?>"><button class="button_students_filter">Добавить</button></a>
    </div>
</div>
