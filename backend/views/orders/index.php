<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index box box-info">

    <div class="box-header">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <?= Html::a(Yii::t('app', '创建订单'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
        </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'userid',
            'username',
            'product_id',
            'product_name',
            // 'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>