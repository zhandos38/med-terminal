<?php
use yii\helpers\Url;
use app\models\Employee;

/** @var \app\models\Employee $models */
/** @var \app\models\Employee $model */
/** @var \yii\web\View $view */

$this->title = 'Сотрудники';
?>

<div class="buttons-group">
    <div class="go-home-button__wrapper">
        <a href="/" class="go-home-button__link">
            <div class="go-home-button">
                <i class="fas fa-home"></i> <?= Yii::t('site', 'На главную страницу') ?>
            </div>
        </a>
    </div>
</div>
<div class="employee-index">
    <div class="employee-index__item-wrapper">
        <a href="<?= Url::to(['employee/list', 'id' => Employee::TYPE_DOCTOR]) ?>" class="employee-index__item-link">
            <div class="employee-index__item"><?= Yii::t('site', 'Врачи') ?></div>
        </a>
    </div>
    <div class="employee-index__item-wrapper">
        <a href="<?= Url::to(['employee/list', 'id' => Employee::TYPE_SISTER]) ?>" class="employee-index__item-link">
            <div class="employee-index__item"><?= Yii::t('site', 'Мед сестры') ?></div>
        </a>
    </div>
    <div class="employee-index__item-wrapper">
        <a href="<?= Url::to(['employee/list', 'id' => Employee::TYPE_TECHNO]) ?>" class="employee-index__item-link">
            <div class="employee-index__item"><?= Yii::t('site', 'Технички') ?></div>
        </a>
    </div>
</div>
