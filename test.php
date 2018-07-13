<?php
session_start();
if (!empty($_GET["name"])) {
	$tests=[];
	$tests = file_get_contents('./tests/'.$_GET['name']);
	$tests = json_decode($tests,true);
}
$_SESSION['tests'] = $tests;
?>

<!DOCTYPE html>
<html lang="ru">
<html>
<head>
	<meta charset="utf-8">
	<title>Домашнее задание к лекции 2.2</title>
</head>
<html>
<body>
	<h3>Пройди тест</h3>
	<form action="send.php" method="POST">
	<?php  foreach ($tests as $test) {?>
		
		<fieldset>
		<legend><?= $test['question'];?></legend>
		<?php foreach ($test['answers'] as $key => $answer ){ ?>
			<label><input type="radio" name="<?= $test['title'];?>" value="<?= $key;?>"><?= $answer['variant']; ?></label>
		<?php } ?>
		</fieldset>

		<?php } ?>	
		<input type="submit" value="Отправить">
	</form>
<br><br><br>

	<p><a href="admin.php">Вернуться к добавлению теста</a></p>
</body>
</html>
