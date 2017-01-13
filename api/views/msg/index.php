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
                    <a href="<?= Url::to(['msg/msg-view','id'=>$v->id])?>" class="am-list-item-hd ">【官方消息】<?= $v->title;?></a>
                    <span class="am-list-date"><?= date('Y-m-d',$v->created_at);?></span>
                </li>
                <?php endforeach;?>

                <?php foreach ($repository as $v):;?>
                    <li class="am-g am-list-item-dated">
                        <a href="<?= Url::to(['msg/repository-view','id'=>$v->id])?>" class="am-list-item-hd ">【学生影像】</a>
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

<div class="ch"></div>
<div style="height: 49px;"></div>


