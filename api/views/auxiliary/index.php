<?php
    use yii\helpers\Url;
    $this->title = '托辅中心';
/**`
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/23 上午11:28
 */
?>

<?php if(isset($model[0])):;?>
<div class="cont">
    <div class="am-list-news-hd am-cf">
        <!--带更多链接-->
        <a href="###" class="">
            <h2 style=" margin-left:15px;"><?= $model[0][0]->title;?></h2>
        </a>
    </div>
    <div class="cont-block" style="margin-bottom:15px;">
        <article data-am-widget="paragraph"
                 class="am-paragraph am-paragraph-default"
                 data-am-paragraph="{ tableScrollable: true, pureview: true }">
            <?= $model[0][0]->content;?>
        </article>
    </div>
</div>
<?php endif;?>

<?php if(isset($model[1])):;?>
<div class="cont">
    <div class="am-list-news-hd am-cf">
        <!--带更多链接-->
        <a href="#" class="">
            <h2 style=" margin-left:15px;">校区团队</h2>
        </a>
    </div>
    <div class="cont-block02" style="padding-top:15px; margin-bottom:15px;">
        <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2
                      am-avg-md-3 am-avg-lg-4 am-gallery-default" data-am-gallery="{ pureview: true }" >
            <?php foreach ($model[1] as $k => $v):;?>

            <li>
                <div class="am-gallery-item">
                    <a href="http://img.hejiafuwu.com/<?= $v->list_img;?>" class="">
                        <img src="http://img.hejiafuwu.com/<?= $v->list_img;?>" />
                        <h3 class="am-gallery-title" style="text-align:center;"><?= $v->title; ?></h3>
                    </a>
                </div>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>
<?php endif;?>

<?php if(isset($model[2])):;?>
<div class="cont">
    <div class="am-list-news-hd am-cf">
        <!--带更多链接-->
        <a href="#" class="">
            <h2 style=" margin-left:15px;">课程活动</h2>
        </a>
    </div>
    <div class="cont-block02" style=" padding-top:0px; padding-bottom:0[x; margin-bottom:55px;">
        <div data-am-widget="list_news" class="am-list-news am-list-news-default" >
            <!--列表标题-->
            <div class="am-list-news-bd">
                <ul class="am-list">
                    <?php foreach ($model[2] as $v):;?>

                    <li class="am-g am-list-item-desced" style="border-bottom:1px solid #e3e3e3;">
                        <a href="<?= Url::to(['auxiliary/view', 'id'=>$v->id]);?>" class="am-list-item-hd "><?= $v->title; ?></a>
                        <div class="am-list-item-text"><?= $v->info; ?></div>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>

        </div>
    </div>
</div>
<?php endif;?>
<div style="height:60px; clear:both; width:100%; float:left;"></div>
