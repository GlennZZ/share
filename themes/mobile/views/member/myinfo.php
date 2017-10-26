<script>
var sysParam = {
//      wxId: '<?php echo $userinfo['openid'];?>',//*用户微信的openid
      baseUrl:'<?php echo $this->assets(); ?>/',//*插件的基本资源路径
      isAttention :'<?php echo $isSubscribe;?>',//*用户是否已关注
      getUserAjaxUrl:'<?php echo $this->createUrl('insert');?>',
      signInAjaxUrl:'',//签到
      isUserInfo:'<?php echo $this->userinfo['iscompleteinfo'];?>',//是否已经填写信息 0否 1是
  };
</script>
</head>
<body >

<header class="searchDiv">
    <span>信息登记</span>
    <div class="black fl" onclick="history.back()">返回</div>
</header>

<section class="myInfoDiv dis_none mt_98">
    <div class="title">
        个人信息<div class="redFont modifyBtn">修改</div>
    </div>
    <div class="info">
        <dl>
            <dt>姓名：</dt>
            <dd id="userNameText"><?php echo $this->userinfo['username'];?></dd>
        </dl>
        <dl>
            <dt>手机：</dt>
            <dd id="userPhoneText"><?php echo $this->userinfo['phone'];?></dd>
        </dl>
        <dl>
            <dt>地址：</dt>
            <dd id="otherInfoText"><?php echo $this->userinfo['addr'];?></dd>
        </dl>
    </div>
</section>

<section class="form mt_98">
    <h3 class="redFont">为了您能顺利收到礼品务必填写真实有效的信息！</h3>
    <dl>
        <dt><i class="redFont">*</i>姓名</dt>
        <dd><input type="text" id="userName" value="<?php echo $this->userinfo['username'];?>"></dd>
    </dl>
    <dl>
        <dt><i class="redFont">*</i>电话</dt>
        <dd><input type="text" id="userPhone" value="<?php echo $this->userinfo['phone'];?>"></dd>
    </dl>
    <dl>
        <dt><i class="redFont">*</i>地址</dt>
        <dd><input type="text" id="otherInfo" value="<?php echo $this->userinfo['addr'];?>"></dd>
    </dl>
    <div class="sendBtn redBtn">提交</div>
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
<script src="<?php echo $this->assets(); ?>/js/myinfo.js"></script>

