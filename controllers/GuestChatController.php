<?php


/**
*  Контроллер GuestChatController
*  Чат с сообщениями пользователей для гостя
*/

class GuestChatController
{
     /**
	*    Action для страницы списка контактов и чатов гостя
	*/
	public function actionIndex()
	{
      
      // id пользователя по сессии
      $userId = session_id();

        
       $users = Chat::guestFetchUser();
          
       $username = "Гость";    
        $chat_history = Chat::chatHistory($userId);

		require_once(ROOT. '/views/guest_chats/index.php');
		return true;
	}
    
    /**
	*    Action для страницы чата гостя с определенным пользователем
	*/
    public function actionChatbox($user_id)
	{
		  $userId = session_id();

        // Информация о пользователе из БД
          $user = User::getUserById($userId);

       
		 $username = Chat::getUsername($user_id);
        
        $users = Chat::guestFetchUser();
        

        
       $chat_history = Chat::chatHistory($userId, $user_id);

    

		require_once(ROOT. '/views/guest_chats/chatbox.php');

		return true;
	}





}