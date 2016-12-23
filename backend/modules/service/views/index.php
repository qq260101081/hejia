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
		<?= Html::a(Yii::t('app', 'Create Family'), ['create'], ['class' => 'btn btn-success btn-xs']); ?>
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

	            ['class' => 'yii\grid\ActionColumn','header' => '操作'],
	        ],
	    ]); ?>
	<?php Pjax::end(); ?>
	</div>
</div>

