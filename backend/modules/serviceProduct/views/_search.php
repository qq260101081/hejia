<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'pic') ?>

    <?= $form->field($model, 'guarantee_time') ?>

    <?php // echo $form->field($model, 'labor_time') ?>

    <?php // echo $form->field($model, 'supply') ?>

    <?php // echo $form->field($model, 'video1') ?>

    <?php // echo $form->field($model, 'video2') ?>

    <?php // echo $form->field($model, 'video3') ?>

    <?php // echo $form->field($model, 'video4') ?>

    <?php // echo $form->field($model, 'content') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
