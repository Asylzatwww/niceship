<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mtransfer */

$this->title = 'Создать транзакцию';
$this->params['breadcrumbs'][] = ['label' => 'Все транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo \Yii::$app->view->renderFile('@app/views/delivery/menu.php');
?>
<div class="mtransfer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
