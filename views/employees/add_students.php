<div class="add_students_content">
    <div class="add_students_content_block">
        <h2>Добавление нового студента</h2>
        <form method="post" class="form_add_students">
            <div class="fields_form_add_students">
                <input class="field_add_student" type="text" name="last_name" placeholder="Фамилия">
                <input class="field_add_student" type="text" name="name" placeholder="Имя">
                <input class="field_add_student" type="text" name="patronymic" placeholder="Отчество">
                <div class="small_fields_row">
                    <select class="field_add_student_small">
                        <option value="">Пол</option>
                        <option value="man">Мужской</option>
                        <option value="woman">Женский</option>
                    </select>
                    <input class="field_add_student_small" type="date" placeholder="Дата">
                </div>
                <input class="field_add_student" type="text" name="address" placeholder="Адрес прописки">
                <select class="field_add_student">
                    <option value="">Группа</option>
                    <option value="453">112</option>
                    <option value="421">421</option>
                </select>
            </div>
            <button class="button_add_student">Добавить</button>
        </form>
    </div>
</div>
