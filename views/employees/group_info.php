
<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/group_info.css">
</head>


<div class="group_info">
    <h2>Информация о группе</h2>
    <p>ID группы: <?= $studentsGroup->id ?></p>
    <p>№ группы : <?= $studentsGroup->group_name ?></p>


    <h3>Студенты группы :</h3>
    <?php if ($students): ?>
        <ul>
            <?php foreach ($students as $student): ?>
                <li>
                    <a href="<?= app()->route->getUrl('/student') ?>?id=<?= $student->id ?>">
                        <?= $student->surname . " " . $student->name . " " . $student->patronymic ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Студенты этой группы отсутствуют.</p>
    <?php endif; ?>
</div>

</div>
