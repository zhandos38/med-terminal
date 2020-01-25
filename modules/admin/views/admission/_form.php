<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Admission;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Admission */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-4">
        <div class="admission-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'full_name')->textInput(['maxlength' => true, 'placeholder' => 'Введите имя и фамилию']) ?>

            <?= $form->field($model, 'iin')->textInput(['maxlength' => true, 'placeholder' => 'Введите ИИН']) ?>

            <?= $form->field($model, 'status')->dropDownList(
                Admission::getStatuses(),
                [
                    'prompt' => 'Укажите статус'
                ]
            ) ?>

            <?= $form->field($model, 'type')->dropDownList(
                Admission::getTypes(),
                [
                    'prompt' => 'Укажите тип'
                ]
            ) ?>

            <?= $form->field($model, 'department_id')->dropDownList(
                    ArrayHelper::map(\app\models\Department::find()->all(), 'id', 'name'), [
                    'prompt' => 'Выберите отделение'
            ]) ?>

            <?= $form->field($model, 'room')->textInput() ?>

            <?= $form->field($model, 'is_discharged')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
