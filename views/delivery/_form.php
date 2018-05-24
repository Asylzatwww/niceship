<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Delivery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="delivery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prize')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_url')->textInput(['maxlength' => true]) ?>

    <?php if (isset($_POST['image'])) echo $form->field($model, 'image')->hiddenInput([ 'value' => $_POST['image'] ])->label(false)  ?>


    <?php if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['admin'])) { ?>

        <?php if ($model->image != null) echo "<img src='/upload/" . $image->imageRoot . $model->image . ".jpg' />"; ?>

        <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>


        <?= $form->field($image, 'imageFile')->fileInput() ?>

        <?= $form->field($model, 'status')->textInput(['maxlength' => true]); ?>

        <?= $form->field($model, 'createdBy')->dropDownList(
            ArrayHelper::map(User::find()->all(), 'id', 'username'),
            ['prompt' => 'Select catalog']
        ) ?>

    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
