<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = Yii::t('app', 'Created Weekly');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Weekly Push'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
