<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\menus\models\MenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Family');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-info">
	<div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<p>
		<?php if(Yii::$app->user->can('service/family/create')) echo Html::a(Yii::t('app', 'Create Family'), ['create'], ['class' => 'btn btn-success btn-xs']); ?>
	</p>
	<?php Pjax::begin(); ?>
		<?= GridView::widget([
	        'dataProvider' => $dataProvider,
	        'filterModel' => $searchModel,
	        'columns' => [
	            'id',
	            'title',
				//[
				//	'attribute' => 'category_id',
				//	'label' => '分类',
				//	'value' => 'categoryName.name',
				//	'filter' => Html::activeDropDownList($searchModel, 'category_id',ArrayHelper::map($category,'id','name'),['prompt'=>'全部'] )
				//],
	            'created_at:date',

	            [
	            	'class' => 'yii\grid\ActionColumn',
					'header' => '操作',
					'template' => '{view} {update} {delete}',
					'buttons' => [
						'view' => function ($url, $model) {
							return  Yii::$app->user->can('service/family/view') ?
								Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url):
								'';
						},
						'update' => function ($url, $model) {
							return  Yii::$app->user->can('service/family/update') ?
								Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url):
								'';
						},
						'delete' => function ($url, $model) {
							return  Yii::$app->user->can('service/family/delete') ?
								Html::a('<span class="glyphicon glyphicon-trash"></span>', $url):
								'';
						},
					],
				],
	        ],
	    ]); ?>
	<?php Pjax::end(); ?>
	</div>
</div>

