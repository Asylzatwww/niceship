<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>




	<div class='check col-12 col-xs-12 col-sm-4 col-md-4 col-lg-4'>
		<img src="/img/mailservice.png" width="100%" />
		<img src="/img/mailservice5.png" style="margin-left: 300px;width: 7%;" />

		<div class='ch-height'>
			<p style="text-align:center;">Платеж успешно выполнен</p>
			<img src="/img/mailservice2.png"  width="100%" />
			<div class="row">
				<p class='col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6'>Назначение платежа</p>
				<p class='col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6'><b><?= Html::encode($model->description) ?></b></p>

				<p class='col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6'>Дата и время</p>
				<p class='col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6'><b><?= str_replace('Z', ' ', str_replace('T', ' ', Html::encode($model->datetime))) ?></b></p>

				<p class='col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6'>Переведено денег на сумму</p>
				<p class='col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6'><b><?= Html::encode($model->amount) ?></b></p>

				<?php if (!empty($model->sender)) { ?>

					<p class='col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6'>Переведено со счета</p>
					<p class='col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6'><b><?= Html::encode($model->sender) ?></b></p>

					<p class='col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6'>Оплата произведена через</p>
					<p class='col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6'><b>
						<?php if ($model->notification_type == 'p2p-incoming') echo 'Яндекс деньги'; else echo 'Банковскую карту'; ?>
					</b></p>

					<p class='col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6'>Комиссия</p>
					<p class='col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6'><b><?php echo $model->withdraw_amount - $model->amount; ?></b></p>

				<?php } ?>
	
				<img src="/img/mailservice2.png"  />
				<p class='col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6'><b>Доступно</b></p>
				<p class='col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6'><b><?= Html::encode($model->balance) ?></b></p>
				<img src="/img/mailservice3.png" />

			</div>

		</div>

		<img src="/img/mailservice4.png"  width="100%" />

	</div>