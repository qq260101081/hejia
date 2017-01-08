<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */

$this->title = Yii::t('app', 'Update Weekly'). ':' . $model->student_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Weekly List'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->student_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mien-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>