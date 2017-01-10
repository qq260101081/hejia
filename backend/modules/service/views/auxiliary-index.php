<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\menus\models\MenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Auxiliary');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-info">
	<div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<p>
		<?php if(Yii::$app->user->can('service/auxiliary/create')) echo  Html::a(Yii::t('app', 'Create Auxiliary'), ['create'], ['class' => 'btn btn-success btn-xs']); ?>
	</p>
	<?php Pjax::begin(); ?>
		<?= GridView::widget([
	        'dataProvider' => $dataProvider,
	        'filterModel' => $searchModel,
	        'columns' => [
	            'id',
				[
					'attribute' => 'category_id',
					'value' => function($model){
						return $model['categoryName']->name;
					}
				],
				[
					'attribute' => 'type',
					'value' => function($model){
						$type = ['特色','团队','课程'];
						return $type[$model->type];
					},
					'filter' => Html::activeDropDownList($searchModel, 'type',[
						'特色','团队','课程'
					],['prompt'=>'全部','class' => 'form-control'] )
				],
				'title',
				'info',
	            'created_at:date',

	            [
	            	'class' => 'yii\grid\ActionColumn',
					'header' => '操作',
					'template' => '{view} {update} {delete}',
					'buttons' => [
						'view' => function ($url, $model) {
							return  Yii::$app->user->can('service/auxiliary/view') ?
								Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url):
								'';
						},
						'update' => function ($url, $model) {
							return  Yii::$app->user->can('service/auxiliary/update') ?
								Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url):
								'';
						},
						'delete' => function ($url, $model) {
							return  Yii::$app->user->can('service/auxiliary/delete') ?
								Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
									'data' => [
										'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
										'method' => 'post',
									],
								]):
								'';
						},
					],
				],
	        ],
	    ]); ?>
	<?php Pjax::end(); ?>
	</div>
</div>

