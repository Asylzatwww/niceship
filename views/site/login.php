<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Войти';
?>
<div class="site-login">

<div class="row"> 
    <div class="inner col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4"> 
        <h1>Добро пожаловать</h1> 
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'row'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-12 control-label'],
            ],
        ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"col-lg-12\">{input} {label}</div>\n<div class=\"col-lg-12\">{error}</div>",
            ]) ?>

            <a href="/site/contact" class="help-block text-center">Забыли пароль?</a>

            <div class="form-group">
                <div class="col-lg-12">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

        <?php ActiveForm::end(); ?>
        
        <hr />
        <p>Еще нет аккаунта? <a href="/site/signup">Зарегистрируйтесь</a> И получите ваш Московский адрес для покупок</p>
    </div>
</div>


</div>
