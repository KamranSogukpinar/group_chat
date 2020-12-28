<?php

/**
*  Модель User
*/
class User
{
     /**
    * Возвращает массив пользователей для списка в админпанели</br>
    * @return array <p>Массив списка пользователей</p>
    */
    public static function getUsersListAdmin()
    {
        $db = Db::getConnection();

        $usersList = array();

        $result = $db->query('SELECT id, name, email, role, status, profession FROM user ORDER BY role DESC ');       
        
        $i = 0;
        while($row = $result->fetch()) {
            $usersList[$i]['id'] = $row['id'];
            $usersList[$i]['name'] = $row['name'];
            $usersList[$i]['email'] = $row['email'];
            $usersList[$i]['role'] = $row['role'];
            $usersList[$i]['status'] = $row['status'];
            $usersList[$i]['profession'] = $row['profession'];
            $i++;
        }

        return $usersList;
    }
    
   /**
    * Возвращает массив количества пользователей для списка в админпанели</br>
    * @return array <p>Массив кол-ва пользователей</p>
    */
    public static function countUsers()
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT * FROM user');
        
        $num_users = $result->rowCount();
        return $num_users;
    }

    
     /**
     * Регистрация пользователя 
     * @param type $name
     * @param type $email
     * @param type $password
     * @return type
     */
	public static function register($name, $email, $password)
	{

		$db = Db::getConnection();

		$sql = 'INSERT INTO user (name, email, password) VALUE (:name, :email, :password)';

		$result = $db->prepare($sql);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);

		return $result->execute();
	}


	/**
	* Редактирование данных пользователя
	* @param string $name
	* @param string $email
	* @param string $password
	*/
    public static function edit($id, $name, $email, $password)
    {

    	$db = Db::getConnection();

		$sql = 'UPDATE user SET name = :name, email = :email, password = :password WHERE id= :id';

		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);

		return $result->execute();
 
    }



	/**
	* Проверяем существует ли пользователь с заданными $email и $password
	* @param string $email
	* @param string $password
	* @return mixed : ingeger user id or false
	*/
	public static function checkUserData($email, $password)
	{
		$db = Db::getConnection();

		$sql = 'SELECT * FROM user WHERE email = :email AND password = :password';

		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_INT);
		$result->bindParam(':password', $password, PDO::PARAM_INT);
		$result->execute();

		$user = $result->fetch();
		if($user){
			return $user['id'];
		}

		return false;
	}

	/**
	* Запоминаем пользователя
	* @param string $email
	* @param string $password
	*/
    public static function auth($userId)
    {
    
    	$_SESSION['user'] = $userId;
    }


    public static function checkLogged()
    {
    	
    	// Если сессия есть, вернем идентификатор пользователя
    	if(isset($_SESSION['user']))
    	{
    		return $_SESSION['user'];
    	}

    	header("Location: /user/login");
    }

      
     public static function isGuest()
     {
     	
     	if(isset($_SESSION['user'])){
     		return false;
     	}
     	return true;
     }




	/**
	*    Проверяем имя: не меньше, чем 2 символа
	*/
    public static function checkName($name)
    {
    	if(strlen($name) >= 2){
    		return true;
    	}
    	return false;
    }

    /**
	*    Проверяем пароль: не меньше, чем 6 символа
	*/
    public static function checkPassword($password)
    {
    	if(strlen($password) >= 3){
    		return true;
    	}
    	return false;
    }
    
    /**
     * Проверяет телефон: не меньше, чем 10 символов
     */
    public static function checkPhone($phone)
    {
        if(strlen($phone) >= 10){
            return true;
        }
        return false;
    }


    /**
	*    Проверяем email
	*/
    public static function checkEmail($email)
    {
    	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    		return true;
    	}
    	return false;
    }

    public static function checkEmailExists($email){

    	$db = Db::getConnection();

    	$sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

    	$result = $db->prepare($sql);
    	$result->bindParam(':email', $email, PDO::PARAM_STR);
    	$result->execute();

    	if($result->fetchColumn())
    		return true;
    	return false; 
    }


    // Выводит пользователя по $id
    public static function getUserById($id)
    {
    	if($id){
    		$db = Db::getConnection();
    		$sql = 'SELECT * FROM user WHERE id = :id';

    		$result = $db->prepare($sql);
    		$result->bindParam(':id', $id, PDO::PARAM_INT);

    		// Указываем, что хотим получить данные в виде массива
    		$result->setFetchMode(PDO::FETCH_ASSOC);
    		$result->execute();


    		return $result->fetch();
    	}
    }

     //  обновляет последнее посещение(сеанс) пользователя
     public static function updateLastActivity()
     {
        $db = Db::getConnection();
        $_SESSION['login_details_id'] =  session_id();
        
        $sql = 'UPDATE last_activity SET last_activity = now() WHERE login_details_id = "'.$_SESSION['login_details_id'].'"';

        $result = $db->prepare($sql);
        

        return $result->execute();

     }


     /**
     *  Редактирование пользователя с заданыым id
     *  @param integer $id <p>id пользователя</p>
     *  @param array $options <p>Массив с информацией о пользователе</p>
     *  @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateUserById($id ,$options)
    {
        $db = Db::getConnection();

     $sql = 'UPDATE user
        SET 
            name = :name,
            email = :email,
            profession = :profession,
            status = :status,
            role = :role
        WHERE id = :id';
 

        // Получение и возврат результатов.(Подгтовительный запрос)
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
        $result->bindParam(':profession', $options['profession'], PDO::PARAM_STR);
       $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':role', $options['role'], PDO::PARAM_STR);
        
        return $result->execute();
    }
    

     /**
     *  Удаление пользователя с указанным id
     *  @param integer $id <p>id пользователя</p>
     *  @return boolean <p>Результат выподнения метода</p>
     */
     public static function deleteUserById($id)
     {
        $db = Db::getConnection();

        $sql = "DELETE FROM user WHERE id = :id";

        // Получение и возврат результатов
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
     }

     /**
    *   Возвращение пути к изображению
    *   @param integer $id
    *   @return string <p>Путь к изображению</p>
    */
    public static function getImage($id)
    {
        // Название изображения пустой картинки
        $noImage ='noimage.jpg';

        // Путь к папке с изображениями 
        $path = '/upload/images/products/';

        // Путь к изображению пользователя 
        $pathToProductImage = $path. $id . '.jpg';

        if(file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage))
        {
            // Если изображение для пользователя существует
            // Возвращается путь к изображению
            return $pathToProductImage;
        }

        return $path. $noImage;
    }

}