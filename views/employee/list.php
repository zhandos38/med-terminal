<?php
use yii\helpers\Url;
use app\models\Employee;

/** @var \app\models\Employee $models */
/** @var \app\models\Employee $model */
/** @var \yii\web\View $view */

$this->title = 'Список сотрудников';
?>

<div class="buttons-group">
    <div class="go-home-button__wrapper">
        <a href="<?= Url::to(['employee/index'])?>" class="go-home-button__link">
            <div class="go-home-button">
                <i class="fas fa-home"></i> <?= Yii::t('site', 'На главную страницу') ?>
            </div>
        </a>
    </div>
</div>
<div class="employee-list">
    <?php foreach ($models as $model): ?>
        <div class="employee-list__item-wrapper">
            <a href="<?= Url::to(['employee/view', 'id' => $model->id]) ?>" class="employee-list__item-link">
                <div class="employee-list__item"><?= $model->full_name ?></div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
