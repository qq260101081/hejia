<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\menus\models\Menus */

$this->title = Yii::t('app', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auxiliary'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="menus-update">

    <?= $this->render('auxiliary-form', [
        'model' => $model,
        'categoryPath' => $categoryPath,
    ]) ?>

</div>
