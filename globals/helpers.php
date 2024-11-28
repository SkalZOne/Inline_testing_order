<?php

/**
 * Получение json обьекта из URL ссылки
 * @param string $url
 * 
 * @return object
 */
function getJsonFromURL($url)
{
    $json = file_get_contents($url);
    return json_decode($json);
}