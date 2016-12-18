<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = Yii::t('app', 'Created Repository');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Repository Push Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <?= $this->render('repository-form', [
        'model' => $model,
    ]) ?>

</div>
