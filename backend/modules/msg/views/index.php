<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Msg Push Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index box box-info">

    <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Created Msg'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
    </p>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'patriarch_id',
            'username',
            'title',
            //'status',
            'created_at:date',
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
