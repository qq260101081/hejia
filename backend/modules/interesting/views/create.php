<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */

$this->title = Yii::t('app', 'Create Interesting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Interesting'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="interesting-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
