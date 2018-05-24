<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Delivery */

$this->title = 'Пополнить счет';

echo $this->render('menu');
?>
<div class="balance-view">

    <h1><?= Html::encode($this->title) ?></h1>

	<h3>Оплату можно произвести двумя способами:</h3> 
	<div class="bs-callout bs-callout-info" id="callout-input-needs-type"> 
		<p>
			1. Можно перевести деньги на банковский счет и связаться  с администратором сайта через форму обратной связи или 
			телефонный звонок, чтобы уточнить дату и номер счета перевода для администратора, чтобы он пополнил ваш баланс на сайте.
		</p>
		<p>Номер Яндекс кошелька для перевода - 410012029706877</p>
    </div>

	<div class="bs-callout bs-callout-info" id="callout-input-needs-type"> 
		<p>2. Или вы можете перевести деньги через нашу форму для перевода</p>
        <p>Оплата производится из банковской карты или кошелька в системе Яндекс.Деньги</p>
        <p>Оплата зачисляется в режиме online;</p>
        <p>Взымается небольшая комиссия за перевод средств : яндекс кошелек 0.5%, через банковскую карту 2%;</p>
    </div>

    <h2><span class="glyphicon glyphicon-usd"></span> Оплата через систему Яндекс Деньги</h2>

    <div class="row">

    	<div class="col-12 col-xs-12 col-sm-4 col-md-4 col-lg-4">
    		<img src="/img/1309925053-yandex_money.png" class="lazy lazyload" />
    	</div>


    	<div class="col-12 col-xs-12 col-sm-4 col-md-4 col-lg-4">


			<form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml">
			    <input type="hidden" name="receiver" value="410012029706877">
			    <input type="hidden" name="formcomment" value="Qwintry : Пополнение баланса, пользователь <?= Yii::$app->user->identity->username ?>">
			    <input type="hidden" name="short-dest" value="Qwintry : Пополнение баланса, пользователь <?= Yii::$app->user->identity->username ?>">
			    <input type="hidden" name="label" value="<?= Yii::$app->user->identity->id ?>">
			    <input type="hidden" name="quickpay-form" value="shop">
			    <input type="hidden" name="targets" value="Qwintry : Пополнение баланса, пользователь <?= Yii::$app->user->identity->username ?>">
			    
			    <div class="row">
			    	<br><br><br>
				    <label class="col-md-8">Введите сумму для перевода</label>
				    <input type="text" name="sum" value="" class="col-md-4" data-type="number">
				    <br>
				    <input type="radio" name="paymentType" value="PC" class="col-md-2">
				    <label class="col-md-10">Яндекс Деньгами</label>
				    <br>
				    <input type="radio" name="paymentType" value="AC" class="col-md-2">
				    <label class="col-md-10">Банковской картой</label>
				</div>
				<br>

			    <input type="submit" class="btn btn-success col-md-8" value="Перевести">
			</form>

    	</div>


    </div>



</div>
