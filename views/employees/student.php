<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/student.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/add_group.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/grade_students.css">
</head>


<div class="student_content">
    <div class="student_block">
        <h3>Студент :</h3>
        <?php
        // Получаем ID студента из адресной строки
        $selectedStudentId = $_GET['id'] ?? null;

        foreach ($select_students as $student) {
            // Проверяем, соответствует ли ID студента ID, переданному в адресной строке
            if ($student->id == $selectedStudentId) {
                $group = $student->group; // Получаем объект группы студента через связь
                if ($group) {
                    $groupName = $group->group_name; // Получаем имя группы
                    $url = app()->route->getUrl('/student') . "?id=$student->id"; // Предполагается, что вы хотите передать ID студента в качестве параметра
                    echo "<a href=\"$url\">" . $student->surname . " " . $student->name . " " . $student->patronymic . " " . $groupName . "</a>";
                    break; // Выходим из цикла после первого совпадения
                }
            }
        }
        ?>
    </div>
    <div class="studentcontent_block">


    <h3>Выбрать дисциплину :</h3>
        <form method="post">
        <select class="spisok_add_group_add_discipline" name="discipline_name">
            <option value="">Дисциплина</option>
            <?php
            foreach ($discipline_name as $discipline_name){
                echo "<option>$discipline_name->discipline_name</option>";
            }
            ?>
        </select>

        <h3>Оценка :</h3>
        <select class="spisok_add_group_add_discipline" name="ball">
            <?php
            foreach ($select_balls as $select_balls){
                echo "<option>$select_balls->balls</option>";
            }
            ?>
        </select>
            <button class="button_students_filter">Оценить</button>

    </form>
    </div>
</div>