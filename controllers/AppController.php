<?php
// пространство имен
namespace app\controllers;

use yii\web\Controller;


/** Создадим собственный класс, который будет доступен во всем приложении 
* Класс вывод массивов и объектов на экран
* Функция для вывода debug (ошибок на экран)
* Созадим общий контроллер который мы будем наследовать всеми останальными контроллерами
* А наш общий контроллер будем один раз наследовать контроллера Yii2 extends Controller 
**/
class AppController extends Controller {

   public function debug($arr) {
   		echo '<pre>' .print_r($arr, true). '</pre>';
   }
}