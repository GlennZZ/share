<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta equiv="Expires" content="0">
    <title><?php echo CHtml::encode($this->pageTitle); ?> - <?php echo $this->webconfig['seo_title'];?></title>
    <script type="text/javascript">
    	var phoneWidth=parseInt(window.screen.width),phoneScale=phoneWidth/640,ua=navigator.userAgent;if(/Android (\d+\.\d+)/.test(ua)){var version=parseFloat(RegExp.$1);if(version>2.3){document.write('<meta name="viewport" content="width=640, minimum-scale = '+phoneScale+', maximum-scale = '+phoneScale+', target-densitydpi=device-dpi">')}else{document.write('<meta name="viewport" content="width=640, target-densitydpi=device-dpi">')}}else{document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">')}
        var sysParam = {
            wxId: '<?php echo $userinfo['openid'];?>',//*用户微信的openid
            baseUrl:'<?php echo $this->assets(); ?>/',//*插件的基本资源路径
            isAttention :'<?php echo $isSubscribe;?>',//*用户是否已关注
            isAttention:0,//是否有关注  1关注  0没有
            ajax_submitScore:'',//提交积分
            postSort:'<?php echo $this->createUrl('/default/getList');?>',//首页分类请求
            detailView:'<?php echo $this->createUrl('/default/view/id/').'/'; ?>',
            ajax_submitCollect:'<?php echo $this->createUrl('/default/add_collect');?>',//添加收藏
            ajax_searchStore:'<?php echo $this->createUrl('/default/search');?>',//搜索门店
            ajax_search2:'<?php echo $this->createUrl('/default/search2');?>',//商家搜索
            ajax_myshareUrl:'<?php echo $this->createUrl('/member/myshare');?>',//我的分享
            ajax_myshareDetailUrl:'<?php echo $this->createUrl('/member/myshareDetail/id/').'/'; ?>',//我的分享详情
            ajax_myshareRecodList:'<?php echo $this->createUrl('/member/myshareRecodList').'/'; ?>',//我的分享积分记录
            ajax_myfavorUrl:'<?php echo $this->createUrl('/member/myfavor');?>',//我的收藏
            isRegister:0,//是否注册
            isSharePage:<?php echo $this->fromwx?1:0	?>,//0自己页面,1分享页面
            index:'<?php echo $this->createUrl('/default/index');?>'//首页链接
        };
    </script>
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script>wx.config({debug:<?php if($this->userinfo['openid']=='ofIPfjq7_Te6wwb2xA-KgEyMixwo'){echo'true';}else{if(empty($this->jssdk_debug)){echo'false';}else{echo"true";}}?>,appId:'<?php echo $this->signPackage["appId"];?>',timestamp:<?php echo $this->signPackage["timestamp"];?>,nonceStr:'<?php echo $this->signPackage["nonceStr"];?>',signature:'<?php echo $this->signPackage["signature"];?>',jsApiList:['checkJsApi','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','hideMenuItems','showMenuItems','hideAllNonBaseMenuItem','showAllNonBaseMenuItem','translateVoice','startRecord','stopRecord','onRecordEnd','playVoice','pauseVoice','stopVoice','uploadVoice','downloadVoice','chooseImage','previewImage','uploadImage','downloadImage','getNetworkType','openLocation','getLocation','hideOptionMenu','showOptionMenu','closeWindow','scanQRCode','chooseWXPay','openProductSpecificView','addCard','chooseCard','openCard']});</script>
	<script src="<?php echo $this->assets(); ?>/js/wxshare.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assets(); ?>/css/loading.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assets(); ?>/css/animation.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assets(); ?>/css/popup.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assets(); ?>/css/index.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assets(); ?>/css/font/css/ico.css">
	<script src="<?php echo $this->assets(); ?>/js/zepto.min.js"></script>
	<script src="<?php echo $this->assets(); ?>/js/index.js"></script>
	</head>
<body >
<!--内容开始 -->
	<?php echo $content; ?>
<!--内容结束-->
<?php echo $this->webconfig['site_statistics'];?>
<!--音乐控制-->

<script type="text/javascript">
	window.onload = function(){
		$("#loading").addClass("hide");
		setTimeout(function(){
			$("#loading").detach();
		},500)
	}
</script>
</body>
</html>
