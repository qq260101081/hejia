<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Babysitter */

$this->title = '创建保姆';
$this->params['breadcrumbs'][] = ['label' => '保姆管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="babysitter-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
