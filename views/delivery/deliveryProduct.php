<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>




	<div class='product col-12 col-xs-12 col-sm-3 col-md-3 col-lg-3'>
		<div class='pr-height'>
				<img class='image-responsible' src='/upload/delivery/<?php if ($model->image != "") echo $model->image; else echo "no-image"; ?>.jpg' />
				<h3>Название : <?= Html::encode($model->name) ?></h3>
				<p>Код товара : <?= Html::encode($model->id) ?> </p>
			<div class="prize">Стоимость : <?= Html::encode($model->prize) ?> $</div>
			<p>Количество : <?= Html::encode($model->count) ?> штук</p>
			<p>Вес : <?= Html::encode($model->weight) ?> кг.</p>
			
			<?php if ($edit) { ?>
			
				<a href="/delivery/update?id=<?= $model->id ?>" title="Update" aria-label="Update" class="btn btn-primary">
					<span class="glyphicon glyphicon-pencil"></span> Изменить
				</a>
				<a href="/delivery/delete?id=<?= $model->id ?>" title="Delete" aria-label="Delete" 
					data-confirm="Are you sure you want to delete this item?" class="btn btn-danger" data-method="post">
					<span class="glyphicon glyphicon-remove"></span> Удалить
				</a>

			<?php } ?>

		</div>

	</div>