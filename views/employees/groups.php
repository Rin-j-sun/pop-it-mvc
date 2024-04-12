<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/groups.css">
</head>

<div class="groups_content">
    <p class="groups_block">
        <a href="<?= app()->route->getUrl('/groupInf') ?>">421</a>
    </div>
    <div class="group_content_block">
        <h2>Работа с группами </h2>
<div class="button_add_group">
    <a href="<?= app()->route->getUrl('/addDisciplineGroupe') ?>"><button>Добавить дисциплину</button></a>
    <a href="<?= app()->route->getUrl('/addGroup') ?>"><button>Добавить группу</button></a>
</div>
    </div>
</div>