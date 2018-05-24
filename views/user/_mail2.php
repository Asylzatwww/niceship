<?php
if (isset($transfer)){
	if ($transfer == 'nice') echo 'Деньги успешно переведены'; else echo 'Пользователь успешнл перевел деньги';
} else if (isset($deliver)){
	echo '<div style="margin:10px"><h3>Название товара - ' . $deliver->name . '</h3> <h3>Цена - ' . $deliver->prize . '</h3> <h3> Вес - ' . $deliver->weight . '</h3><br>';
	echo '<h3>Пользователь - ' . Yii::$app->user->identity->username . '</h3></div>';
}
?>
