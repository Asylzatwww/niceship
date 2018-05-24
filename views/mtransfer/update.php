<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mtransfer */

$this->title = 'Изменить транзакцию : ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Все транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';

echo \Yii::$app->view->renderFile('@app/views/delivery/menu.php');
?>
<div class="mtransfer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
