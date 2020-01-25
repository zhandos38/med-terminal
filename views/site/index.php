<?php

/* @var $this yii\web\View */

$this->title = 'Главная старница';
?>
<div class="main-menu">
    <div class="main-menu__item-wrapper">
        <a href="<?= \yii\helpers\Url::to(['employee/index']) ?>" class="main-menu__item-link">
            <div class="main-menu__item">
                <?= Yii::t('site', 'Посмотреть график работы и оценить врача') ?>
            </div>
        </a>
    </div>
</div>
