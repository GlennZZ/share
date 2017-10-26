<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>游戏推广平台-后台登录</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Favicons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $this->assets(); ?>/images/icons/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->assets(); ?>/images/icons/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $this->assets(); ?>/images/icons/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo $this->assets(); ?>/images/icons/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="<?php echo $this->assets(); ?>/images/icons/favicon.png">
<script language="JavaScript">
		<!--
			if(top!=self)
			if(self!=top) top.location=self.location;
		//-->
		</script>
<!--[if lt IE 9]>
          <script src="<?php echo $this->assets(); ?>/js/minified/core/html5shiv.min.js"></script>
          <script src="<?php echo $this->assets(); ?>/js/minified/core/respond.min.js"></script>
        <![endif]-->
<!-- Fides Admin CSS Core -->
<link rel="stylesheet" type="text/css" href="<?php echo $this->assets(); ?>/css/minified/aui-production.min.css">
<!-- Theme UI -->
<link id="layout-theme" rel="stylesheet" type="text/css" href="<?php echo $this->assets(); ?>/themes/minified/fides/color-schemes/dark-blue.min.css">
<!-- Fides Admin Responsive -->
<link rel="stylesheet" type="text/css" href="<?php echo $this->assets(); ?>/themes/minified/fides/common.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->assets(); ?>/themes/minified/fides/responsive.min.css">
<!-- Fides Admin JS -->
<script type="text/javascript">var WEB_URL='<?php echo WEB_URL;?>',statics='<?php echo WEB_URL.'/static';?>';</script>
<script type="text/javascript" src="<?php echo $this->assets(); ?>/js/minified/aui-production.min.js"></script>
<style type="text/css">
.animate {
	/*-webkit-animation: bounceIn 600ms linear;
	-moz-animation: bounceIn 600ms linear;
	-o-animation: bounceIn 600ms linear;
	animation: bounceIn 600ms linear;
	box-shadow: 0 5px 6px rgba(0, 0, 0, .35);*/
	animation: cat_ti_move 1s;
	-moz-animation: cat_ti_move 1s;
	-webkit-animation: cat_ti_move 1s;
	-o-animation: cat_ti_move 1s;
}



@keyframes cat_ti_move
{
from {left: 800px;
-webkit-transform: rotateZ(360deg);
-moz-transform: rotateZ(360deg);
-o-transform: rotateZ(360deg);
-ms-transform: rotateZ(360deg);
transform: rotateZ(360deg);}
to {left: 0px;
transform: rotate(0deg);
-webkit-transform: rotateZ(0deg);
-moz-transform: rotateZ(0deg);
-o-transform: rotateZ(0deg);
-ms-transform: rotateZ(0deg);
transform: rotateZ(0deg);}
}

@-moz-keyframes cat_ti_move /* Firefox */
{
from {left: 800px;
-webkit-transform: rotateZ(360deg);
-moz-transform: rotateZ(360deg);
-o-transform: rotateZ(360deg);
-ms-transform: rotateZ(360deg);
transform: rotateZ(360deg);
}
to {left: 0px;
-webkit-transform: rotateZ(0deg);
-moz-transform: rotateZ(0deg);
-o-transform: rotateZ(0deg);
-ms-transform: rotateZ(0deg);
transform: rotateZ(0deg);}
}

@-webkit-keyframes cat_ti_move
{
/*from { opacity: 0; -webkit-transform: translateX(-100%) rotateY(-90deg); }*/
/*from { opacity: .3; -webkit-transform: translateX(200%) scale(.4) rotateY(65deg); }*/
/*from { opacity: .3; -webkit-transform: translateY(-200%) scale(.4) rotateX(65deg); }*/
from {left: 600px;
-webkit-transform: rotateZ(360deg);
-moz-transform: rotateZ(360deg);
-o-transform: rotateZ(360deg);
-ms-transform: rotateZ(360deg);
transform: rotateZ(360deg);}
to {left: 0px;
transform: rotate(0deg);
-webkit-transform: rotateZ(0deg);
-moz-transform: rotateZ(0deg);
-o-transform: rotateZ(0deg);
-ms-transform: rotateZ(0deg);
transform: rotateZ(0deg);}
}

