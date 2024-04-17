<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/disciplines_search.css">
</head>

<div class="search_content">
<form method="post" class="search_content_form">
            <h2 class="search_content_zag">Поиск дисциплин</h2>
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input type="text" name="search" placeholder="Название дисциплины">
            <button type="submit" class="search_content_button">Найти</button>
        </form>

<div class="search_content_resoult">
<h2 class="search_content_zag">Результаты поиска :</h2>

<?php if ($request->method === 'POST'): ?>
    <?php if (!$select_disciplines->isEmpty()): ?>
        <ul>
            <p>Дисциплина найдена :</p>
            <?php foreach ($select_disciplines as $discipline): ?>
                <?php echo $discipline->discipline_name; ?>
                <br> <!-- Optional: Add a line break after each discipline name -->
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <?= $message ?? '';?>
    <?php endif; ?>
<?php endif; ?>

</div>
</div>



