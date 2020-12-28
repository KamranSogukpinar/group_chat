<?php


/**
*  Контроллер UserController
*  страницы входа и регистрации пользователя
*/
class UserController
{
    
    /**
	*    Action для страницы регистрации
	*/
	public function actionRegister()
	{
		
        $messages = array();
		$messages = Message::getMessages(1);

		$name = '';
		$email = '';
		$password = '';
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
       
			if(User::checkEmailExists($email)){
				$errors[] = 'Такой email уже используется';
			}
        
			if($errors == false){
				// SAVE USER
				$result = User::register($name, $email, $password);
			}
		}

		require_once(ROOT.'/views/user/register.php');

		return true;
	}

     /**
	*    Action для страницы входа
	*/
	public function actionLogin()
	{
       
        
		$name = '';

		$email = '';
		$password = '';
		$result = false;  

		if(isset($_POST['submit'])){

			
			$email = $_POST['email'];
			$password = $_POST['password'];

			$errors = false;
			

			// Валидация полей
			if(!User::checkEmail($email))
			{
				$errors[] = 'Неправильная почта';
			}

			if(!User::checkPassword($password)){
				$errors[] = 'Пароль не должен быть короче 6ти символов';
			}

			// Проверяем существует ли пользователь
			$userId = User::checkUserData($email, $password);

			if($userId == false){
				// Если данные неправильные - показываем ошибку
				$errors[] = 'Неправильные данные для входа';
			}else{
				// Если правильные, запоминаем пользователя(сессия)
				User::auth($userId);

				// Перенаправляем пользователя в закрытую часть кабинет
				header("Location: /cabinet/");
			}
		}

		require_once(ROOT. '/views/user/login.php');

		return true;
	}

	/**
	* Удаляем данные пользователя из сессии
	*/
	public function actionLogout()
	{
		session_start();
		unset($_SESSION["user"]);
		header("Location: /");
	}

}