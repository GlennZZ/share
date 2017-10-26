<section class="scoreRules bgColor ">
    <div class="title">
        <i class="ic-back"></i>
        <span>积分提现规则</span>
    </div>
    <div class="rulesDiv">
        <div>
            <h1>【积分任务】</h1>
            <p>
                1.首次分享活动，即可获得相应的积分<br>
                2.邀请好友参与您推广的活动，可相应增加您的积分
            </p>
        </div>

        <div>
            <h1>【积分兑换】</h1>
            <p>1.每100积分可获得<?php echo $setting['rule_integral'] * 100 ?>元现金红包，提现成功后积分自动抵扣
                <br>
                <br>
                2.红包金额将从“1杯”公众号领取，请提前关注“1杯”公众号
                <br>
                <br>
                3.一次仅能提现1～200元的现金
            </p>
        </div>
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


