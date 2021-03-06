<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Repository */

$this->title = '更新资料: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '资料库管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="repository-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
