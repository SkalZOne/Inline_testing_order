<?php
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
</body>

</html>