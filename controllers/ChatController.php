<?php


/**
*  Контроллер ChatController
*  Чат с сообщениями пользователей на странице пользователей
*/

class ChatController
{
     /**
	*    Action для страницы списка контактов и чатов пользователя
	*/
	public function actionIndex()
	{
      
      $userId = User::checkLogged();

        // Информация о пользователе из БД
          $user = User::getUserById($userId);
	
       
        
        $users = Chat::fetchUser();
              
       // история чата по двум параметрам $userId и $user_id
       $chat_history = Chat::chatHistory($userId);

      
           
        if(isset($_POST['submit'])){

			
			$send['from_user_id'] =  $userId;//$_POST['from_user_id'];
			$send['chat_message'] = $_POST['chat_message'];
			
             $id = Chat::sendMessage($send);	

                header("Location: /chat");

			
		}

		require_once(ROOT. '/views/chats/index.php');
		return true;
	}

     /**
	*    Action для страницы чата пользователя с другим пользователем по идентификатору
	*/
    public function actionChatbox($user_id)
	{
		  $userId = User::checkLogged();

        // Информация о пользователе из БД
          $user = User::getUserById($userId);
	
        // Имя пользователя из БД по $id
		 $username = Chat::getUsername($user_id);
        
        $users = Chat::fetchUser();
              
       // история чата по двум параметрам $userId и $user_id
       $chat_history = Chat::chatHistory($userId, $user_id);

      
           
        if(isset($_POST['submit'])){

			
			$send['from_user_id'] =  $userId;//$_POST['from_user_id'];
			$send['chat_message'] = $_POST['chat_message'];
			
             $id = Chat::sendMessage($send);	

                header("Location: /chatbox/".$user_id);

			
		}

		require_once(ROOT. '/views/chats/chatbox.php');

		return true;
	}


}