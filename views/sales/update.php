<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sales */

$this->title = 'Редактировать распродажу: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Распродажи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактровать';

echo \Yii::$app->view->renderFile('@app/views/delivery/menu.php');
?>
<div class="sales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
