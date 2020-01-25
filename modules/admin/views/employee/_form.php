<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Position::find()->all(), 'id', 'name'), [
        'prompt' => 'Выберите должность'
    ]) ?>

    <?= $form ?>

    <?= $form->field($model, 'cabinet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>
	
	<?= $form->field($model, 'monday')->textInput() ?>
	<?= $form->field($model, 'tuesday')->textInput() ?>
	<?= $form->field($model, 'wednesday')->textInput() ?>
	<?= $form->field($model, 'thursday')->textInput() ?>
	<?= $form->field($model, 'friday')->textInput() ?>
	<?= $form->field($model, 'saturday')->textInput() ?>
	<?= $form->field($model, 'sunday')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
