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

<div class="product">
    <div class="tongy mt10 mb10"><img src="frontend/web/images/tese_03.png" class="photo" alt="和家" /></div>
    <div class="tedian">
        <ul>
            <li>
                <div class="tanchuang">
                    <div class="tongy mb10">研究英国、香港，菲律宾和日本等国的家庭服务模式，根据中国家庭服务特色，引入先进的服务管理理念， 高质量的服务产品体系，和家服务专注服务的高品质、专业的服务体系和精细的服务标准，以客户满意度为导向，提供5H服务理念，服务让家庭更安心！</div>
                    <a href="#" class="ts-bt">查看详情</a>
                </div>
                <img src="frontend/web/images/tese_07.png" alt="和家" />
                <p class="title-ts">5H服务理念<p>
                <p class="text-ts">研究英国、香港，菲律宾和日本等国的家庭服务模式，根据...</p>
            </li>
            <li>
                <div class="tanchuang">
                    <div class="tongy mb10">互联网管理平台，保障客户权益及时有效维护。
                        高额责任保险，保障双方财产、人身权益不受损失。
                        专业服务员工，保障服务体验更满意。
                        统一服务标准，保障服务质量不打折。
                        高清录像管理，保障服务过程全透明。
                        满意度调查，保障家庭体验幸福指数。</div>
                    <a href="#" class="ts-bt">查看详情</a>
                </div>
                <img src="frontend/web/images/tese_09.png" alt="和家" />
                <p class="title-ts">N重客户保障<p>
                <p class="text-ts">互联网管理平台，保障客户权益及时有效维护。高额责任保...</p>
            </li>
            <li>
                <div class="tanchuang">
                    <div class="tongy mb10">和家服务，采用员工制模式，从业人员为公司员工，统一培训标准，考核合格上岗服务，公司同专业院校合作，职业化服务通道，为客户提供更专业的服务水准。和家服务所有员工必须经过专业技能和服务礼仪培训才可以正式上岗提供服务，员工服务注意标准化操作...</div>
                    <a href="#" class="ts-bt">查看详情</a>
                </div>
                <img src="frontend/web/images/tese_11.png" alt="和家" />
                <p class="title-ts">员工制管理<p>
                <p class="text-ts">和家服务，采用员工制模式，从业人员为公司员工，统一...</p>
            </li>
            <li>
                <div class="tanchuang">
                    <div class="tongy mb10">和家服务强调个性化服务，客户的任何服务要求将生成私人定制菜单，专属个性化服务需求将由网络平台管理，和家服务后台各个功能模块运作满足私人定制服务。私人定制享有特殊优先权、特许开放资源查阅权和专属私人客户经理跟踪服务，一站式服务平台全心...</div>
                    <a href="#" class="ts-bt">查看详情</a>
                </div>
                <img src="frontend/web/images/tese_13.png" alt="和家" />
                <p class="title-ts">私人定制<p>
                <p class="text-ts">和家服务，采用员工制模式，从业人员为公司员工，统一...</p>
            </li>
            <li>
                <div class="tanchuang">
                    <div class="tongy mb10">和家服务提供免费服务体验，客户成功注册为和家服务会员将享受一次免费家庭服务体验，家庭助理将给你的品质生活增添色彩。我们追求对服务品质有要求的客户，你的需求是我们进步的动力。</div>
                    <a href="#" class="ts-bt">查看详情</a>
                </div>
                <img src="frontend/web/images/tese_15.png" alt="和家" />
                <p class="title-ts">免费体验<p>
                <p class="text-ts">和家服务，采用员工制模式，从业人员为公司员工，统一...</p>
            </li>
        </ul>
    </div>

</div>
<div class="wrap">
    <ul class="box_m clearfix">
        <?php if($news):;?>
        <li class="zxhd">
            <div class="box_h">
                最新活动<span>News</span>
            </div>
            <div class="box_body">
                <img src="upload/<?=$news->list_img;?>"/>
                <h3><a href="<?= Url::to(['events/view', 'id'=>$news->id]);?>"><?= $news->title;?></a></h3>
                <p><?= $news->info;?>....</p>
            </div>
        </li>
        <?php endif;?>
        <?php if($interesting):;?>
        <li class="xyfc">
            <div class="box_h">
                活动花絮<span>Style</span>
            </div>
            <div class="box_body">
                <a href="<?= Url::to(['events/view', 'id'=>$interesting->id]);?>"><img src="upload/<?=$interesting->list_img;?>"></a>
            </div>
        </li>
        <?php endif;?>
        <?php if($mien):;?>
        <li class="mstd">
            <div class="box_h">
                团队风采<span>Teacher</span>
            </div>
            <div class="box_body">
                <a href="<?= Url::to(['auxiliary/view', 'id'=>$news->id]);?>"><img src="upload/<?=$news->list_img;?>"/></a>
            </div>
        </li>
        <?php endif;?>
    </ul>
</div>
<div class="space_hx">&nbsp;</div>

<?php $this->beginBlock('js');?>
    $('.flexslider').flexslider();

<?php $this->endBlock();?>
<?php $this->registerJs($this->blocks['js'],\yii\web\View::POS_LOAD);//将编写的js代码注册到页面底部 ?>
