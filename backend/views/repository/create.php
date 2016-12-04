<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Repository */

$this->title = '创建资料';
$this->params['breadcrumbs'][] = ['label' => '资料库管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repository-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
