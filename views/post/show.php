
<?php
// но так делать не очень удобно
// $this->title = 'Одна статья';
?>

<!-- Передаем данные из вида в шаблон -->
<?php $this->beginBlock('block1'); ?>
	<h1>Заголовок страницы</h1>
<?php $this->endBlock(); ?>

<h1>Show Action</h1>

<!-- Выведем все названия категорий -->

<?php
/*foreach ($cats as $cat) {
	echo $cat->title . '<br>';
}*/
?>
<!--
	Такой вид связи является ленивой или отложенной загрузкой:
	Если не обращаемся, то загрузка не произойдет
	Если у нас прописана связь между двумя моделями,
	то она срабатывает только в момент использования этой связи
	только в момент обращения к связаной модели
	в данном случае используя запись $cats->products
	фактически выполняется SQL запрос: 	SELECT * FROM `products` WHERE `parent`='694'
	елси бы не было обращения к $cats->products запрос бы не выполнился
 -->

<!--
	Но отложенная загрузка несет в себе определенную опасность
	Ели мы работаем с массивом объектов, то фактически для каждого объекта
	будет выполнен свой SQL запрос
-->

<?php //debug($cats) ?>
<!-- Посчитаем сколько продуктов попало в категорию -->
 <?php// echo count($cats[0]->products) ?>
<!-- При жадном поиске, попадает многомерный массив, обращаемся $cats[0] к нулевому -->
<?php //echo count($cats[0]->products) ?>
<?php //debug($cats) ?>

<!-- Выведим категории и ниже товары этих категорий -->
<?php
foreach ($cats as $cat) {
	echo '<ul>';
		echo '<li>' . $cat->title . '</li>';
	/**
	 * получаем products
	 * обращаясь к объекту $cat и к его свойству products
	 * используем ту самую, отложеную загрузку
	 */
		$products = $cat->products;
		foreach ($products as $product) {
			echo '<ul>';
			echo '<li>' . $product->title . '</li>';
			echo '</ul>';
		}
	echo '</ul>';
}
?>




<!-- Создадим кнопку которая отправляет данные со страницы show.php на index.php  -->
<button id="btn" class="btn btn-success">Click me...</button>

<!-- Но не хотим подключать отдельный файл со скриптом, а хотим подключить блок кода который будет выполнять ajax запрос --> 
<?php

$js = <<<JS
	$('#btn').on('click', function() {
		$.ajax({
			url: 'index.php?r=post/index',
			data: {test: '123'},
			type: 'POST',
			success: function (res) {
				console.log(res);
			},
			error: function () {
				alert('Error!');
			}
		});
	});

JS;

$this->registerJs($js);
?>

<!-- Подключаем скрипт только на этой странице -->
<!-- ['depends' => 'yii\web\YiiAsset'] Зависимость файла -->
<?php // $this->registerJsFile('@web/js/scripts.js', ['depends' => 'yii\web\YiiAsset']) ?>


<!-- 
* Если кода немного, то не целесообразно подключать целый файл
* В таком слочае можно подключить часть кода
* С помощью метода registerJs()

-->

<?php 
// $this->registerJs("$('.container').append('<p>SHOW!!!</p>');") 

//$this->registerJs("$('.container').append('<p>SHOW!!!</p>');",\yii\web\View::POS_LOAD) 
?>


<!--
public void registerJs ( $js, $position = self::POS_READY, $key = null )
	POS_HEAD: in the head section
	POS_BEGIN: at the beginning of the body section
	POS_END: at the end of the body section
	POS_LOAD: enclosed within jQuery(window).load(). Note that by using this position, the method will automatically register the jQuery js file.
	POS_READY: enclosed within jQuery(document).ready(). This is the default value. Note that by using this position, the method will automatically register the jQuery js file.
-->

<!--
		POS_READY: стоит по умолчанию и оборачивает код 
		в конструкцию jQuery(document).ready(). 
		POS_LOAD:

-->

<!-- 
		POS_LOAD: enclosed within jQuery(window).load(). Note that by using this position, the method will automatically register the jQuery js file.
-->
<?php 
	// вторым параметром передаем способ загрузки скрипта
	// $this->registerJs("$('.container').append('<p>SHOW!!!</p>');",\yii\web\View::POS_LOAD) 
?>


<!-- 
* registerCss() public method 
-->
<?php //$this->registerCss('.container{background: #ccc;}') ?>