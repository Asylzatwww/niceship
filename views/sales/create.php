<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sales */

$this->title = 'Создать распродажу';
$this->params['breadcrumbs'][] = ['label' => 'Распродажи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo \Yii::$app->view->renderFile('@app/views/delivery/menu.php');
?>
<div class="sales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
