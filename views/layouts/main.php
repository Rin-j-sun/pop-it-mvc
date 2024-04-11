<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <title>Pop it MVC</title>
</head>
<body>
<?php
if (!app()->auth::check()):
    ?>
    <header>

    </header>
    <main>
<!--Возвращение данных стартовой страницы hello/php-->
        <?= $content ?? '' ?>

    </main>
<header>
    <?php
    else:
        if (app()->auth::checkRole()):
            ?>
            <header>
                <nav>
                    <div class="nav">
                        <h1>Деканат<h1>
                        <button class="button_nav"><a href="<?= app()->route->getUrl('/logout') ?>" class="button_nav_link">Выход</a></button>
                    </div>

                </nav>
            </header>
            <main>
                <?= $content ?? '' ?>
            </main>
        <?php
        else:
            ?>
            <header>
                <nav class="nav_employees">
                    <h1>Деканат<h1>
                            <button class = "nav_button">
                                <a href="<?= app()->route->getUrl('/employees') ?>">Сотрудники</a>
                            </button>
                            <button class = "nav_button">
                                <a href="<?= app()->route->getUrl('/hello') ?>">Личный кабинет</a>
                            </button>
                            <button class = "nav_button">
                                <a href="<?= app()->route->getUrl('/logout') ?>">Выход</a>
                            </button>
                </nav>
            </header>
            <main>
                <?= $content ?? '' ?>
            </main>
        <?php
        endif;
        ?>

    <?php
    endif;
    ?>

    <?php
    if (app()->auth::check()):
        ?>
        <footer>
            <div class = "footer">
                <a href="">О нас</a>
                <p>2024г. Россия</p>
            </div>
        </footer>
    <?php
    endif;
    ?>

</body>
</html>