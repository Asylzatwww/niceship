<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeliverySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $status;
//$this->params['breadcrumbs'][] = $this->title;

echo $this->render('menu', [ 'step' => 2, ]);

?>

<div class="delivery-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <div class='bs-callout bs-callout-info' id='callout-input-needs-type'> 
        <p>Здесь вы можете совершить покупку, заполнив форму, наши специалисты купят выбранный вами товар.</p> 
        <p>Чтобы совершить покупку нажмите кнопку "Купите мне" !</p> 
    </div>
        <?php if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['admin']) || Yii::$app->user->identity->money > 0) 
        echo Html::a('Купите мне', ['create'], ['class' => 'btn btn-success']); 
        else echo "
            <div class='bs-callout bs-callout-danger' id='callout-input-needs-type'> 
                <p>Вы не сможете совершить заказ при нулевом балансе !</p> 
            </div>
            <a href='/delivery/balance' class='btn btn-danger'>Купите мне</a>"; ?>
    </p>

<?php if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['admin'])) { ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'count',
            'weight',
            'prize',
            [
                'attribute'=>'createdBy',
                'value'=>'user.username'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

<?php } else { ?>


            <div class="row products">

                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => 'deliveryProduct.php',
                    'summary' => '',
                    'viewParams' => [
                        'fullView' => true,
                        'context' => 'main-page',
                        'edit' => true,
                    ],
                    'emptyText' => '',
                ]); 

                ?>
            </div>

<?php } ?>
</div>
