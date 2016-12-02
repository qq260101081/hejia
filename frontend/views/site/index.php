<?php
    use yii\helpers\Url;
    $this->registerJsFile('@web/frontend/web/js/jquery.flexslider-min.js',['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerCssFile('@web/frontend/web/css/zzsc.css');
?>
<!--幻灯片-->
    <div class="flexslider">
        <ul class="slides">
            <?php foreach ($ad as $v):?>
            <li><a href="<?= $v->url;?>" target="_blank"><img src='upload/<?= $v->path;?>'></a></li>
            <?php endforeach;?>
        </ul>
    </div>
<!--幻灯片-->


<div class="space_hx">&nbsp;</div>
<div class="product">
    <div class="product_left">
        <div class="title_jz">
            <div class="box_hl">
                家庭服务<span>husbandry</span>
            </div>
            <a href="<?= Url::to(['product/index','category_id'=>'4']);?>" class="more_cp">更多>></a>
        </div>
        <?php foreach ($server as $v):?>
        <div class="product_block">
            <div class="fl">
                <a href="<?= Url::to(['product/view','id'=>$v->id,'category_id'=>'4',$v->category_id]);?>">
                    <img src="upload/<?= $v->list_img;?>">
                </a></div>
            <span class="product_title"><?=$v->name;?></span>
        </div>
        <?php endforeach;?>

    </div>
    <div class="product_right">
        <div class="title_jz">
            <div class="box_hl">
                托辅中心<span>creche</span>
            </div>
            <a href="<?= Url::to(['product/index','category_id'=>'106']);?>" class="more_cp">更多>></a>
        </div>
        <?php foreach ($hosting as $v):?>
        <div class="product_block">
            <div class="fl"><a href="<?= Url::to(['product/view','id'=>$v->id,'category_id'=>'106',$v->category_id]);?>"><img src="upload/<?= $v->list_img;?>"></a></div>
            <span class="product_title"><?=$v->name;?></span>
        </div>
        <?php endforeach;?>

    </div>
</div>
<div class="wrap">
    <ul class="box_m clearfix">
        <li class="zxhd">
            <div class="box_hl">
                最新活动<span>News</span>
            </div>
            <a class="more_cp" href="<?= Url::to(['news/index','category_id'=>$new->category_id])?>">更多>></a>
            <div class="box_body">
                <img src="upload/<?= $new->list_img;?>"/>
                <h3><a href="<?= Url::to(['news/view','id'=>$new->id, 'category_id'=>$new->category_id])?>"><?= $new->title;?></a></h3>
                <p><?= mb_substr(strip_tags($new->content),0,50,'utf-8');?>....</p>
            </div>
        </li>
        <li class="xyfc">
            <div class="box_hl">
                活动花絮<span>Style</span>
            </div>
            <a class="more_cp" href="<?= Url::to(['interesting/index'])?>">更多>></a>
            <div class="box_body">
                <a href="<?= Url::to(['interesting','id'=>$interesting->id])?>"><img src="upload/<?= $interesting->list_img;?>"></a>
            </div>
        </li>
        <li class="mstd">
            <div class="box_hl">
                团队风采<span>Teacher</span>
            </div>
            <a class="more_cp" href="">更多>></a>
            <div class="box_body">
                <a href="<?= Url::to(['mien','id'=>$mien->id])?>"><img src="upload/<?= $mien->list_img;?>"/></a>
            </div>
        </li>
    </ul>
</div>
<div class="space_hx">&nbsp;</div>

<?php $this->beginBlock('js');?>
    $('.flexslider').flexslider();

<?php $this->endBlock();?>
<?php $this->registerJs($this->blocks['js'],\yii\web\View::POS_LOAD);//将编写的js代码注册到页面底部 ?>
