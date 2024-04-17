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
            <div class="groups_spisok_content">
                <h3>Список групп :</h3>
                <?php foreach ($select_groups as $select_group): ?>
                    <?php $url = app()->route->getUrl('/groups/group?id=') . "$select_group->id"; ?>
                    <a href="<?= $url ?>" class="groups_spisok_link"><?= $select_group->group_name ?></a><br>
                <?php endforeach; ?>
            </div>
            </div>

        </div>
</div>