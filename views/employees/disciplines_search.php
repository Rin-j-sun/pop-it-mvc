<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/employees/add_discipline.css">
</head>

<form method="post">
            <h2>Поиск дисциплин</h2>
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input type="text" name="search" placeholder="Название дисциплины">
            <button type="submit">Search</button>
        </form>
<h2>Результаты поиска :</h2>

<?php if (!$select_disciplines->isEmpty()): ?>
    <ul>
        <?php foreach ($select_disciplines as $discipline): ?>
            <?php echo $discipline->discipline_name; ?>
            <br> <!-- Optional: Add a line break after each discipline name -->
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <?= $message ?? '';?>
<?php endif; ?>



