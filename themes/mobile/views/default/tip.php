<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>联联圈</title>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta equiv="Expires" content="0">
     <meta http-equiv="Refresh" content="<?php echo intval($webconfig['jump_time']);?>; url=<?php echo $url?$url:'http://share.i-lz.cn'?>" />
    <script type="text/javascript">
        var version, phoneWidth = parseInt(window.screen.width), phoneScale = phoneWidth / 640, ua = navigator.userAgent;
        /Android (\d+\.\d+)/.test(ua) ? (version = parseFloat(RegExp.$1), version > 2.3 ? document.write('<meta name="viewport" content="width=640, minimum-scale = ' + phoneScale + ", maximum-scale = " + phoneScale + ', target-densitydpi=device-dpi">') : document.write('<meta name="viewport" content="width=640, target-densitydpi=device-dpi">')) : document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">');
    </script>
     <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script>wx.config({debug:<?php if($this->userinfo['openid']=='ofIPfjq7_Te6wwb2xA-KgEyMixwo'){echo'true';}else{if(empty($this->jssdk_debug)){echo'false';}else{echo"true";}}?>,appId:'<?php echo $this->signPackage["appId"];?>',timestamp:<?php echo $this->signPackage["timestamp"];?>,nonceStr:'<?php echo $this->signPackage["nonceStr"];?>',signature:'<?php echo $this->signPackage["signature"];?>',jsApiList:['checkJsApi','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','hideMenuItems','showMenuItems','hideAllNonBaseMenuItem','showAllNonBaseMenuItem','translateVoice','startRecord','stopRecord','onRecordEnd','playVoice','pauseVoice','stopVoice','uploadVoice','downloadVoice','chooseImage','previewImage','uploadImage','downloadImage','getNetworkType','openLocation','getLocation','hideOptionMenu','showOptionMenu','closeWindow','scanQRCode','chooseWXPay','openProductSpecificView','addCard','chooseCard','openCard']});</script>
	<script src="<?php echo $this->assets(); ?>/js/wxshare.js"></script>
    <style>
        /*reset*/body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,textarea,p,blockquote,th,td {padding:0;margin:0;box-sizing:border-box;-webkit-text-size-adjust:none;-webkit-appearance:none;-webkit-tap-highlight-color:rgba(0,0,0,0);}
        table {border-collapse:collapse;border-spacing:0;}
        fieldset,img {border:0;}
        address,caption,cite,code,dfn,em,strong,th,var {font-weight:normal;font-style:normal;}
        ol,ul {list-style:none;}
        caption,th {text-align:left;}
        a {text-decoration:none;}
        h1,h2,h3,h4,h5,h6 {font-weight:normal;font-size:100%;}
        q:before,q:after {content:'';}
        abbr,acronym {border:0;}
        div {font-family:'Microsoft YaHei';}
        body,html{ width: 100%; height: 100%;}
        header{
            background-color: #fe6634;
            font:28px/48px "Microsoft YaHei";
            padding: 32px 0;
            text-align: center;
            color: #fff;
            background-size:10px 10px;
            background-image: -webkit-gradient(-45deg, transparent, transparent 45%, rgba(0, 0, 0, .1) 45%, rgba(0, 0, 0, .1) 55%, transparent 55%, transparent);
            background-image: linear-gradient(-45deg, transparent, transparent 45%, rgba(0, 0, 0, .1) 45%, rgba(0, 0, 0, .1) 55%, transparent 55%, transparent);
        }
        .info{ font-size:32px; color: #fe6634; text-align: center;}
        .info>div{ position: absolute; left: 0; width: 100%;}
        .info>div:nth-of-type(1){ top:28.7% ; font-weight: bold; animation: slidedown 1s .2s both; -webkit-animation: slidedown 1s .2s both;}
        .info>div:nth-of-type(2){ top:38.1% ;  animation: slidedown 1s .4s both; -webkit-animation: slidedown 1s .4s both;}
        .info>div:nth-of-type(2)>img{ width:190px; height: 190px; margin: 0 auto; display: block; border-radius: 50%; }
        .info>div:nth-of-type(3){ top:59.5% ; color: #000; animation: slidedown 1s .6s both; -webkit-animation: slidedown 1s .6s both; }
        .info>div:nth-of-type(4){ top:68.1%;font-weight: bold; animation: slidedown 1s .8s both; -webkit-animation: slidedown 1s .8s both; }
        .info>div:nth-of-type(5){ top:75.4%; width:480px; border-bottom: 2px #fea385 dashed; left:80px;  animation: slidedown 1s 1s both; -webkit-animation: slidedown 1s 1s both; }
        .info>div:nth-of-type(6){ top:81.5%; font-size: 24px; line-height: 36px;  animation: slidedown 1s 1.2s both; -webkit-animation: slidedown 1s 1.2s both;}

        @keyframes slidedown {
            0%{
                opacity: 0;
                transform: translateY(-50px);
                -webkit-transform: translateY(-50px);
            }
            100%{
                opacity: 1;
                transform: translateY(0px);
                -webkit-transform: translateY(0px);
            }
        }
        @-webkit-keyframes slidedown {
            0%{
                opacity: 0;
                transform: translateY(-50px);
                -webkit-transform: translateY(-50px);
            }
            100%{
                opacity: 1;
                transform: translateY(0px);
                -webkit-transform: translateY(0px);
            }
        }
    </style>
</head>

<body onload="ChangeURL('<?php echo $url?$url:'http://share.i-lz.cn'?>', <?php echo intval($webconfig['jump_time']);?>);">
<header>
    本活动分享于【联联圈】<br>
    请关注【1杯】公众号成为推广<br>
    大使赢取奖品
</header>
<div class="info">
    <div><?php echo $msg4?$msg4:'您的好友'?></div>
    <div><img src="<?php echo $user->headimgurl?>" class="userImg"></div>
    <div><?php echo $user->nickname?></div>
    <div><?php echo $msg2?></div>
    <div></div>
    <div><?php echo $msg?><br>
    <?php echo $msg3?$msg3:'页面将跳转至联联圈'?>
    </div>
</div>
<script type="text/javascript">
function ChangeURL(url,t)
{
	setTimeout(function(){
		location.href=url;
	},t*1000)
  
}
WX_STAT.init({
  	hideToolbar:true,
	hideOptionMenu:false,
	title:'<?php echo $this->webconfig['index_shareTitle'];?>',
	desc: '<?php echo $this->webconfig['index_shareDesc'];?>',
	img:"<?php echo $this->webconfig['index_shareIcon'];?>",
	link:"<?php echo Yii::app()->request->hostInfo.Yii::app()->request->getUrl();?>"
  } );
</script>
</body>
</html>