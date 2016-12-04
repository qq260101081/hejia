<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Babysitter */

$this->title = '更新保姆: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '保姆管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="babysitter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
