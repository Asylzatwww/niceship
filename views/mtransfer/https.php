<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Mtransfer */

$this->title = 'Create Mtransfer';
//$this->params['breadcrumbs'][] = ['label' => 'Mtransfers', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

echo \Yii::$app->view->renderFile('@app/views/delivery/menu.php');
?>
<div class="mtransfer-create">

    <h1><?= Html::encode($this->title) ?></h1>


<div class="mtransfer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'label')->textInput() ?>

    <?= $form->field($model, 'datetime')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'https' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
    	<div class="form-group">
	    	<label class="control-label" for="mtransfer-amount">Amount</label>
	        <input class="form-control" name="amount" type="text" value="34" />
    	</div>
    	<div class="form-group">
	        <label class="control-label" for="mtransfer-amount">label</label>
	        <input class="form-control" name="label" type="text" value="6" />
    	</div>
    	<div class="form-group">
	        <label class="control-label" for="mtransfer-amount">datetime</label>
	        <input class="form-control" name="datetime" type="text" value="2007-12-12" />
    	</div>
    	<div class="form-group">
	        <input class="btn btn-primary" type="submit" value="Create" />
	    </div>
    </form>

</div>


</div>
