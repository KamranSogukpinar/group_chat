<?php

/**
*  Контроллер AdminUsersMessagesController
*  Управление сообщениями пользователей в админпанели
*/
class AdminUsersMessagesController  extends AdminBase
{

	/**
	*    Action для страницы управления сообщениями
	*/
	public function actionIndex()
	{
		// Проверка доступа
		self::checkAdmin();

	

		// Список контактов
        $users = Chat::fetchUser();
        
        // список сообщений
        $messages = Chat::getMessagesAdminList();

        

		// Подключаем вид 
		require_once(ROOT. '/views/admin_messages/index.php');
		return true;
	}

	  /**
	*   Action для страницы посмотра корректности
	*/ 
	public function actionCorrect($id)
	{
		self::checkAdmin();

        $message = Chat::getMessageById($id);
        
		if(isset($_POST['yes'])) {
			Chat::incorrectMessageById($id);
          
			header("Location: /admin/messages/");
			
		}else if(isset($_POST['no'])){
              Chat::correctMessageById($id);
              header("Location: /admin/messages/".$id);
              
		}

		require_once(ROOT. '/views/admin_messages/incorrect.php');
		return true;
	}




}