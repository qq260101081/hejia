<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\users\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="box box-info">
    <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(['id'=>'patriarch-pjax']); ?>    <?= GridView::widget([
        'id' => 'patriarch-grid-view',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'model' => $model,
        'columns' => [
            'id',
            'name',
            'relation',
            'phone',
            'urgency_person',
            'urgency_phone',
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function($model){
                    return ['value' => $model->id];
                }
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
