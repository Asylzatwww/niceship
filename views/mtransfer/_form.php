<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Mtransfer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mtransfer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'datetime')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'notification_type')->textInput(['maxlength' => true]) ?>
    <?php //= $form->field($model, 'operation_id')->textInput(['maxlength' => true]) ?>
    <?php //= $form->field($model, 'withdraw_amount')->textInput(['maxlength' => true]) ?>
    <?php //= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>
    <?php //= $form->field($model, 'sender')->textInput(['maxlength' => true]) ?>
    <?php //= $form->field($model, 'codepro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'label')->dropDownList(
        ArrayHelper::map(User::find()->all(), 'id', 'username'),
        ['prompt' => 'Select catalog']
    ) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
