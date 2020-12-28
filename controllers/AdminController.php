<?php

/**
    *  Контроллер AdminController Суперкласс  AdminBase
*/

class AdminController extends AdminBase
{
	 /**
	*    Action для страницы Панели Администратора
	*/
	public function actionIndex()
	{
		// Проверка доступа
		self::checkAdmin();
        
        // кол-во пользователей
		$countUsers = User::countUsers();
        
        // кол-во сообщений
		$countMessages = Chat::countMessages();

		// вид
		require_once(ROOT . '/views/admin/index.php');
		return true;
	}
}