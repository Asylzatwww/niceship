<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Mtransfer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Все транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo \Yii::$app->view->renderFile('@app/views/delivery/menu.php');
?>
<div class="mtransfer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверенны в том что хотите удалить ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'amount',
            'datetime',

            'notification_type', 
            'operation_id', 
            'withdraw_amount', 
            'currency', 
            'sender', 
            'codepro', 
            'label',
        ],
    ]) ?>

</div>
