<?php

 /**
    * Модель Chat
    */
class Chat
{

	 /**
    * Возвращает массив сообщений пользователей для списка в админпанели</br>
    * @return array <p>Массив списка сообщений</p>
    */
 

    public static function getMessagesAdminList()
    {
        $db = Db::getConnection();

        $chats = array();

        $result = $db->query('SELECT * '
            . 'FROM chat_message '
            . 'ORDER BY chat_message_id ASC ');       
        
        $i = 0;
        $from_user_name = array();
        $to_user_name = array();
        while($row = $result->fetch()) {
            $from_user_id = $row['from_user_id'];
            $from_user_name = self::getUsername($from_user_id);
           
            $chats[$i]['chat_message_id'] = $row['chat_message_id'];
            $chats[$i]['from_user_id'] = $row['from_user_id'];
            $chats[$i]['timestamp'] = $row['timestamp'];
            $chats[$i]['status'] = $row['status'];
            $chats[$i]['chat_message'] = $row['chat_message'];
            $chats[$i]['incorrect'] = $row['incorrect'];
             $chats[$i]['from_user_name'] = $from_user_name;
             $chats[$i]['to_user_name'] = $to_user_name;

            $i++;
        }

        return $chats;
    }


     /**
    * Возвращает сообщение пользователя по $id</br>
    * @return data <p>сообщение</p>
    */
     public static function getMessageById($id)
     {
        $id = intval($id);
        
        if($id){
            // Запрос к БД
            $db = Db::getConnection();

            $result = $db->query('SELECT * from chat_message WHERE chat_message_id=' . $id); 

            // $result->setFetchMode(PDO::FETCH_NUM) ;
             $result->setFetchMode(PDO::FETCH_ASSOC) ;

            $chat_message = $result->fetch();

            return $chat_message;
        }
     }

     /*
            Отмечает сообщение(некорректное)
     */

     public static function incorrectMessageById($id)
     {
        $db = Db::getConnection();

     $sql = 'UPDATE chat_message 
        SET 
            incorrect = 1
        WHERE chat_message_id = :id';

        // Получение и возврат результатов.(Подгтовительный запрос)
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
       
        return $result->execute();
     }
     


     // Отмечает сообщение(корректное)
     public static function correctMessageById($id)
     {
        $db = Db::getConnection();

     $sql = 'UPDATE chat_message 
        SET 
            incorrect = 0
        WHERE chat_message_id = :id';

        // Получение и возврат результатов.(Подгтовительный запрос)
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
       
        return $result->execute();
     }


    /**
     * Подсчитывает кол-во сообщений пользователей
    */
    public static function countMessages()
    {
         $db = Db::getConnection();
        $result = $db->query('SELECT * FROM chat_message');
        
        $num_messages = $result->rowCount();
        return $num_messages;

    }


/**
     * Выводит последний сеанс пользователя
*/
public static function fetch_user_last_activity($user_id, $db)
   {
     $db = Db::getConnection();
 $query = "
 SELECT * FROM login_details 
 WHERE user_id = '$user_id' 
 ORDER BY last_activity DESC 
 LIMIT 1
 ";
 $statement = $db->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['last_activity'];
 }
}



   /**
     * Выводит список контактов(гостя)
    */
  public static function guestFetchUser()
  {
      $users = array();
      $db = Db::getConnection();
      $_SESSION['id'] = session_id();
      $result = $db->query('SELECT * FROM user WHERE id != "'.$_SESSION['id'].'"');
       $i = 0;
        while($row = $result->fetch()) {
        
         $status = '';
         $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
         $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
         $user_last_activity = self::fetch_user_last_activity($row['id'], $db);
         if($user_last_activity > $current_timestamp)
         {
              $status = 'Online';
          } 
          
        $users[$i]['id'] = $row['id'];
        $users[$i]['name'] = $row['name'];
         $users[$i]['profession'] = $row['profession'];
        $users[$i]['status'] = $status ;
        $users[$i]['role'] = $row['role'];
         
          $i++;
        }

        return $users;

  }


   /**
     * Выводит список контактов(пользователей)
    */
  public static function fetchUser()
  {
      $users = array();
      $db = Db::getConnection();
      $_SESSION['id'] = User::checkLogged();
      $result = $db->query('SELECT * FROM user WHERE id != "'.$_SESSION['id'].'"');
       $i = 0;
        while($row = $result->fetch()) {
        
         $status = '';
         $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
         $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
         $user_last_activity = self::fetch_user_last_activity($row['id'], $db);
         if($user_last_activity > $current_timestamp)
         {
              $status = 'Online';
          } 
          
        $users[$i]['id'] = $row['id'];
        $users[$i]['name'] = $row['name'];
         $users[$i]['profession'] = $row['profession'];
        $users[$i]['status'] = $status ;
        $users[$i]['role'] = $row['role'];
         
          $i++;
        }

        return $users;

  }



