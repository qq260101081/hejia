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

<?php Pjax::begin(['id'=>'images-pjax']); ?>    <?= GridView::widget([
        'id' => 'images-grid-view',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'model' => $model,
        'columns' => [
            'id',
            'type',
            'name',
            'title',
            'path',
            'created_at:date',
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
