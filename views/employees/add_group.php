<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/add_group.css">
</head>

<!--Готово-->

<div class="add_group_content">
    <div class="group_block">
    <div class="groups_spisok">
        <h3>Список групп :</h3>
        <?php
        foreach ($select_groups as $select_group){
            echo "<option value=\"$select_group->id\">$select_group->group_name</option>";
        }
        ?>
    </div>
    </div>

    <div class="add_group_content_block">
        <h2>Добавить группу</h2>
            <form method="post" class="add_group_form">
                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <input class="field_add_group" type="number" name="group_name" placeholder="Название">
                <button class="button_add_group">Добавить</button>
            </form>
    </div>

</div>