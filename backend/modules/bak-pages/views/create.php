<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\menus\models\Menus */

$this->title = Yii::t('app', '创建页面');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '页面管理'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menus-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
