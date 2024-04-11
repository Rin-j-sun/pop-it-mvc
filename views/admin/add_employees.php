<div class="add_employees_content">
    <div class="add_employees_content_block">
        <h2>Добавление нового сотрудника</h2>
        <h3><?= $message ?? ''; ?></h3>
        <form method="post" class="form_add_employees">
            <div class="fields_form">
                <input class="field_add_employees" type="text" name="login" placeholder="Логин">
                <input class="field_add_employees" type="password" name="password" placeholder="Пароль">
            </div>
            <button class="button_add_employees">Добавить</button>
        </form>
    </div>
</div>