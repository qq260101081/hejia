<?php

use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\menus\models\MenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '页面管理');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-info">
	<div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<p>
		<?= Html::a(Yii::t('app', 'Create Pages'), ['create'], ['class' => 'btn btn-success btn-xs']); ?>
	</p>
	<?php Pjax::begin(); ?>    <?= GridView::widget([
	        'dataProvider' => $dataProvider,
	        'filterModel' => $searchModel,
	        'columns' => [
	            ['class' => 'yii\grid\SerialColumn'],
	
	            'id',
	            'title',
	            'code_id',
	            'created_at:datetime',
	            'updated_at:datetime',

	            ['class' => 'yii\grid\ActionColumn','header' => '操作'],
	        ],
	    ]); ?>
	<?php Pjax::end(); ?>
	</div>
</div>

