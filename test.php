<?php

if (!empty($_GET["name"])) {
	$tests=[];
	$tests = file_get_contents('./tests/'.$_GET['name']);
	$tests = json_decode($tests,true);
}
$_SESSION['tests'] = $tests;
?>
<?php 

$ok = [];
$notok = [];

	
if (!empty($_POST)) {

	foreach ($_POST as $post_key => $post_value) {
		foreach ($_SESSION['tests'] as $test) {
			if ($post_key == $test['title'] && $post_value == $test['correct']) {
				$ok[] = $test['title'];
			} 
			elseif ($post_key == $test['title'] && $post_value !== $test['correct']) {
				$notok[] = $test['title'];
			}
		}
	}
}
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
	<form action="" method="POST">
	<?php  foreach ($tests as $test) {?>
		
		<fieldset>
		<legend><?= $test['question'];?></legend>
		<?php foreach ($test['answers'] as $key => $answer ){ ?>
			<label><input type="radio" name="<?= $test['title'];?>" value="<?= $key;?>"><?= $answer['variant']; ?></label>
		<?php } ?>
		</fieldset>

		<?php } ?>	
		<input type="submit" name="send" value="Отправить">
	</form>
	<?php if(isset($_POST["send"])) { ?>

	<h3>Ваш результат: </h3>
	<?php echo "Верных ответов " . count($ok) . " из ". count($_SESSION['tests']);} ?>
	<?php foreach ($ok as $rightAnsw) { ?>
		<p>Верно: <?= $rightAnsw; ?></p>
	<?php } ?>

	<?php foreach ($notok as $notrightAnsw) { ?>
		<p>Неверно: <?= $notrightAnsw;?> </p>
	<?php } ?>

<br><br><br>

	<p><a href="admin.php">Вернуться к добавлению теста</a></p>
</body>
</html>
