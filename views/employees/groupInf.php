
<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/grade_students.css">
</head>


<div class="students_filters">
    <div class="students_block">
        <h3>Студенты группы</h3>
        <ul>
            <?php foreach ($students as $student): ?>
                <li>
                    <a href="<?= app()->route->getUrl('/student') ?>?id=<?= $student->id ?>">
                        <?= $student->surname . " " . $student->name . " " . $student->patronymic ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>


    <a class="filters">
        <h2>Добавить оценку</h2>
        <a href="<?= app()->route->getUrl('/addMark') ?>"><button class="button_students_filter">Добавить</button></a>
    </div>
</div>
