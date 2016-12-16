<?php
	use yii\helpers\Url;
	$this->title = $category->name;
?>
            <div class="banner"><img src="/api/web/images/banner1.png"/></div>
            <ul class="nav">
				<?php foreach ($model as $v):?>
            	<li>
            		<a href="<?= Url::to(['product/list','pid' => $v->id])?>">
            			<!---<img src="images/1.png" />--->
            			<span><?= $v->name;?></span>
            			<i class="am-icon-angle-right"></i>
            		</a>
            	</li>
            	<?php endforeach;?>
            </ul>
            <div style="height: 49px;"></div>
