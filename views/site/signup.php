<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
?>


<div class="site-signup" id="register">

<h1> Доставка из Москвы в Бишкек <span>в партнерстве с <img class="lazy lazydone" src="/images/ui/partner-logos/dhl-express_small.png" alt="DHL"> </span></h1>

<div class="row" id="register-box">
    <div id="register-form-wrapper" class="col-12 col-xs-12 col-sm-8 col-md-8 col-lg-8">
        <h2>Получите ваш адрес в NiceShip!</h2>

        <?php $form = ActiveForm::begin([
            'id' => 'signup-form',
            //'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-12 control-label'],
            ],
        ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'firstname')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'lastname')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'passwordrepeat')->passwordInput() ?>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>


            <div class="form-group">
                <div class="col-lg-11">
                    <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div class="col-12 col-xs-12 col-sm-4 col-md-4 col-lg-4" id="register-meta"> 
        <h2>Как это работает</h2> 
        <ol class="list-unstyled steps"> 
            <li> 
                <img class="lazy lazydone" src="/img/hiw-v2_1a.png" alt="" height="50" width="55"> 
                <strong>1/ ПОКУПКА</strong><br>Московские интернет магазины 
            </li> 
            <li> 
                <img class="lazy lazydone" src="/img/hiw-v2_2a.png" alt="" height="50" width="55"> 
                <b>2/ Доставка</b> <br>на ваш NiceShip адресс 
            </li> 
            <li> 
                <img class="lazy lazydone" src="/img/hiw-v2_3a.png" alt="" height="50" width="55"> 
                <b>3/ ПОЛУЧИТЬ</b> <br>ваша покупка уже у вас в доме 
            </li> 
        </ol> 
        <p> NiceShip обеспечивает доставку из Москвы в Бишкек. Мы даем вам адресс в Москве на который вы сможете совершать покупки. 
        </p> 
    </div>

</div>


</div>
