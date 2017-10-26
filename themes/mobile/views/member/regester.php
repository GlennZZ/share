<section class="registerSection bgColor ">
    <div class="title">
        <a href="<?php echo $this->createUrl('/default');?>"><i class="ic-back"></i></a>
        <span>注册</span>
    </div>
	<form id="regester">
	<?php 
	if(!empty($user->phone)){
	?>
	<br><br>
	<h2 style="text-align:center; font-size: 20px">您已经注册！</h2>
		<br><br>
	<?php
	}else{
	?>
	
    <div class="mainRegister bgwhite">
        <div class="telDiv inputCss">
            <span>+86</span>
            <input placeholder="手机号" name="phone" class="telInput">
            <span id="verifyCodeVBtn">获取验证码</span>
            <span id="verifyCodeVBtn2" class="dis_none">获取验证码</span>
        </div>
        <div class="verifyDiv inputCss">
            <span>验证码</span>
            <input placeholder="请输入验证码" name='code' class="verifyInput">
        </div>
        <!-- 
  <div class="addressDiv inputCss">
            <span>地区</span>
            <select class="select">
                <option>省</option>
            </select>
            <select class="select">
                <option>市</option>
            </select>
            <select class="select">
                <option>区</option>
            </select>
        </div>
         -->
    </div>
	<input name="code_check" type="hidden" value="">
    <p class="registerBtn">立即注册</p>
	<?php	
	}
	?>
	</form>
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
