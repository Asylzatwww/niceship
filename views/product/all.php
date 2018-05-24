<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\ListView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Популярные товары';
//$this->params['breadcrumbs'][] = $this->title;
echo \Yii::$app->view->renderFile('@app/views/delivery/menu.php');
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_all.php',
                    'summary' => '',
                    'viewParams' => [
                        'fullView' => true,
                        'context' => 'main-page',
                    ],
                ]); 

                ?>

</div>
