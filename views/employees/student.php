<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/student.css">
</head>


<div class="student_content">
    <div class="student_block">


        <?php if (!empty($studentGrade)) : ?>
            <?php

            foreach ($studentGrade as $item) {
                foreach ($item->evaluations as $evaluation) {
                    echo $evaluation->name;
                }
            }

            ?>
            <h1>Успеваемость студента - <?=$studentName?></h1>
            <ul class="discipline_list">
                <?php $i = 1;
                foreach ($studentGrade as $studentGrades) :
                    $discipline = $studentGrades->disciplinesGroup->discipline->discipline_name;
                    $control = $studentGrades->disciplinesGroup->control->type_of_control_name;
                    $hours = $studentGrades->disciplinesGroup->number_of_hours;
                    $evaluations=$studentGrades->evaluations->balls;?>
                    <li class="student_in_list">
                        <span class="counter"><?php echo $i; ?></span>
                        <?php echo "$discipline - количество часов: $hours; вид контроля: $control; оценка: $evaluations;"; ?>
                    </li>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <h1>Успеваемость студента - <?=$studentName?></h1>
            <h4>Отсутствует успеваемость</h4>
        <?php endif; ?>

    </div>
    <div class="studentcontent_block">


    <h3 class="stud_zag">Оценить студента</h3>
        <form method="post" class="student_eval">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <h3 class="stud_zag">Выбрать дисциплину :</h3>
            <select class="spisok_discipline" name="disciplineGroupId">
                <option value="">Дисциплина</option>
                <?php foreach ($disciplinesGroup as $disciplineGroup) : ?>
                    <?php $discipline = $disciplineGroup->discipline->discipline_name; ?>
                    <?php
                        var_dump($disciplinesGroup);
                    ?>
                    <option value="<?= $disciplineGroup->discipline_grope_id ?>"><?= $discipline ?></option>
                <?php endforeach; ?>
            </select>

            <h3 class="stud_zag">Выбрать оценку :</h3>
            <select class="spisok_eval" name="evaluationName">
                <option value="">Оценка</option>
                <?php foreach ($select_balls as $ball): ?>
                    <option><?= $ball->balls ?></option>
                <?php endforeach; ?>
            </select>

            <button class="button_students_eval">Оценить</button>
        </form>



    </div>
</div>