<?php

/**
* Контроллер AdminProductController  
* Управление товарами в админпанели
*/
class AdminUsersController extends AdminBase
{

	public function actionIndex()
	{
		// Проверка доступа
	    self::checkAdmin();

	    // Список товаров 
	    $usersList = User::getUsersListAdmin();

	    require_once(ROOT .'/views/admin_users/index.php');
	    return true;
	}

	


	/**
	*   Метод для страницы удаление пользователя
	*/ 
	public function actionDelete($id)
	{
		self::checkAdmin();
        
        $user = User::getUserById($id);
		if(isset($_POST['delete'])) {
			Product::deleteUserById($id);
          
			header("Location: /admin/users");
			
		}else if(isset($_POST['back'])){

              header("Location: /admin/users");
              
		}

		require_once(ROOT. '/views/admin_users/delete.php');
		return true;
	}

	/**
	*   Метод для страницы редактирования пользователя
	*/ 
	public function actionUpdate($id)
	{
		self::checkAdmin();

		// Список пользователей для выпадающего списка
		 $usersList = User::getUsersListAdmin();

		$user = User::getUserById($id);

		if(isset($_POST['submit'])){
            if($_POST['role'] == 1){
            $role = 'admin';
            }else{
            $role = 'user';
            }
			$options['name'] = $_POST['name'];
			$options['email'] = $_POST['email'];
			$options['profession'] = $_POST['profession'];
			$options['status'] = $_POST['status'];
			$options['role'] = $role;

			
				if(User::updateUserById($id, $options)){

				// Запись добавлена
				
					// Проверка загрузки изображения
					if(is_uploaded_file($_FILES["image"]["tmp_name"])){
						// Перемещение и новое имя файла
						move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
						}
					}
				

                header("Location: /admin/users");

			
		}
		require_once(ROOT. '/views/admin_users/update.php');
		return true;
	}

	  /**
	*   Метод для страницы посмотра пользователя
	*/ 
	public function actionView($id)
	{
		self::checkAdmin();

		// Данные о конкретном заказе
		$user = User::getUserById($id);

	

		require_once(ROOT. '/views/admin_users/view.php');
		return true;
	}
}