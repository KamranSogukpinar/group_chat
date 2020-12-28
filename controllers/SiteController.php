<?php


/**
*  Контроллер SiteController
*  Главная страница
*/

class SiteController
{
    
     /**
	*    Action для Главной страницы
	*/
	public function actionIndex()
	{
		

		require_once(ROOT. '/views/site/index.php');
		return true;
	}


}