@-o-keyframes cat_ti_move
{
from {left: 800px;
-webkit-transform: rotateZ(360deg);
-moz-transform: rotateZ(360deg);
-o-transform: rotateZ(360deg);
-ms-transform: rotateZ(360deg);
transform: rotateZ(360deg);}
to {left: 0px;
-webkit-transform: rotateZ(0deg);
-moz-transform: rotateZ(0deg);
-o-transform: rotateZ(0deg);
-ms-transform: rotateZ(0deg);
transform: rotateZ(0deg);}
}
</style>
</head>
<body style="overflow: hidden;  background: url(http://pingtai.com/static/images/110.jpg) center top no-repeat;background: #32415a url(http://whd.i-lz.cn/css/patternbg.png);background-color: #396582;">
	<div id="loading" class="ui-front loader ui-widget-overlay bg-white opacity-100" style="">
		<img src="<?php echo $this->assets(); ?>/images/loader-dark.gif" alt="">
	</div>
	<div class="pad20A ">
		<div class="row">
			<div class="clear"></div>

                <?php
																
				$form=$this->beginWidget('CActiveForm', array(
					'id'=>'login-validation', 
					'htmlOptions'=>array(
						'class'=>' center-margin form-vertical ', 
						'style'=>'top: 20%;bottom: 25%;position: fixed;right: 20%;left: 20%;width: 320px;height: 380px; '
					), 
					'enableAjaxValidation'=>false
				));
				?>

	<div id="login-form" class="content-box animate ">
				<h3 class="content-box-header ui-state-default" style="background-color: #3588D6; height: 80px; color: #fff; line-height: 80px;height: 153px;background: url(<?php echo $this->assets(); ?>/images/baner.png) no-repeat;"></h3>
				<div class="content-box-wrapper pad20A pad0B">
					<div class="form-row " style="text-align: center; display: none" id="noty_top">
						<span class="noty_text font-orange">
							<i class="glyph-icon icon-exclamation-sign mrg5R"></i>
							用户名或者密码错误!
						</span>
					</div>
					<div class="form-row">
						<div class="form-label col-md-2">
							<label for="login_email" style="float: left;">
								用户名:
								<span class="required">*</span>
							</label>
						</div>
						<div class="form-input col-md-10">
							<div class="form-input-icon">
								<i class="glyph-icon icon-envelope-alt ui-state-default" style="top: 25px;"></i>
                                        <?php echo $form->textField($model,'username',array('placeholder'=>'请输入用户名','data-trigger'=>"change", 'data-required'=>"true",'id'=>"login_username")); ?>
										<?php echo $form->error($model,'username'); ?>
                                    </div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-label col-md-2">
							<label for="login_pass" style="float: left;">密码:<span class="required">*</span></label>
						</div>
						<div class="form-input col-md-10">
							<div class="form-input-icon">
								<i class="glyph-icon icon-unlock-alt ui-state-default" style="top: 25px;"></i>
                                        <?php echo $form->passwordField($model,'password',array('required'=>'true', 'placeholder'=>'请输入密码','data-trigger'=>"keyup", 'data-rangelength'=>"[3,25]",'id'=>"login_pass")); ?>
										<?php echo $form->error($model,'password'); ?>
                                    </div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-checkbox-radio col-md-6">
							<div class="checker" id="uniform-remember-password">
								<span class="ui-state-default btn radius-all-4">
                                    <?php echo $form->checkBox($model,'rememberMe',array('class'=>"custom-checkbox",'id'=>"remember-password")); ?>
                                    <i class="glyph-icon icon-ok"></i>
								</span>
							</div>
							<label for="remember-password" class="pad5L tooltip-button" data-placement=right data-original-title="请注意账号安全性,不要在公共电脑上勾选此项！">记住账号密码</label>
						</div>
						<!-- 
						<div class="form-checkbox-radio text-right col-md-6">
							<a href="javascript:;" class="toggle-switch" switch-target="#login-forgot" switch-parent="#login-form" title="忘记了你的密码?">忘记了你的密码?</a>
						</div>
						 -->
					</div>
				</div>
				<div class="button-pane text-center">
					<button onclick="javascript:loadshow();" type="submit" style="width: 80%; text-align: center; background-image: -webkit-gradient(linear, 50.00% 0.00%, 50.00% 100.00%, color-stop(0%, rgba(255, 139, 20, 1.00)), color-stop(100%, rgba(247, 125, 0, 1.00))); background-image: -webkit-linear-gradient(270deg, rgba(255, 139, 20, 1.00) 0%, rgba(247, 125, 0, 1.00) 100%); background-image: linear-gradient(180deg, rgba(255, 139, 20, 1.00) 0%, rgba(247, 125, 0, 1.00) 100%); color: #FFF; padding: 8px 12px; font-size: 20px; box-shadow: 0 2px 2px rgba(0, 0, 0, .2); margin-top: 10px;" class="btn large primary-bg text-transform-upr font-size-11 ">
						<span class="button-content" style="width: 80%; text-align: center;">登录</span>
					</button>
				</div>
			</div>
			<?php $this->endWidget(); ?>
			<form action="" class="col-md-2 center-margin form-vertical">
				<div class="ui-dialog mrg5T no-shadow hide" id="login-forgot" style="position: relative !important;">
					<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
						<span class="ui-dialog-title">找回密码</span>
					</div>
					<div class="pad20A ui-dialog-content ui-widget-content">
						<div class="form-row">
							<div class="form-label col-md-2">
								<label for="" style="float: left;">电子邮件地址:</label>
							</div>
							<div class="form-input col-md-10">
								<div class="form-input-icon">
									<i class="glyph-icon icon-envelope-alt ui-state-default" style="top: 25px;"></i>
									<input placeholder="Email address" type="text" name="" id="">
								</div>
							</div>
						</div>
					</div>
					<div class="ui-dialog-buttonpane text-center">
						<button type="submit" class="btn large primary-bg" id="demo-form-valid" onclick="javascript:$('#demo-form').parsley( 'validate' );" title="Validate!">
							<span class="button-content">恢复密码</span>
						</button>
						<a href="javascript:;" switch-target="#login-form" switch-parent="#login-forgot" class="btn large transparent no-shadow toggle-switch font-bold font-size-11 radius-all-4" id="login-form-valid" onclick="javascript:$('#login-validation').parsley( 'validate' );" title="Validate!">
							<span class="button-content">取消</span>
						</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	
<?php
if ($error==1){
	echo "<script>$('#noty_top').show();$('body').click(function(){ $('#noty_top').slideUp();}); </script>";
}
?>
<script>
function loadshow() {
	if( $('#login-validation').parsley( 'validate' )){
	    d = '<div id="refresh-overlay" class="ui-front hide loader ui-widget-overlay bg-white opacity-80"><label style="left: 50%;top: 50%;   margin:37px 0 0 -17px; position: absolute;">正在登录....</label><img src="<?php echo WEB_URL.'/static'; ?>/images/loader-dark.gif" alt="" /></div>';
	    $("#refresh-overlay").remove(),
	    $(".form-vertical").append(d),
	    $("#refresh-overlay").css({'position': 'absolute'}).fadeIn("fast"),
	    window.setTimeout(function() {
	        $("#refresh-overlay").fadeOut("fast")
	    },
	    55000);
	    return;
	}else{
		return false;
	}
   
}
</script>
	<div id="page-footer-wrapper" class="login-footer">
		<div id="page-footer">版权©2015 -联众互动</div>
	</div>
	<!-- #page-footer-wrapper -->
</body>
</html>