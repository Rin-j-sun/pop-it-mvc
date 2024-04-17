<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/add_students.css">
</head>


<div class="add_students_content">
    <div class="students_block">
        <div class="students_spisok">
        <h3>Список студентов</h3>
<!--            Успешное перенаправление-->
            <?php
            foreach ($select_students as $student) {
                $url = app()->route->getUrl('/student') . "?id=$student->id"; // Assuming you want to pass student ID as a parameter
                echo "<a href=\"$url\"><option value=\"$student->id\">" . $student->surname . " " . $student->name . " " . $student->patronymic . "</option></a>";
            }
            ?>
    </div>
    </div>
    <div class="add_students_content_block">
        <h2>Добавить студента</h2>
        <h3><?= $message ?? ''; ?></h3>
        <form method="post">
            <div class="form_add_student">
                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <input class="add_student_field" type="text" name="surname" placeholder="Фамилия">
                <input class="add_student_field" type="text" name="name" placeholder="Имя">
                <input class="add_student_field" type="text" name="patronymic" placeholder="Отчество">
                <div class="spisok">
                    <select class="gender" name="gender">
                        <option value="">Пол</option>
                        <option value="man">Мужской</option>
                        <option value="woman">Женский</option>
                    </select>
                    <input class="spisok_add_student" name="birthdate" type="date" placeholder="Дата">
                </div>
                <input class="add_student_field" type="text" name="adress" placeholder="Адрес прописки">
                <select name="group_id" class="id">
                    <option value="">Группа</option>
                    <?php
                    foreach ($select_groups as $select_group){
                        echo "<option value=\"$select_group->id\">$select_group->group_name</option>";
                    }
                    ?>
                </select>
            </div>
            <button class="button_add_student">Добавить</button>
        </form>
    </div>
</div>
