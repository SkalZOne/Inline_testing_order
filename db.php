<?php

// Создание файла базы данных
$db = new SQLite3('sqlite.db');

// Включаем поддержку внешних ключей
$db->exec('PRAGMA foreign_keys = ON');

// Создание таблицы для записей
$db->exec('CREATE TABLE IF NOT EXISTS posts (
`id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
`user_id` INTEGER, 
`title` TEXT, 
`body` TEXT
)');

// Создание таблицы для комментариев
$db->exec('CREATE TABLE IF NOT EXISTS comments (
`id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
`name` TEXT,
`email` TEXT,
`body` TEXT,
`post_id` INTEGER, 
FOREIGN KEY(post_id) REFERENCES posts(id)
)');

