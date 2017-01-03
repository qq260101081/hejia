<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */

$this->title = Yii::t('app', 'Create Staff');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Staff List'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="mien-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categoryPath' => $categoryPath,
        'position' => $position
    ]) ?>

</div>
