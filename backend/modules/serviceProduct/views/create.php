<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Product */

$this->title = Yii::t('app', 'Create ServiceProducts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ServiceProducts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
