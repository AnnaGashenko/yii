<?php
/**
 * Created by PhpStorm.
 * User: Anna
 * Date: 01-Dec-16
 * Time: 02:37 PM
 */

namespace app\models;


use yii\db\ActiveRecord;

/**
 * Class Category
 * @package app\models
 * расширяет класс ActiveRecord
 * подключаем таблицу categories из БД
 */
class Category extends ActiveRecord {
    /**
     * указываем модели, что мы хотим работать с какой то конкретной таблицей
     */

    public static function tableName() {
        // указываем таблицу из БД с которой хотим работать
        return 'categories';
    }

    /**
     * Одна категория может иметь множество продуктов
     * hasMany(имя класса c которым связываем, массив['' => '']) - связь один ко многим
     * Products() - произвольное название метода
     * get должно быть обязательным
     * Product::className() - имя класса с которым связываем нашу модель Category
     */

    public function getProducts() {
        return $this->hasMany(Product::className(), ['parent' => 'id'] );
    }





}