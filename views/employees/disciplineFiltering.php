
<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/disciplineFiltering.css">
</head>



<div class="disciplines_filter_content">
        <div class="disciplines_spisok">
            <h3>Список дисциплин :</h3>
            <?php if ($select_disciplines->isEmpty()): ?>
                <p>Нет дисциплин, удовлетворяющих заданным критериям.</p>
            <?php else: ?>
                <?php foreach ($select_disciplines as $discipline): ?>
                    <a href='groups.php'><option value="<?= $discipline->id ?>"><?= $discipline->discipline_name ?></option></a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>


        <div class="disciplines_filter">
        <h2>Отфильтровать</h2>
    <form method="post" class="form_filters">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <div class="disciplines_filter_spisok">
            <input class="disciplines_filter_pole" placeholder="Курс" name="courсe"/>
            <input class="disciplines_filter_pole" placeholder="Семестр"  name="semester"/>
        </div>
        <button class="button_disciplines_filter">Отфильтровать</button>
        <button class="button_disciplines_filter"><a href="<?= app()->route->getUrl('/disciplineFiltering') ?>" class="sbros">Сбросить</a></button>
    </form>

</div>
</div>
