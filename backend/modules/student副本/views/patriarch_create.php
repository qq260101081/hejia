<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */

$this->title = Yii::t('app', 'Create Patriarch');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patriarch List'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="mien-create">

    <?= $this->render('patriarch_form', [
        'model' => $model,
    ]) ?>

</div>
