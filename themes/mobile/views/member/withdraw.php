<section class="withdrawSection ">
    <div class="title">
        <i class="ic-back"></i>
        <span>提现</span>
       <span class="scoreDetail"> <a href="<?php echo $this->createUrl('/member/withdrawRecord');?>">提现明细</a></span>
    </div>
    <div class="mainDrawDiv">
        <div class="inputDiv">
            <input type="number" class='num'>
            <span class='moneyLabel'>元</span>
        </div>
        <p class="tipP">
            
            <span>当前积分:&nbsp;<font style="color: #FE6634;"><?php echo $user->integral?></font>&nbsp;&nbsp;&nbsp;可提现:&nbsp;<font style="color: #FE6634;"><?php echo $user->integral*$setting['rule_integral']?></font>元</span>
        </p>
        <div class="drawRules">
            <p>满<?php echo $setting['custom_ntegral']?>(首次<?php echo $setting['frist_integral']?>)积分才可提现</p>
            <p>每100积分相当于<?php echo $setting['rule_integral']*100?>元</p>
            <p>请先关注“1杯”公众号，提现的金</p>
            <p>额将以红包的形式发送给您</p>
            <p>单个红包金额介于1元-200元之间</p>
            <p>同一个用户一分钟最多允许提现一次</p>

        </div>
    </div>
    <p class="ensureBtn">确认提现</p>

 <img id="progressImgage" data-id='1' class="progressloading" style="display:none" alt="" src="<?php echo $this->assets(); ?>/images/ajax-loader.gif"/>
<div id="maskOfProgressImage" class="maskloading" style="display:none"></div>
</section>
<section class='codeSection dis_none'>
    <img src="<?php echo $this->assets(); ?>/images/code.png">
</section>
<p class='textTip'></p>
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


