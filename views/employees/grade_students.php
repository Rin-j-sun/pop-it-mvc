
<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/grade_students.css">
</head>


<div class="students_filters">
<div class="students_filters_content">
    <div class="students_filters_spisok">
        <h3>Список студентов :</h3>
        <ul class="discipline_list">
            <?php
            if($notEmpty){
                $i = 1;
                foreach ($gradeList as $grade){
                    echo "<li><span class='counter_grade'>$i</span>{$grade['student']} {$grade['group']} гр. {$grade['discipline']} {$grade['evaluation']}</li>";
                    $i++;
                }
            }
            else {
                echo "<h5>Совпадений не найдено</h5>";
            }
            ?>
        </ul>
    </div>
    </div>
    <div class="filters">
        <h2>Отфильтровать</h2>
        <form method="post" class="form_filters">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <div class="spisok">
                    <select class="students_filter" name="groups">
                        <option value="">Группа</option>
                        <?php
                        foreach ($groupsGrades as $groupsGrade){
                            echo "<option value=\"$groupsGrade->id\">$groupsGrade->group_name</option>";
                        }
                        ?>
                    </select>

                    <select class="students_filter" name="disciplines">
                            <option value="">Дисциплина</option>
                        <?php
                        foreach ($disciplinesGrades as $disciplinesGrade){
                            echo "<option value=\"$disciplinesGrade->id\">$disciplinesGrade->discipline_name</option>";
                        }
                        ?>
                        </select>

                    <button class="button_students_filter">Отфильтровать</button>
                    <button class="button_students_filter"><a href="<?php echo app()->route->getUrl('/gradeStudents'); ?>" class="sbros">Сбросить</a></button>
        </form>

    </div>
    </div>
</div>


