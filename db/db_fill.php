<?php
include_once __DIR__ . '/../globals/constants.php';
include_once __DIR__ . '/../globals/helpers.php';

$db = new SQLite3(DB_PATH);

// Записи
$posts = getJsonFromURL('https://jsonplaceholder.typicode.com/posts');
// Комментарии
$comments = getJsonFromURL('https://jsonplaceholder.typicode.com/comments');

// Цикл, который проходится по записям
foreach ($posts as $post) {
    // Выгружааем записи с сайта в нашу БД
    $db->exec(
        "INSERT INTO posts (user_id, title, body) 
        VALUES ($post->userId, '$post->title', '$post->body')"
    );
}

// Цикл, который проходится по комментариям
foreach ($comments as $comment) {
    // Выгружааем комментарии с сайта в нашу БД
    $db->exec(
        "INSERT INTO comments (name, email, body, post_id) 
        VALUES ('$comment->name', '$comment->email', '$comment->body', $comment->postId)"
    );
}
// Отображение кол-ва загруженных записей и комментариев
echo "Загружено " . count($posts) . " записей и " . count($comments) . " комментариев.";