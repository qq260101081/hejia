<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\menus\models\Menus */

$this->title = Yii::t('app', 'Update', [
    'modelClass' => 'Menus',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'And Home Service'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="menus-update">

    <?= $this->render('_form', [
        'model' => $model,
        'categoryPath' => $categoryPath,
    ]) ?>

</div>
