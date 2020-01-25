<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Department;
use app\models\Admission;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdmissionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поступление';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admission-index">

    <p>
        <?= Html::a('Создать запись', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'full_name',
            'iin',
            [
                'attribute' => 'status',
                'value' => function(Admission $model) {
                    return $model->getStatusLabel();
                },
                'filter' => Admission::getStatuses()
            ],
            [
                'attribute' => 'type',
                'value' => function(Admission $model) {
                    return $model->getTypeLabel();
                },
                'filter' => Admission::getTypes()
            ],
            [
                'attribute' => 'department_id',
                'value' => function(Admission $model) {
                    return $model->department ? $model->department->name : 'Не верно указан';
                },
                'filter' => ArrayHelper::map(Department::find()->asArray()->all(), 'id', 'name')
            ],
            //'room',
            //'is_discharged',
            //'updated_at',
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
