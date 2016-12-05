<?php
/** 
* В папке views-> layouts - хранияться все шаблоны для сайта
* У одного сайта может быть несколько шаблонов 
* Создаим шаблон для сайта, назовем его basic.php
**/

/**
* Подключить шаблон можно Глобальным способом
* Папка config -> web.php 
* 'layout' => 'basic's
* $config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layout' => 'basic',
    'components' => [ 
**/

/**
* Если я хочу подключить на каждую станицу по шаблону
* Это локальный способ
* 
**/
?>

<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* Подключаем файл со стилями и скриптами */
use app\assets\AppAsset;

/* Подключаем helper */
use yii\helpers\Html;

AppAsset::register($this);
?>

<!--
Метки начало шаблона 
Используются для того чтобы можно было подключать стили и скрипты в определенной части шаблона
-->
<?php $this->beginPage() ?>

<!DOCTYPE html>
<!-- Здесь динамически прописывается язык в зависимости от настроек в config->web.php  'language' => 'ru-RU'  -->
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="UTF-8">
	<!-- Для адаптивности шаблона -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Прописываем теги с помощью класса хелпера, метод encode обварачивает в ф-ю htmlspecialchars -->
    <title><?= Html::encode($this->title) ?></title>
    <!-- С помощью Html::csrfMetaTags Yii генерирует спыециальные токены(ключи) -->
    <?= Html::csrfMetaTags() ?>
    <title>Document</title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<!-- Подключим меню bootstrap -->
	<div class="wrap">
		<div class="container">
			<ul class="nav nav-pills">
				<!-- Пропишем ссылки -->
				<!-- В документации Yii2 есть helper  -->
				<!-- public static string a ( $text, $url = null, $options = [] ) -->
				<!-- public static string a ( текст ссылки, пользоляет сгенерировать url адресс, $options = [] ) -->
				<li role="presentation" class="active"><?= Html::a('Главная','/web/') ?></li>
				<li role="presentation"><?= Html::a('Статьи', ['post/index']) ?></li>
				<li role="presentation"><?= Html::a('Статья', ['post/show']) ?></li>
			</ul>

			<?php //debug($this->blocks) ?>
			<?php if ( isset($this->blocks['block1']) ): ?>
				<?php echo $this->blocks['block1'] ?>
			<?php endif; ?>

			<!-- Выводим контент страницы, подключаем вид -->
			<?= $content ?>
		</div>		
	</div>

	<!-- Выводим контент страницы, подключаем вид -->
	<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>