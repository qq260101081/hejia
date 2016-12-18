<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Repository */

$this->title = Yii::t('app', 'Created Repository');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Repository'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repository-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
