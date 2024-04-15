<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/add_discipline.css">
</head>

<!--Готово-->

<div class="add_discipline_content">
    <div class="discipline_block"></div>
    <div class="add_discipline_content_block">
        <h2>Создать дисциплину</h2>
        <form method="post" class="add_discipline_form">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input class="add_discipline_field" type="text" name="discipline_name" placeholder="Название">
            <button class="add_discipline_button">Добавить</button>
        </form>
    </div>
</div>