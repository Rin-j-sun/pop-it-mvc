<head>
    <link rel="stylesheet" href="/pop-it-mvc/public/style/hello.css">
</head>


<?php
if (!app()->auth::check()):
    ?>
    <!--Возвращение данных стартовой страницы main/php-->
<div class="start_content">
    <img class="owl" src="/pop-it-mvc/public/img/owl.png" alt="photo">

    <h2>Добро Пожаловать В Деканат</h2>

    <button class="button_orange"><a href="<?= app()->route->getUrl('/login') ?>" class="button_nav_link">Войти</a></button>

    <img class="students" src="/pop-it-mvc/public/img/image 3.png" alt="photo">
</div>
<?php
else:
    if (app()->auth::checkRole()):
        ?>
        <div class="content_main_admin">
            <div class="add_employee">
                <h1>Добавьте новые данные</h1>
                <div class="add_employee_info">
                    <p>Добавьте нового сотрудника</p>
                    <button class="button_add"><a href="<?= app()->route->getUrl('/addEmployees') ?>" class="button_add_link">Добавить</a></button>
                </div>
            </div>
            <img src="/pop-it-mvc/public/image/main_admin.jpg" class="image" alt="Изображение">
        </div>
    <?php
    else:
        ?>
        <main>
            <div class="content_main_admin">
                <div class="add_new_data">
                    <h1>Добавьте новые данные</h1>
                    <div class="add_new_data_info">
                        <p>Добавьте нового студента</p>
                        <button class="button_add"><a href="<?= app()->route->getUrl('/addStudents') ?>" class="button_add_link">Добавить</a></button>
                    </div>
                    <div class="add_new_data_info">
                        <p>Добавьте новую группу</p>
                        <button class="button_add"><a href="<?= app()->route->getUrl('/addGroup') ?>" class="button_add_link">Добавить</a></button>
                    </div>
                    <div class="add_new_data_info">
                        <p>Добавьте новую дисциплину</p>
                        <button class="button_add"><a href="<?= app()->route->getUrl('/addDiscipline') ?>" class="button_add_link">Добавить</a></button>
                    </div>
                </div>
                <img src="/pop-it-mvc/public/image/main_employees.jpg" class="image" alt="Изображение">
            </div>
        </main>
    <?php
    endif;
    ?>

<?php
endif;
?>