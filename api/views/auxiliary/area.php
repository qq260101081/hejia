<?php
    use yii\helpers\Url;
    $this->title = '托辅中心';
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/21 下午5:47
 */
?>

<div class="cont">
    <div class="am-list-news-hd am-cf">
        <!--带更多链接-->
        <a href="###" class="">
            <h2 style="margin-left:15px;">请选择校区</h2>
        </a>
    </div>

    <?php foreach ($model[4]['son'][137]['son'] as $v):;?>
        <div class="cont-block">
        <span class="cont-title"><?= $v['name'] ;?></span>
        <ul>
            <?php foreach ($v['son'] as $vv):;?>
            <li>
                <div class="am-gallery-item">
                    <a href="<?= Url::to(['/api.php/auxiliary/index','pid'=>$vv['id']]);?>" class="">
                        <p><?= $vv['name'] ;?></p>
                    </a>
                </div>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
    <?php endforeach;?>

</div>
<div style="height: 49px;"></div>

