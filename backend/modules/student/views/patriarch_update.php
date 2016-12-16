<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */

$this->title = Yii::t('app', 'Update Patriarch'). ':' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patriarch List'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mien-update">

    <?= $this->render('patriarch_form', [
        'model' => $model,
    ]) ?>

</div>