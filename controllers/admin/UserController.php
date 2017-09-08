<?php
// указываем путь к нашему классу UserController
namespace app\controllers\admin;

use z;

// Создаем в папке "controllers" папку "admin" в ней controller UserController.php
class UserController extends Controller {

    public function actionIndex(){
        $hi = 'Hello, World!';

        // подгружаем вид
         return $this->render('index');
    }
}







