<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MtransferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Все транзакций';
//$this->params['breadcrumbs'][] = $this->title;

echo \Yii::$app->view->renderFile('@app/views/delivery/menu.php');


/*
echo Yii::$app->params['adminVerify'];echo '<br>';
echo 'd7d357b8cd80944419c5c41740b2388dc586b7d9'. '<br>';
echo sha1('1f33cd82-0009-5000-8000-00001279c043');

$test = '0'; //Тестирование системы: 0 - выключено, 1 - включено
//p2p-incoming,2.99,2016-08-03T09:31:47Z,false,3.00,410014415916371,d7d357b8cd80944419c5c41740b2388dc586b7d9,false,1f33cd82-0009-5000-8000-00001279c043,1047063814976006017,643,6
$notification_secret = Yii::$app->params['adminVerify']; //СЮДА ВСТАВИТЬ Секретный код выданый ВАМ ЯД


$notification_type = 'p2p-incoming'; 
$operation_id = '1047063814976006017';
$amount = '2.99';
$currency = '643';
$datetime = '2016-08-03T09:31:47Z';
$sender = '410014415916371';
$codepro = 'false';
$label = '6';
$sha1_hash = 'd7d357b8cd80944419c5c41740b2388dc586b7d9';

$hash = $notification_type . '&' . $operation_id . '&' . $amount . '&' . $currency . '&' . $datetime . '&' . $sender . '&' . $codepro . '&' . $notification_secret . '&' . $label; //формируем хеш

$sha1 = hash("sha1", $hash); //кодируем в SHA1

//Ниже - проверка на валидность
if ( $sha1 == $sha1_hash ) {
echo 'OK';
} else {
echo 'error';
}

// Ниже - отладка - запись в файл testlog.txt переданых данных с ЯД.
if ($test=='1') {
$test_wr = fopen ('testlog.txt', 'a+');
fwrite ($test_wr, "$notification_type - тип нотификации\r\n$operation_id - ид операции\r\n$amount - сумма\r\n$currency -Код валюты\r\n$datetime - дата+время\r\n$sender -отправитель\r\n$codepro - наличие кода протекции\r\n$label - метка платежа\r\n$sha1_hash - переданый проверочный хеш\r\n$sha1 - расчитаный хэш\r\n$test_notification - тестовая нотификация\r\n");
fclose ($test_wr);
} 

*/
?>
<div class="mtransfer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <div class='bs-callout bs-callout-info' id='callout-input-needs-type'> 
        <p>Здесь вы можете просмотреть все ваши покупки и пополнения вашего баланса !</p> 
    </div>
    </p>


            <div class="row products">

                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_alltransfer.php',
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


</div>
