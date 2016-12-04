<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title = '创建家教';
$this->params['breadcrumbs'][] = ['label' => '家教管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
