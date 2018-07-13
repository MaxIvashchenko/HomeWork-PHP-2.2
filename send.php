<?php 
session_start();
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
	<title>Домашнее задание к лекции 2.2</title>
	<meta charset="utf-8">
</head>
<body>
	<h2>Ваш результат: <?= count($ok);?> из <?= count($_SESSION['tests']);?></h2>

	<?php foreach ($ok as $rightAnsw) { ?>
		<p>Верно: <?= $rightAnsw; ?></p>
	<?php } ?>

	<?php foreach ($notok as $notrightAnsw) { ?>
		<p>Неверно: <?= $notrightAnsw;?> </p>
	<?php } ?>

	<br>

	<p><a href="admin.php">Вернуться к добавлению теста</a></p>
</body>
</html>