<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */

$this->title = Yii::t('app', 'Create Events');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="mien-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
