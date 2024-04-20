<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/add_discipline.css">
</head>

<!--Готово-->

<div class="add_discipline_content">
    <div class="discipline_block">
        <div class="disciplines_spisok">
        <h3>Список дисциплин :</h3>
        <?php
        foreach ($select_disciplines as $select_disciplines){
            echo "<a href='groups.php'><option value=\"$select_disciplines->id\">$select_disciplines->discipline_name</option></a>";
        }
        ?>
        </div>
    </div>
    <div class="add_discipline_content_block">
        <h2>Создать дисциплину</h2>
        <h3><?= $message ?? ''; ?></h3>
        <form method="post" class="add_discipline_form">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input class="add_discipline_field" type="text" name="discipline_name" placeholder="Название">
            <button class="add_discipline_button">Добавить</button>
        </form>

        <div class="add_discipline_content_button">
        <a href="<?= app()->route->getUrl('/disciplinesSearch') ?>"><button class="add">Поиск дисциплин</button></a>
<!--        <a href="--><?php //= app()->route->getUrl('/disciplineFiltering') ?><!--"><button>Фильтрация дисциплин</button></a>-->
    </div>
    </div>
</div>