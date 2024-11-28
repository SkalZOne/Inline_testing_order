<?php
include_once __DIR__ . "/constants.php";
include_once __DIR__ . "/helpers.php";

$db = new SQLite3(DB_PATH);

isset($_POST['searchField']) && $searchField = $_POST['searchField'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="globals/style.css">
    <title>JSONPlaceholder posts</title>
</head>

<body>
    <form class="form" method="POST" action="index.php">
        <div class="form__input-container">
            <input type="text" placeholder="Введите текст для поиска по комментариям" name="searchField">
            <?php
            // Если $searchField найдена и если она меньше 3-ех символов, выводим ошибку
            if (isset($searchField) && strlen($searchField) < 3) {
                echo "<small class='form__input-container__alert'>В поле поиска должно быть больше 3-ех символов</small>";
            }
            ?>
        </div>
        <button>Найти</button>
    </form>

    <div class="posts">
        <?php
        // Если $searchField найдена и если она больше или равна 3-ем символам
        if (isset($searchField) && strlen($searchField) >= 3) {
            // Комментарии
            $queryComments = $db->prepare("SELECT * FROM `comments` WHERE `body` LIKE '%$searchField%'");
            $resultComments = $queryComments->execute();

            // Создание пустого массива для дополнительной проверки
            $_SESSION['avaliable_posts'] = [];

            while ($comments = $resultComments->fetchArray()) {
                // Записи
                $queryPost = $db->prepare("SELECT * FROM `posts` WHERE `id` = {$comments['post_id']}");
                $post = $queryPost->execute()->fetchArray();

                echo
                    "<div>
                        <span class='title__header'>Заголовок записи</span>
                        <span class='title'>{$post['title']}</span>
                        <span class='body__header'>Найден по данному комментарию</span>
                        <span class='body'>{$comments['body']}</span>
                    </div>";
            }
        }
        ?>
    </div>
</body>

</html>