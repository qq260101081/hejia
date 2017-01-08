<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */

$this->title = Yii::t('app', 'Create Weekly');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Weekly List'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="mien-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
