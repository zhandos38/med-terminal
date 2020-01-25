<?php
use yii\grid\GridView;
use kartik\daterange\DateRangePicker;
use yii\base\Model;
?>
<style>
	#mlkeyboard {
        position: fixed;
        bottom: 0;
    }
</style>
<div class="site-index">
    <div class="container">
        <div class="buttons-group">
            <div class="go-home-button__wrapper">
                <a href="/" class="go-home-button__link">
                    <div class="go-home-button">
                        <i class="fas fa-home"></i> <?= Yii::t('site', 'На главную страницу') ?>
                    </div>
                </a>
            </div>
        </div>
        <div>
            <?= $this->render('_search', [
                'searchModel' => $searchModel,
            ]) ?>
        </div>

        <?php if ($searchModel->attributes['full_name'] || $searchModel->attributes['department_id']): ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
                'showOnEmpty' => false,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'full_name',
                    [
                        'attribute' => 'status',
                        'value' => function($model) {
                            switch ($model->status) {
                                case 0:
                                    $status =  Yii::t('site', 'Госпитализирован');
                                    break;
                                case 1:
                                    $status = Yii::t('site', 'Отказ от госпитализации');
                                    break;
                                case 2:
                                    $status = Yii::t('site', 'Переведен');
                                    break;
                            }
                            return $status;
                        },
                        'filter' => array(0 => Yii::t('site', 'Госпитализирован'), 1 => Yii::t('site', 'Отказ от госпитализации'), Yii::t('site', 'Переведен')),
                    ],
                    [
                        'attribute' => 'type',
                        'value' => function($model) {
                            switch ($model->type) {
                                case 0:
                                    $type = Yii::t('site', 'Плановый');
                                    break;
                                case 1:
                                    $type = Yii::t('site', 'Экстренный');
                                    break;
                                case 2:
                                    $type = Yii::t('site', 'Неотложеный');
                                    break;
                            }
                            return $type;
                        },
                        'filter' => array(0 => Yii::t('site', 'Плановый'), 1 => Yii::t('site', 'Экстренный'), 2 => Yii::t('site', 'Неотложеный')),
                    ],
                    [
                        'attribute' => 'department_id',
                        'value' => function($model) {
                            return $model->department ? $model->department->name : 'Не указано';
                        }
                    ],
                    'room',
                    [
                        'attribute' => 'created_at',
                        'value' => function($model) {
                            return date('d.m.y H:i', $model->created_at);
                        },
                        'filter' => DateRangePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'createTimeRange',
                            'pluginOptions' => [
                                'locale' => [
                                    'format'=>'DD.MM.YYYY HH:mm'
                                ],
                                'opens'=>'left'
                            ]
                        ])
                    ]
                ],
            ]); ?>

        <?php endif; ?>

        <div>
            <?php foreach($departments as $department): ?>
                <button class="accordion"><?= $department->name ?></button>
                <div class="panel">
                    <div>
                        <ul>
                            <?php foreach($department->admissions as $admission): ?>
                                <li>
                                    <?= $admission->full_name . ', ' ?> <?= Yii::t('site', 'Палата') . ': ' ?><?= $admission->room ? $admission->room : 'Нет данных' ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</div>
<?php
$js =<<<JS
$(document).ready(function(){
  $('#admissionsearch-full_name').mlKeyboard({
    layout: 'ru_RU'
  });
});

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
JS;

$this->registerJs($js);

?>