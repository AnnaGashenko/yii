<h1>Action Index</h1>
<?php echo $hi ?>
<br>

<!-- Выводим $_GET['id'] -->
<?php echo $id ?>
<br>

<?php 
// выводим в цикле все имена
foreach($names as $value){
	echo $value . '<br>';
}

?>