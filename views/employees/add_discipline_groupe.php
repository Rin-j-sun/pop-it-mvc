<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/add_discipline_groupe.css">
</head>


<div class="add_group_add_discipline_content">
    <div class="add_group_add_discipline_content_block">
        <h2>Добавить Дисциплину Группе</h2>
        <h3><?= $message ?? ''; ?></h3>
        <form method="post" class="add_group_add_discipline_form">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <div class="spisok_add_group_add">
                <select class="spisok_add_group_add_discipline" name="group_name">
                        <option value="">Группа</option>
                        <?php
                        foreach ($select_groups as $select_group){
                            echo "<option value=\"$select_group->id\">$select_group->group_name</option>";
                        }
                        ?>
                    </select>
                <select class="spisok_add_group_add_discipline" name="discipline_name">
                        <option value="">Дисциплина</option>
                        <?php
                        foreach ($discipline_name as $discipline_name){
                            echo "<option>$discipline_name->discipline_name</option>";
                        }
                        ?>
                    </select>

                <select class="spisok_add_group_add_discipline" name="type_of_control_name">
                    <option value="">Вид контроля</option>
                    <?php
                    foreach ($type_of_control_name as $type_of_controls){
                        echo "<option >$type_of_controls->type_of_control_name</option>";
                    }
                    ?>
                </select>

                <input class="add_discipline_field" type="text" name="number_of_hours" placeholder="Количество часов">
                <input class="add_discipline_field" type="text" name="cource" placeholder="Курс">
                <input class="add_discipline_field" type="text" name="semester" placeholder="Семестр">

            </div>
            <button class="button_add_group_add">Добавить</button>
        </form>
    </div>
</div>