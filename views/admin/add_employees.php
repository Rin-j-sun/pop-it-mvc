<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/add_employees.css">
</head>

<div class="add_employe">
    <div class="employees_block"></div>
    <div class="add_employe_content">
        <h2>Добавить сотрудника</h2>
        <h3><?= $message ?? ''; ?></h3>
        <form method="post" class="form_add_employe">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <input class="add_employe_field" type="text" name="login" placeholder="Логин">
                <input class="add_employe_field" type="password" name="password" placeholder="Пароль">
            <button class="button_add_employees">Добавить</button>
        </form>
    </div>
</div>