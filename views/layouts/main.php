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
        if (!app()->auth::checkRole()):
//       если зашёл не админ
            ?>
            <header>
                <nav class="nav_employees">
                    <h1 class = "h_sotr">Деканат</h1>
                    <div class="nav_button_groupe">
                        <a href="<?= app()->route->getUrl('/addDiscipline') ?>"><button class = "nav_button">Дисциплины</button></a>
                        <a href="<?= app()->route->getUrl('/groups') ?>"><button class = "nav_button">Группы</button></a>
                        <a href="<?= app()->route->getUrl('/addStudents') ?>"><button class = "nav_button">Студенты</button></a>
                        <a href="<?= app()->route->getUrl('/gradeStudents') ?>"><button class = "nav_button">Успеваемость</button></a>
                        <a href="<?= app()->route->getUrl('/hello') ?>"><button class = "nav_button">Личный кабинет</button></a>
                        <a href="<?= app()->route->getUrl('/logout') ?>"><button class = "nav_button">Выход</button></a>
                    </div>
                </nav>
            </header>
            <main>
                <?= $content ?? '' ?>
            </main>
        <?php
        else:
            ?>
<!--        Если зашёл админ-->
            <header>
                <nav class="nav_employees">
                    <h1 class = "h_admin">Деканат</h1>
                    <div class="nav_button_groupe">
                        <a href="<?= app()->route->getUrl('/addEmployees') ?>"><button class = "nav_button">Сотрудники</button></a>
                        <a href="<?= app()->route->getUrl('/hello') ?>"><button class = "nav_button">Личный кабинет</button></a>
                        <a href="<?= app()->route->getUrl('/logout') ?>"><button class = "nav_button">Выход</button></a>
                    </div>
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