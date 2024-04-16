
<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/grade_students.css">
</head>


<div class="students_filters">
    <div class="disciplines_spisok">
        <h3>Список студентов :</h3>
        <ul class="discipline_list">

        </ul>
    </div>
    </div>
    <div class="filters">
        <h2>Отфильтровать</h2>
        <form method="post" class="form_filters">
                <div class="spisok">
                    <select class="students_filter" name="group_name">
                        <option value="">Группа</option>

                    </select>

                    <select class="students_filter" name="discipline_name">
                            <option value="">Дисциплина</option>

                        </select>
        </form>
        <button class="button_students_filter">Отфильтровать</button>
        <button class="button_students_filter"><a href="<?php echo app()->route->getUrl('/gradeStudents'); ?>">Сбросить</a></button>
    </div>
</div>
