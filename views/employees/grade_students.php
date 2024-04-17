
<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/grade_students.css">
</head>


<div class="students_filters">
<div class="students_filters_content">
    <div class="students_filters_spisok">
        <h3>Список студентов :</h3>
            <?php
            foreach ($select_students as $student) {
                $group = $student->group;
                $groupName = $group->group_name;
                $url = app()->route->getUrl('/student') . "?id=$student->id"; // Assuming you want to pass student ID as a parameter
                echo "<a href=\"$url\"><option value=\"$student->id\">" . $student->surname . " " . $student->name . " " . $student->patronymic .  " группа : " . $groupName . "</option></a>";
            }
            ?>
    </div>
    </div>
    <div class="filters">
        <h2>Отфильтровать</h2>
        <form method="post" class="form_filters">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <div class="spisok">
                    <select class="students_filter" name="group_name">
                        <option value="">Группа</option>
                        <?php
                        foreach ($select_groups as $select_group){
                            echo "<option value=\"$select_group->id\">$select_group->group_name</option>";
                        }
                        ?>
                    </select>

<!--                    <select class="students_filter" name="discipline_name">-->
<!--                            <option value="">Дисциплина</option>-->
<!--                        --><?php
//                        foreach ($discipline_name as $discipline_name){
//                            echo "<option>$discipline_name->discipline_name</option>";
//                        }
//                        ?>
<!--                        </select>-->
        </form>
        <button class="button_students_filter">Отфильтровать</button>
        <button class="button_students_filter"><a href="<?php echo app()->route->getUrl('/gradeStudents'); ?>" class="sbros">Сбросить</a></button>
    </div>
    </div>
</div>


