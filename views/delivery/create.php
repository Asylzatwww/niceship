<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Delivery */

$this->title = 'Купите мне';
$this->params['breadcrumbs'][] = ['label' => 'В интернет магазине', 'url' => ['shop']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('menu');
?>
<div class="delivery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'image' => $image,
    ]) ?>

</div>
