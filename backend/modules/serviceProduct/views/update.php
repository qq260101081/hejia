<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Product */

$this->title = Yii::t('app', 'Update ServiceProducts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ServiceProducts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
