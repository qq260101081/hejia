<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */

$this->title = Yii::t('app', 'Update Events'). ':' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mien-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>