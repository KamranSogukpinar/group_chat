<?php


/**
*  Контроллер CabinetController
*  Страница пользователя с информацией о нём
*/
class CabinetController
{
     /**
	*    Action для страницы кабинета пользователя
	*/
	public function actionIndex()
	{     
		  $userId = User::checkLogged();

        // Информация о пользователе из БД
          $user = User::getUserById($userId);
		 

	
        
        $users = Chat::fetchUser();
			

		require_once(ROOT. '/views/cabinet/index.php');

		return true;
	}
    
     /**
	*    Action для страницы редактирования данных о пользователе
	*/
	public function actionEdit()
	{

		
		// идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Информация о пользователе из БД
        $user = User::getUserById($userId);

        $name = $user['name'];
        $email = $user['email'];
        $password = $user['password'];

        $result = false;

        if(isset($_POST['submit'])){

			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = $_POST['password'];

			$errors = false;

			if(!User::checkName($name)){
				$errors[] = 'Имя не должно быть короче 2х символов';
			}
			
			if(!User::checkEmail($email))
			{
				$errors[] = 'Неправильная почта';
			}

			if(!User::checkPassword($password)){
				$errors[] = 'Пароль не должен быть короче 6ти символов';
			}

			if($errors == false){
				// SAVE USER
				$result = User::edit($userId, $name, $email, $password);
			}
		}

        require_once(ROOT. '/views/cabinet/edit.php');

        return true;
	}
}