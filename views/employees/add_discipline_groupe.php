<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/add_discipline_groupe.css">
</head>


<div class="add_group_add_discipline_content">
    <div class="group_add_discipline_block"></div>
    <div class="add_group_add_discipline_content_block">
        <h2>Добавить Дисциплину Группе</h2>
        <form method="post">
            <div class="spisok_add_group_add">
                <select class="spisok_add_group_add_discipline">
                    <option value="">№ группы</option>
                    <?php
                    foreach ($select_groups as $select_group){
                        echo "<option value=\"$select_group->id\">$select_group->name</option>";
                    }
                    ?>
                </select>
                <select class="spisok_add_group_add_discipline">
                    <option value="">Название дисциплины</option>
                    <?php
                    foreach ($select_groups as $select_group){
                        echo "<option value=\"$select_group->id\">$select_group->name</option>";
                    }
                    ?>
                </select>
            </div>
            <button class="button_add_group_add">Добавить</button>
        </form>
    </div>
</div>