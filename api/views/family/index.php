<?php
    use yii\helpers\Url;
    $this->title = '家庭服务';
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/21 下午6:18
 */
?>

<div class="banner"><img src="/images/banner1.png"/></div>
<div class="cont-block" style="padding-top: 10px;">
<article data-am-widget="paragraph"
         class="am-paragraph am-paragraph-default"

         data-am-paragraph="{ tableScrollable: true, pureview: true }">
    <div class="tongy" style="text-align:center; font-size:18px;">和家服务，专注细节，无忧体验，客户满意多一度！</div>
    <p><strong>1.5H服务理念 </strong></p>
    <p>研究英国、香港，菲律宾和日本等国的家庭服务模式，根据中国家庭服务特色，引入先进的服务管理理念， 高质量的服务产品体系，和家服务专注服务的高品质、专业的服务体系和精细的服务标准，以客户满意度为导向，提供5H服务理念，服务让家庭更安心！</p>
    <p><strong>2.N重客户保障</strong></p>
    <p>互联网管理平台，保障客户权益及时有效维护。</p>
    <p>高额责任保险，保障双方财产、人身权益不受损失。
        专业服务员工，保障服务体验更满意。
        统一服务标准，保障服务质量不打折。
        高清录像管理，保障服务过程全透明。
        满意度调查，保障家庭体验幸福指数。
        还有专业团队、质量监督体系，N重保障，一切从客户利益出发，360度服务全覆盖，多1度专心，多1度放心。</p>
    <p><strong>3.员工制管理</strong></p>
    <p>和家服务，采用员工制模式，从业人员为公司员工，统一培训标准，考核合格上岗服务，公司同专业院校合作，职业化服务通道，为客户提供更专业的服务水准。</p>
    <p><strong>培训流程</strong>
        1.专业性测试   2.  岗前培训   3. 技能考试    4. 试用期培训
        5.上岗期测试   6.  定期轮训   7. 管理培训    8.进阶培培训</p>
    <p>和家服务所有员工必须经过专业技能和服务礼仪培训才可以正式上岗提供服务，员工服务注意标准化操作模式，强调专业知识和客户满意度体验，我们的唯一目标是你的满意才是我们服务的最高标准。</p>
    <p><strong>4．私人定制</strong></p>
    <p>和家服务强调个性化服务，客户的任何服务要求将生成私人定制菜单，专属个性化服务需求将由网络平台管理，和家服务后台各个功能模块运作满足私人定制服务。
        私人定制享有特殊优先权、特许开放资源查阅权和专属私人客户经理跟踪服务，一站式服务平台全心为您提供贴心服务。</p>
    <p><strong>5.免费体验</strong></p>
    <p>和家服务提供免费服务体验，客户成功注册为和家服务会员将享受一次免费家庭服务体验，家庭助理将给你的品质生活增添色彩。我们追求对服务品质有要求的客户，你的需求是我们进步的动力。</p>

</article>
    </div>
<ul class="nav">

    <?php foreach ($model as $v):?>
    <li>
        <a href="<?= Url::to(['family/view', 'id' => $v->id]); ?>">
            <span><?= $v->title; ?></span>
            <i class="am-icon-angle-right"></i>
        </a>
    </li>
    <?php endforeach;?>
</ul>
<div style="height: 49px;"></div>
