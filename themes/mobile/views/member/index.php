<section class="myCenterSection ">
    <div class="selfInfoDiv">
        <img src="<?php echo $this->assets(); ?>/images/back.png" class="mycenterBack">
        <div class="imgDiv">
            <img src="<?php echo $this->userinfo['headimgurl']?>" class="headImg">
        </div>
        <p><?php echo $this->userinfo['nickname']?></p>
        <div class="numDiv">
            <div class="left">
                <i class="ic-score"></i>
                <span><?php echo $model->integral?></span>
            </div>
            <div class="center">
               <a href="<?php echo $this->createUrl('withdraw'); ?>"> <p>提现</p></a>
            </div>
            <div class="right">
                <i class="ic-money"></i>
                <span><?php echo $money/100;?></span>
            </div>
        </div>
    </div>
    <div class="mainDiv">
        <div class="div1 bgwhite bor">
           <a href="<?php echo $this->createUrl('myshare'); ?>">
               <div class="shareDiv fontSize border1">
                    <i class="ic-share"></i>
                    <span>我的分享</span>
                </div>
           </a>
            <a href="<?php echo $this->createUrl('withdrawRecord'); ?>">
                <div class="recordDiv fontSize">
                    <i class="ic-bag"></i>
                    <span>提现记录</span>
                </div>
            </a>
        </div>

        <div class="div2 bgwhite bor">
            <a href="<?php echo $this->createUrl('myfavor'); ?>">
                <div class="favorDiv fontSize">
                    <i class="ic-app"></i>
                    <span>收藏活动</span>
                </div>
            </a>
        </div>
        <div class="div3 bgwhite bor">
            <a href="<?php echo $this->createUrl('scoreRules'); ?>">
                <div class="mycenterRulesDiv fontSize border1">
                    <i class="ic-rules"></i>
                    <span>积分提现规则</span>
                </div>
            </a>
            <a href="<?php echo $this->createUrl('about'); ?>">
                <div class="aboutDiv fontSize">
                    <i class="ic-attention"></i>
                    <span>关于联联圈</span>
                </div>
            </a>
        </div>
        <a href="/"><p >去赚钱吧</p></a>
    </div>
</section>
<script type="text/javascript">
WX_STAT.init({
  	hideToolbar:true,
	hideOptionMenu:false,
	title:'<?php echo $this->webconfig['index_shareTitle'];?>',
	desc: '<?php echo $this->webconfig['index_shareDesc'];?>',
	img:"<?php echo $this->webconfig['index_shareIcon'];?>",
	link:"<?php echo Yii::app()->request->hostInfo;?>"
  } );
</script>


