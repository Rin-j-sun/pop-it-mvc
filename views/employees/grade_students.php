
<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/grade_students.css">
</head>


<div class="students_filters">
    <div class="disciplines_spisok">
        <h3>Список студентов :</h3>
        <ul class="discipline_list">
            <?php
            if($notEmpty):
                $i=1;
                foreach ($gradeList as $grade): ?>
                    <li><span class='counter_grade'><?=$i?></span><?= $grade['student'] ?> <?= $grade['group'] ?>гр. <?= $grade['discipline'] ?> <?= $grade['evaluation'] ?></li>
                    <?php $i++;
                endforeach; ?>
            <?php else : ?>
                <h5>Совпадений не найдено</h5>
            <?php endif; ?>
        </ul>
    </div>
    </div>
    <div class="filters">
        <h2>Отфильтровать</h2>
        <form method="post" class="form_filters">
                <div class="spisok">
                    <select class="students_filter" name="group_name">
                        <option value="">Группа</option>
                        <?php
                        foreach ($select_groups as $select_group){
                            echo "<option value=\"$select_group->id\">$select_group->group_name</option>";
                        }
                        ?>
                    </select>

                    <select class="students_filter" name="discipline_name">
                            <option value="">Дисциплина</option>
                            <?php
                            foreach ($discipline_name as $discipline_name){
                                echo "<option value=\"$discipline_name->id\">$discipline_name->discipline_name</option>";
                            }
                            ?>
                        </select>
        </form>
        <button class="button_students_filter">Отфильтровать</button>
        <button class="button_students_filter"><a href="<?php echo app()->route->getUrl('/gradeStudents'); ?>">Сбросить</a></button>
    </div>
</div>
