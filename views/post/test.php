<?php
use\yii\widgets\ActiveForm;
// import helpers Html
use yii\helpers\Html;

?>

<h1>Test Action</h1>

<?php
	// debug(Yii::$app);
    // print, model TestForm
    // debug($model);
?>

<!-- hasFlash('success') проверяем есть ли сессия с ключем = 'success'  -->
<?php if( Yii::$app->session->hasFlash('success') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo  Yii::$app->session->getFlash('success'); ?>
    </div>
<?php endif; ?>

<!-- hasFlash('success') проверяем есть ли сессия с ключем = 'success'  -->
<?php if( Yii::$app->session->hasFlash('error') ): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo  Yii::$app->session->getFlash('error'); ?>
    </div>
<?php endif; ?>


<!-- Создаем объект формы ActiveForm-->
<!-- метод формы begin() - запускает создание формы -->
<?php $form = ActiveForm::begin(['options' => ['id' =>'testForm']]) ?>
<!-- field(модель, атрибут) -->
<!-- passwordInput() - поле type="password" -->
<!-- Передадим опции в форму-->
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'email')->input('email') ?>
<!-- textarea(['rows' => 10]) делает поле типа textarea высотой 5 ячееек -->
<?= $form->field($model, 'text')->textarea(['rows' => 5]) ?>
<!-- Создадим кнопку submitButton(надпись на кнопке, массив опций) -->
<?= Html::submitButton('Отправить', ['class' => 'btn btn-success'])?>
<!-- метод формы end() - закрывает форму -->
<?php ActiveForm::end() ?>