//   Тестовая функция

  public static function status($status)
  {
    switch ($status) {
        case '0':
          return 'Оффлайн';
          break;
        
        case '1':
          return 'Онлайн';
          break;

       } 
  }
  
//  Выводит имя пользователя по $id
public static function getUsername($user_id)
{
  $db = Db::getConnection();
  $query = "SELECT name FROM user WHERE id = '$user_id'";
 $statement = $db->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['name'];
 }
}

// Выводит историю переписки по двум параметрам(для пользователей и гостей)
public static function chatHistory($userId)
{
     $db = Db::getConnection();
    $query = "SELECT * FROM chat_message WHERE incorrect != 1 ORDER BY timestamp";
 $statement = $db->prepare($query);
 $statement->execute();

 $result = $statement->fetchAll();

 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
  $user_name = '';
  if($row["from_user_id"] == $userId)
  {
   $user_name = '<b class="text-success">You</b>';
  }
  else
  {
   $user_name = '<b class="text-danger">'.self::getUsername($row['from_user_id'], $db).'</b>';
  }

  $output .= '

  <li style="border-bottom:1px dotted #ccc">
   <p>'.$user_name.' - '.$row['chat_message'].' 
    <div align="right">
     - <small><em>'.$row['timestamp'].'</em></small>
    </div>
   </p>
  </li>
  ';
 }
 $output .= '</ul>';
 return $output;

}





// Выводит историю переписки для админа(с отмеченными сообщениями)
public static function chatAdminHistory($userId)
{
     $db = Db::getConnection();
    $query = "
 SELECT * FROM chat_message ORDER BY timestamp";
 $statement = $db->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '<ul class="list-unstyled">';
 $warning = '<span>&#9888;</span>';
 foreach($result as $row)
 {
  $user_name = '';
  if($row["from_user_id"] == $userId)
  {
   $user_name = '<b class="text-success">You</b>';
  }
  else
  {
   $user_name = '<b class="text-danger">'.self::getUsername($row['from_user_id']).'</b>';
  }
  if($row['incorrect']==1){
  $output .= '
  <li style="border-bottom:1px dotted #ccc">
   <p>'.$user_name.' - '.$row["chat_message"].'
   '.$warning.'
    <div align="right">
     - <small><em>'.$row['timestamp'].'</em></small>
    </div>
   </p>
  </li>
  ';
  }else{
    $output .= '
  <li style="border-bottom:1px dotted #ccc">
   <p>'.$user_name.' - '.$row["chat_message"].'
    <div align="right">
     - <small><em>'.$row['timestamp'].'</em></small>
    </div>
   </p>
  </li>
  ';
  }
 }
 $output .= '</ul>';
 return $output;

}




// Метод отправки сообщения
public static function sendMessage($send)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO chat_message'
        . '(from_user_id, chat_message) '
        . 'VALUES'
        . '(:from_user_id, :chat_message)';

        // Получение и возврат результатов.(Подгтовительный запрос)
        $result = $db->prepare($sql);
        
        $result->bindParam(':from_user_id', $send['from_user_id'], PDO::PARAM_INT);
        $result->bindParam(':chat_message', $send['chat_message'], PDO::PARAM_STR);
       
       
        if($result->execute()){
            // Если запрос выполнен успешно, возвращается id добавленной записи
            return $db->lastInsertId();
        }
        return 0;
    }




    // Тестовая функция 
    public static function getChatById($id)
     {
        $id = intval($id);
        
        if($id){
            // Запрос к БД
            $db = Db::getConnection();

            $result = $db->query('SELECT * from chat WHERE id=' . $id); 

            // $result->setFetchMode(PDO::FETCH_NUM) ;
             $result->setFetchMode(PDO::FETCH_ASSOC) ;

            $chat = $result->fetch();

            return $chat;
        }
     }

    

}

