<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
    <link rel="stylesheet" href="/pop-it-mvc/public/style/admin/admin.css">
</head>


<?php
if (!app()->auth::check()):
    ?>
    <!--Возвращение данных стартовой страницы main/php-->
<div class="start_content">
    <img class="owl" src="/pop-it-mvc/public/img/owl.png" alt="photo">

    <h2>Добро Пожаловать В Деканат</h2>

    <a href="<?= app()->route->getUrl('/login') ?>" class="button_nav_link"><button class="button_orange">Войти</button></a>

    <img class="students" src="/pop-it-mvc/public/img/image 3.png" alt="photo">
</div>
<?php
else:
    if (!app()->auth::checkRole()):
        ?>
        <div class="content_main">
        <div class="content_main_admin">
                <h1>Пользователь : </h1>
                <h2>Сотрудник </h2>
                <h2>Не желаете показать себя этому грешному миру :) ?</h2>

            <form method="post" enctype="multipart/form-data" class="form_photo">
                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <input type="file"  name="image">
                <button type="submit" class="form_photo_button">Загрузить изображение</button>
            </form>

            <?php if ($images->isNotEmpty()): ?>
                <?php foreach ($images as $image): ?>
                    <img src="/pop-it-mvc/public/img/<?= $image->name ?>" class="photo_profile" alt="Изображение">
                <?php endforeach; ?>
            <?php endif; ?>

                <h2>Я - обычный грустный сотрудник :( </h2>
        </div>
        <img class = "photo_bell" src="/pop-it-mvc/public/img/Bell.png" class="image" alt="Изображение">
        </div>

    <?php
    else:
        ?>
        <main>
            <div class="content_main">
                <div class="content_main_sotr">
                    <h1>Пользователь : </h1>
                    <h2>Администратор </h2>
                    <h2>Не желаете показать себя этому грешному миру :) ?</h2>

                    <form method="post" enctype="multipart/form-data" class="form_photo">
                        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                        <input type="file" name="image">
                        <button type="submit" class="form_photo_button">Загрузить изображение</button>
                    </form>

                    <?php if ($images->isNotEmpty()): ?>
                        <?php foreach ($images as $image): ?>
                            <img src="/pop-it-mvc/public/img/<?= $image->name ?>" class="photo_profile" alt="Изображение">
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <h2>Я - самый крутой админ во вселенной!!! </h2>

                </div>
                <img class = "photo_bell" src="/pop-it-mvc/public/img/Bell.png" class="image" alt="Изображение">
            </div>
        </main>
    <?php
    endif;
    ?>

<?php
endif;
?>