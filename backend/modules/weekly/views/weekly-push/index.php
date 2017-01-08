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
        <?php if(Yii::$app->user->can('msg/weekly-push-logs/create')) echo Html::button(Yii::t('app', 'Created Weekly'),
            ['class' => 'btn btn-success btn-xs','data-toggle'=>'modal',
                'data-target'=>'#weekly-modal']
        ) ?>

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


<?php
echo Html::beginForm(['/msg/weekly-push-logs/create'], 'post');
Modal::begin([
'id' => 'weekly-modal',
'size' => 'modal-lg',
'header' => '<h4 class="modal-title">选取周报推送</h4>',
'footer' => '<a href="#" class="btn btn-primary pull-left" data-dismiss="modal">关闭</a>
<button type="submit" class="btn btn-warning">推送</button>',
]);
Html::endForm();


$getStudentUrl = Url::to(['modal-list']);//弹窗的html内容，下面的js会调用获得该页面的Html内容，直接填充在弹框中
$js = <<<JS
    $.get('{$getStudentUrl}', {},
function (data) {
$('#weekly-modal .modal-body').html(data);
}
);
JS;
$this->registerJs($js);
Modal::end();

?>

