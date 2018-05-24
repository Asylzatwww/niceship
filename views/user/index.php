<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
//$this->params['breadcrumbs'][] = $this->title;

echo \Yii::$app->view->renderFile('@app/views/delivery/menu.php');
?>
<div class="user-index">

    <h1><span class="glyphicon glyphicon-list"></span> <?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            //'password',
            //'authKey',
            //'accessToken',
            'email:email',
            'firstname',
            'lastname',
            'money',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
