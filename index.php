<?php
// FRONT CONTROLLER


// 1. Обшие настройки
/*
  *ini_set('display errors', 1);  // временно вывод всех ошибок
  *error_reporting(E_ALL);        // временно
*/

session_start();

// 2. Подключение файлов системы

define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Autoload.php');


// 3. Установка соединения с БД


// 4. Вызов Routers

$router = new Router();
$router->run();