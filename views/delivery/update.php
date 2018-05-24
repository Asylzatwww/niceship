<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Delivery */

$this->title = 'Изменить заказ : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'В интернет магазине', 'url' => ['shop']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';

echo $this->render('menu');
?>
<div class="delivery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'image' => $image,
    ]) ?>

</div>
