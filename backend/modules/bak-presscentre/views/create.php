<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */

$this->title = Yii::t('app', 'Create Presscentre');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Presscentre'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="presscentre-create">

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category,
    ]) ?>

</div>
