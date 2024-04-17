<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/student.css">
</head>


<div class="student_content">
    <div class="student_block">
        <h3>Студент :</h3>
        <?php
        // Получаем ID студента из адресной строки
        $selectedStudentId = $_GET['id'] ?? null;

        // Проверяем, существует ли ID студента
        if ($selectedStudentId !== null) {
            foreach ($select_students as $student) {
                // Проверяем, соответствует ли ID студента ID, переданному в адресной строке
                if ($student->id == $selectedStudentId) {
                    $group = $student->group; // Получаем объект группы студента через связь
                    if ($group) {
                        $groupName = $group->group_name; // Получаем имя группы
                        $url = app()->route->getUrl('/student') . "?id=$student->id"; // Предполагается, что вы хотите передать ID студента в качестве параметра
                        echo "<a href=\"$url\">" . $student->surname . " " . $student->name . " " . $student->patronymic . " группа : " . $groupName . "</a>";
                        break; // Выходим из цикла после первого совпадения
                    }
                }
            }
        } else {
            echo "Студент не выбран"; // Либо другое действие в случае отсутствия ID студента
        }
        ?>

    </div>
    <div class="studentcontent_block">


    <h3 class="stud_zag">Оценить студента</h3>
        <form method="post" class="student_eval">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input type="hidden" name="student_id" value="<?= $selectedStudentId ?>">
            <h3 class="stud_zag">Выбрать дисциплину :</h3>
            <select class="spisok_discipline" name="discipline_name">
                <option value="">Дисциплина</option>
                <?php foreach ($discipline_name as $discipline): ?>
                    <option value="<?= $discipline->id ?>"><?= $discipline->discipline_name ?></option>
                <?php endforeach; ?>
            </select>

            <h3 class="stud_zag">Выбрать оценку :</h3>
            <select class="spisok_eval" name="ball">
                <option value="">Оценка</option>
                <?php foreach ($select_balls as $ball): ?>
                    <option><?= $ball->balls ?></option>
                <?php endforeach; ?>
            </select>

            <button class="button_students_eval">Оценить</button>
        </form>


    </div>
</div>