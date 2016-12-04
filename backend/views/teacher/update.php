<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title = '更新家教: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '家教管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="teacher-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
