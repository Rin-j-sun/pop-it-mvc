<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/add_students.css">
</head>


<div class="add_students_content">
    <div class="students_block"></div>
    <div class="add_students_content_block">
        <h2>Добавить студента</h2>
        <form method="post">
            <div class="form_add_student">
                <input class="add_student_field" type="text" name="last_name" placeholder="Фамилия">
                <input class="add_student_field" type="text" name="name" placeholder="Имя">
                <input class="add_student_field" type="text" name="patronymic" placeholder="Отчество">
                <div class="spisok">
                    <select class="spisok_add_student">
                        <option value="">Пол</option>
                        <option value="man">Мужской</option>
                        <option value="woman">Женский</option>
                    </select>
                    <input class="spisok_add_student" type="date" placeholder="Дата">
                </div>
                <input class="add_student_field" type="text" name="address" placeholder="Адрес прописки">
                <select class="add_student_field">
                    <option value="">Группа</option>
                    <option value="453">112</option>
                    <option value="421">421</option>
                </select>
            </div>
            <button class="button_add_student">Добавить</button>
        </form>
    </div>
</div>
