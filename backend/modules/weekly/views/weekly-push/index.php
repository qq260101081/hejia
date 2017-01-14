<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Weekly Push Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index box box-info">

    <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?php if(Yii::$app->user->can('weekly/weekly-push/create')) echo Html::a(Yii::t('app', 'Created Weekly'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
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
            // 'synthesize',
            'username',
            // 'status',
            'created_at:date',
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>

