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
class Product extends ActiveRecord {
    /**
     * указываем модели, что мы хотим работать с какой то конкретной таблицей
     */

    public static function tableName() {
        // указываем таблицу из БД с которой хотим работать
        return 'products';
    }


    /**
     * Одна категория может иметь множество продуктов
     * hasOne(имя класса c которым связываем, массив['' => '']) - связь один к одному
     * в данном случае один продукт относиться к одной категории
     * Categories() - произвольное название метода
     * get должно быть обязательным
     * Category::className() - имя класса с которым связываем нашу модель Product
     */

    public function getCategories() {
        return $this->hasOne(Category::className(), ['id' => 'parent'] );
    }}



