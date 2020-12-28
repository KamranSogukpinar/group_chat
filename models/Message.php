<?php

/*
*    Модель Message
*/
class Message
{


	const SHOW_BY_DEFAULT = 3;

	







    /**
    *   Возвращение пути к изображению
    *   @param integer $id
    *   @return string <p>Путь к изображению</p>
    */
    public static function getImage($id)
    {
        // Название изображения пустой картинки
        $noImage ='noimage.jpg';

        // Путь к папке с товарами 
        $path = '/upload/images/products/';

        // Путь к изображению товара 
        $pathToProductImage = $path. $id . '.jpg';

        if(file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage))
        {
            // Если изображение для товара существует
            // Возвращается путь к изображению
            return $pathToProductImage;
        }

        return $path. $noImage;
    }




}