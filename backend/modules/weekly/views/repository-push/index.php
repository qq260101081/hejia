<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Repository Push Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index box box-info">

    <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?php if(Yii::$app->user->can('weekly/repository-push/create')) echo Html::a(Yii::t('app', 'Created Repository'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
    </p>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute'=>'id',
                'headerOptions'=> ['width'=> '60'],
            ],
            [
                'attribute'=>'username',
                'headerOptions'=> ['width'=> '80'],
            ],
            [
                'label' => '推送家长',
                'value' => function($model){
                    if(isset($model['patriarch']->name))
                        return $model['patriarch']->name;
                    else
                        return '';
                },
                'headerOptions'=> ['width'=> '80'],
            ],
            'title',
            [
                'attribute'=>'created_at',
                'format' => 'date',
                'headerOptions'=> ['width'=> '80'],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>

