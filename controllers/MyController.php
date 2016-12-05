<?php
// пространство имен
namespace app\controllers;

/** AppController наследует Controller поэтому нам нужно убрать из пространства имен use yii\web\Controller; **/
// Передаем наследование AppController в класс MyController
class MyController extends AppController {

    // чтобы передать переменную через адресную строку, передаем ее в actionIndex($id = null)
    public function actionIndex($id = null){
        $hi = 'Hello, World!';
        // создадим массив имен $names
        $names = ['Ivanov', 'Petrov','Sidorov'];
        // передаем массив в render
        // первый параметр- под каким именем он будут доступен в виде 'names'
        // return $this->render('index', ['hello' => $hi, 'names' => $names]);


        // делаем проверку, если $id не определенно, то $id = 'test'
        if(!$id) $id = 'test';

        // ещё один способ - использовать php function compact()
        return $this->render('index', compact('hi','names','id'));
    }

    // Можно давать название контроллерам двойные используя верблюжий стиль
    public function actionBlogPost() {
        // чтобы вызвать такой action из командной строки
        // my/blog-post - правила написания: вместо BlogPost -> blog-post
        return 'Blog Post';
    }
}







