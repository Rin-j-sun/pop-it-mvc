<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/groups.css">
</head>

<div class="groups_content">
    <div class="groups_block">
        Здесь будет тображение групп
    </div>
    <div class="group_content_block">
        <h2>Работа с группами </h2>
<div class="button_add_group">
    <button>Посмотреть группы</button>
    <a href="<?= app()->route->getUrl('/addGroup') ?>"><button>Добавить группу</button>
</div>
    </div>
</div>