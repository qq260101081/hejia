<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\menus\models\Menus */

$this->title = Yii::t('app', 'Create Auxiliary');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auxiliary'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menus-create">

    <?= $this->render('auxiliary-form', [
        'model' => $model,
    ]) ?>

</div>
