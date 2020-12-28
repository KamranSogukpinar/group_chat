<?php


/**
*  Контроллер AdminChatController
*  Чат с сообщениями пользователей в админпанели
*/
class AdminChatController extends AdminBase
{
     /**
	*    Action для страницы списка контактов и чатов администратора
	*/
	public function actionIndex()
	{
         self::checkAdmin();
		  $userId = User::checkLogged();

        // Информация о пользователе из БД
          $user = User::getUserById($userId);
	

		 
        
        $users = Chat::fetchUser();
        

        
       // История с некорректными сообщениями для админа
       $chat_history = Chat::chatAdminHistory($userId);

       //$last_message = Chat::lastChatMessage($userId, $user_id);
        
        
        if(isset($_POST['submit'])){

			
			$send['from_user_id'] =  $userId;//$_POST['from_user_id'];
			$send['chat_message'] = $_POST['chat_message'];
			
             $id = Chat::sendMessage($send);

				
			

                header("Location: /admin/chat");

			
		}
        
       

		require_once(ROOT. '/views/admin_chats/index.php');
		return true;
	}

    
    /**
	*    Action для страницы чата администратора с другим пользователем по идентификатору
	*/
    public function actionChatbox($user_id)
	{
		self::checkAdmin();
		  $userId = User::checkLogged();

        // Информация о пользователе из БД
          $user = User::getUserById($userId);
	

		 $username = Chat::getUsername($user_id);
        
        $users = Chat::fetchUser();
        

        
       // История с некорректными сообщениями для админа
       $chat_history = Chat::chatAdminHistory($userId, $user_id);

       //$last_message = Chat::lastChatMessage($userId, $user_id);
        
        
        if(isset($_POST['submit'])){

			$send['to_user_id'] = $user_id ;   //$_POST['to_user_id'];
			$send['from_user_id'] =  $userId;//$_POST['from_user_id'];
			$send['chat_message'] = $_POST['chat_message'];
			
             $id = Chat::sendMessage($send);

				
			

                header("Location: /admin/chatbox/".$user_id);

			
		}

		require_once(ROOT. '/views/admin_chats/chatbox.php');

		return true;
	}





}