<?php

namespace app\controllers;
/** 
* AppController наследует Controller поэтому нам нужно убрать из пространства имен 
* use yii\web\Controller; 
**/
// подключаем модель Category
use app\models\Category;
use Yii;
// подключаем модель TestForm
use app\models\TestForm;

// Передаем наследование AppController в класс PostController
class PostController extends AppController {

    // Для всех страниц контроллера PostController будет использоваться шаблон basic.phps
    public $layout = 'basic';

    /** Yii2 – позволяет также отключить проверку токена */
    // beforeAction() - метод который выполняется перед Action
    public function beforeAction($action) {
        if( $action->id == 'index' ) {
            // отключаем проверку токена
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
        //debug($action);
    }

    // выводим все статьи
    public function actionIndex() {
        // проверяем каким методом пришли данные
        if( Yii::$app->request->isAjax ) {
            // debug($_GET);
            // просмотр данных методами Yii2
            debug(Yii::$app->request->post());
            return 'test';
        }
        // create object model TestForm
        $model = new TestForm();

        // делаем проверку, удалось ли в модель загрузить данные
        if( $model->load(Yii::$app->request->post()) ) {
            // проверяем провалидированы ли данные
            if( $model->validate() ) {
                /*
                 * Используем сессии - так называемы flash сообщения
                 * Это данные который записываеются в сессию, но эти данные одноразовые -
                 * сразу после того как мы их запросили, они будут удалены из сесси
                 * это нам гарантирует, что сообщение об ошибке сразу удалиться, и не будет висеть на странице
                 * после обновления страницы оно пропадет
                 * обращаемся к объекту нашего приложения
                 * setFlash('key','value')
                 */
                Yii::$app->session->setFlash('success', 'Данные приняты');
                 // обновляем страницу (переадресовываем на саму себя) с помощью refresh
                // очищаем форму от старых записей
                return $this->refresh();

            } else {
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }
        // send object model TestForm to View
        return $this->render('test', compact('model'));

        // title можем доставать из БД и в контроллере его заполнять
        $this->view->title = 'Все статьи!';
        return $this->render('test');
    }
    // выводим одну статью
    // В render передаем название файла. Правильно называть файл именем actions
    public function actionShow() {
        // установим шаблон только на страницы show
        // $this->layout = 'basic';
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => 'ключевики...']);
        $this->view->registerMetaTag(['name' => 'description', 'content' => 'описание страницы']);        
        $this->view->title = 'Одна статья!';

        /**
         * в $cats переменную вернем результат выборки
         * Это является аналогом SELECT * FROM categories
         */
        // $cats = Category::find()->all();
        // сортировка данных
        // по умолчанию SORT_ASC ($cats = Category::find()->orderBy(['id'] => SORT_ASC)->all();)
        // $cats = Category::find()->orderBy(['id' => SORT_DESC])->all();

        /**
         * возвращаем результат не ввиде объекта, а в виде массива
         * в Yii рекомендуется возвращать данные в виде массива
         * это занимает меньше памяти и вместо 3 запросов всего 1
         * в виде обращаемся к массиву не как к объекту $cat->title, а $cat['title']
         */
        //$cats = Category::find()->asArray()->all();

        /**
         * WHERE parent = 691
         */
        // $cats = Category::find()->asArray()->where('parent=691')->all();
        // или передать значение в where в виде массива(['parent' => 691])
        // $cats = Category::find()->asArray()->where(['parent' => 691])->all();


        /**
         * LIKE
         * выбрать поле title, где подряд идут pp
         */
        // $cats = Category::find()->asArray()->where(['like', 'title', 'pp'])->all();

        // получить записи WHERE id <= 695
        //$cats = Category::find()->asArray()->where(['<=', 'id', 695])->all();

        // LIMIT 1
        // $cats = Category::find()->asArray()->where(['parent' => 691])->limit(1)->all();

        /**
         * LIMIT 1 "->one()"
         * данный метод получает только одну запись
         * SELECT * FROM `categories` WHERE `parent`=691
         * данный запрос является избыточным, он получает все равно все записи с `parent`=691
         * но в массив попадет только одна запись, нужно все равно указывать ->limit(1)
        */
        //$cats = Category::find()->asArray()->where(['parent' => 691])->limit(1)->one();

        // COUNT
        //$cats = Category::find()->asArray()->where(['parent' => 691])->count();

        /**
         * findOne() - возвращает один объект, в который попадет 1-я строка результата запроса
         * данный метод также вытягивает все записи, но выволит только одну
         * у него нет LIMIT 1
         * findAll() - возвращает массив ообъектов заполненый всеми результатами запроса
         */
        //$cats = Category::findOne(['parent' => 691]);
        //$cats = Category::findAll(['parent' => 691]);

        /**
         * При сложных запросах используем findBySql($query);
         * но такой вид использования не всегда удобен, так как '%pp%' приходит от пользователя
         * из формы поиска, и что пользователь туда введет мы не знаем, это может быт sql injection
         * в этом случаем рекомендуется использовать параметры, запрос будет экранирован
         */

        // $query = "SELECT * FROM categories WHERE title LIKE '%pp%'";
        // $cats = Category::findBySql($query)->all();

        // $query = "SELECT * FROM categories WHERE title LIKE :search";
        // findBySql(запрос, массив параметров)
        // $cats = Category::findBySql($query, [':search' => '%pp%'])->all();


        /**
         * Связываем модель категорий с моделью продуктов
         * Получим категорию 694
         * Если не указать параметры в findOne()- по умолчанию берет id
         */
        //$cats = Category::findOne(694);

        /**
         * метод with() - позволяет получить сразу все данные (жадный метод)
         * объединяем результат с products
         */
        // $cats = Category::find()->with('products')->where('id=694')->all();

        // при таком запросе выполниться 36 запросов
        // каждый раз будет только меняться номер категории
        // SELECT * FROM `products` WHERE `parent`='693'
        // $cats = Category::find()->all(); // отложенная загрузка

        // объедить все 36 запросов в один применив with('products')
        $cats = Category::find()->with('products')->all(); // жадная загрузка

        /**
         * Если у вас немного объектов - массив из 2-3 объектов, либо один объект
         * И не нужны связи между таблицами - это "отложенная загрузка"
         *
         * Если массив из множества объектов - это "жадная загрузка"
         */

        // передаем в вид данный результат compact('cats')
        return $this->render('show', compact('cats'));
    }   

}

/**
* Создадим вид в папке views->post->show.php
**/



























