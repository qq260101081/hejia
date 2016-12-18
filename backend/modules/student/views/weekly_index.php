
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\presscentre\models\PresscentreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Weekly List');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-info">
    <div class="box-header">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <?= Html::a(Yii::t('app', 'Create Weekly'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
        </p>
        <?php Pjax::begin(); ?>    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                'student_name',
                'discipline',
                'sleep',
                'diet',
                'study',
                'synthesize',
                'created_at:date',
                ['class' => 'yii\grid\ActionColumn', 'header' => '操作'],
            ],
        ]); ?>
        <?php Pjax::end(); ?></div>
</div>