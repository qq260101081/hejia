<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RepositorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '资料库管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repository-index box box-info">
    <div class="box-header">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a(Yii::t('app', '创建资料'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
        </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type',
            'title',
            'path',
            'created_at:date',

            ['class' => 'yii\grid\ActionColumn','header'=>'操作'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
