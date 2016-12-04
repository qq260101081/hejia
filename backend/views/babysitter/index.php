<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BabysitterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '保姆管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="babysitter-index box box-info">

    <div class="box-header">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a(Yii::t('app', '创建保姆'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
        </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'age',
            'working_age',
            'headimg',
            // 'phone',
            'created_at:date',

            ['class' => 'yii\grid\ActionColumn','header'=>'操作'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
