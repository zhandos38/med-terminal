<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Admission */

$this->title = 'Update Admission: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Admissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admission-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
