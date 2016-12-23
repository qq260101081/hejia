<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\users\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '用户管理');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-info">
    <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
        </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'nickname',
            'city',
            'province',
            'phone',
            'type',
            // 'auth_key',
            // 'password_hash',
             //'status',
             'created_at:date',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn','header' => '操作'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
