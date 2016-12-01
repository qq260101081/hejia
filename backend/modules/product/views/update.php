<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Product */

$this->title = Yii::t('app', '修改产品');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '产品管理'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', '修改产品');
?>
<div class="product-update">

    <?= $this->render('_form', [
        'model' => $model,
        'categoryPath' => $categoryPath,
    ]) ?>

</div>
