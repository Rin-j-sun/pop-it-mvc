<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/login.css">
</head>

<div class="hello_content">
<div class = "inf_text">
    <h2>Добро Пожаловать В Деканат</h2>
    <h3><?= $message ?? ''; ?></h3>
</div>

<h3><?= app()->auth->user()->name ?? ''; ?></h3>
<?php
if (!app()->auth::check()):
    ?>
    <form method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <label><input type="text" placeholder="Логин" name="login"></label>
        <label><input type="password" placeholder="Пароль" name="password"></label>
        <button>Войти</button>
    </form>

    <img src="/pop-it-mvc/public/img/image 1.png" alt="photo">
</div>
<?php endif;