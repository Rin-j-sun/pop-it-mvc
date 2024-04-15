<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/groups.css">
</head>

<div class="groups_content">
        <div class="group_content_block">
        <h2>Работа с группами </h2>
<div class="button_add_group">
    <a href="<?= app()->route->getUrl('/addDisciplineGroupe') ?>"><button>Добавить дисциплину</button></a>
    <a href="<?= app()->route->getUrl('/addGroup') ?>"><button>Добавить группу</button></a>
</div>
            <div class="groups_spisok">
<!--                реализовать переход на groupInf-->
                <h3>Список групп :</h3>
                <?php
                foreach ($select_groups as $select_group){
                    echo "<option value=\"$select_group->id\">$select_group->group_name</option>";
                }
                ?>
            </div>
    </div>
</div>