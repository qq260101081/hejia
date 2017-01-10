<?php
    $this->title = '消息中心';
    use yii\helpers\Url;
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/24 下午1:13
 */
?>
<style>
.am-list{ margin-bottom:0;}
</style>
<div class="cont-block02" style="margin-top:0; padding-bottom:0;">
    <div data-am-widget="list_news" class="am-list-news am-list-news-default">
        <!--列表标题-->
        <div class="am-list-news-hd am-cf">
            <!--带更多链接-->
            <a href="##" class="">
                <h2>消息动态</h2>
            </a>
        </div>
        <div class="am-list-news-bd">
            <ul class="am-list">
                <?php foreach ($msg as $v):;?>
                <li class="am-g am-list-item-dated">
                    <a href="<?= Url::to(['msg/msg-view','id'=>$v->id])?>" class="am-list-item-hd "><?= $v->title;?></a>
                    <span class="am-list-date"><?= date('Y-m-d',$v->created_at);?></span>
                </li>
                <?php endforeach;?>
                <?php foreach ($weekly as $v):;?>
                    <li class="am-g am-list-item-dated">
                        <a href="<?= Url::to(['msg/weekly-view','id'=>$v->id])?>" class="am-list-item-hd ">
                            学生周报【<?=date('Y-m-d', $v->stime);?> - <?=date('Y-m-d', $v->etime);?>】
                        </a>
                        <span class="am-list-date"><?= date('Y-m-d',$v->created_at);?></span>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>
<?php if($repository):;?>
<div class="cont-block02">
    <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2 am-gallery-imgbordered" data-am-gallery="{pureview: 1}">
        <?php foreach ($repository as $v):;?>
            <?php if($v->type == 'image'):;?>
                <li>
                    <div class="am-gallery-item">
                        <img src="http://img.liusheji.com/<?=$v->path;?>"
                             alt="<?=$v->title;?>" data-rel="http://img.liusheji.com/<?=$v->path;?>"/>
                    </div>
                </li>
            <?php endif;?>
       <?php endforeach;?>

        <?php foreach ($repository as $v):;?>
        <?php if($v->type == 'video'):;?>
        <li>
            <embed src="http://img.liusheji.com/<?=$v->path;?>" width=" " height=" ">
                <div class="am-gallery-item">

                    <script language="javascript">
                        //定义视频对象
                        var video = new tvp.VideoInfo();
                        //向视频对象传入视频vid
                        video.setVid("c0146k6imdf");
                        //定义播放器对象
                        var player = new tvp.Player(320, 240);
                        //设置播放器初始化时加载的视频
                        player.setCurVideo(video);
                        //设置精简皮肤，仅点播有效
                        //player.addParam("flashskin", "http://imgcache.qq.com/minivideo_v1/vd/res/skins/TencentPlayerMiniSkin.swf");
                        //输出播放器,参数就是上面div的id，希望输出到哪个HTML元素里，就写哪个元素的id
                        player.addParam("autoplay","1");
                        player.addParam("wmode","transparent");
                        //player.addParam("pic","http://img1.gtimg.com/ent/pics/hv1/75/182/1238/80547435.jpg");
                        player.write("mod_player_skin");
                    </script>
                </div>
            </embed>
        </li>
            <?php endif;?>
        <?php endforeach;?>
    </ul>
</div>
<?php endif;?>
<div class="ch"></div>
<div style="height: 49px;"></div>
<?php
    $jsUrl = "http://qzs.qq.com/tencentvideo_v1/js/tvp/tvp.player.js";
    $this->registerJsFile($jsUrl,['depends'=>'api\assets\AppAsset','position'=>$this::POS_END]);
?>

