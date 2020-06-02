<?php

/* @var $categories \yii\web\View */


use yii\helpers\Html;

foreach ($categories as $category): ?>
    <li> <?= Html::encode($category->title) ?></li>

<?php endforeach; ?>