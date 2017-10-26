<?php

/**
* WapBController.php
* ----------------------------------------------
* 版权所有 2014-2015 联众互动
* ----------------------------------------------
* @date: 2015-5-13
* @author: wintrue <328945440@qq.com>
*/
class WapBController extends Controller{
	public $layout='//layouts/main';
	protected $userinfo; // 当前访问用户的基本资料及access_token
	private $_defaultHeadimg='http://www.playwx.com/hd/images/anymonus.png';
	protected $signPackage;
	private $_cookieUser='_userloc';
	private $_cookieTime=86400; // 24*60*60
	public $jssdk_debug=false;
	public $fromwx;
	public $fromType=0;
	private $authorizeapi='http://openapi.i-lz.cn/interface';
	private $ghidlist=array(
		'wx7390a485f3a9b1d3'=>array(
			'appid'=>'wx54dc8c98d9fbde46',
			'secret'=>'54517096c971fd68a50c4944353251ce'
		)
	);
	function init(){
		parent::init();
		yii::app()->theme='mobile';
		$this->wxRedirect();
		if (yii::app()->session['addon_userinfo_platform']){
			$this->userinfo=yii::app()->session['addon_userinfo_platform'];
		}else{
			$this->wxLogin();
		}
		// 手动清除会话存储
		if (!empty($_GET['r-id'])){
			unset($_GET['r-id']);
			Yii::app()->session['addon_userinfo'.$_GET['_akey']]=null;
			cookie(null);
		}
		$this->signPackage=$this->getSignPackage();
		if (!empty($_GET['_fromwx']))
			$this->fromwx=$_GET['_fromwx'];
		$type=$_GET['from'];
		if (empty($type)){ // 1 公众号
			$this->fromType="1";
		}else
			if ($type=="timeline"){ // 2 朋友圈
				$this->fromType="2";
			}else
				if ($type=="singlemessage"){ // 3 好友
					$this->fromType="3";
				}else{
					$this->fromType="0";
				}
	}
	/**
	 * 微信授权回调
	 * @date: 2015-5-29
	 * @author : wintrue<328945440@qq.com>
	 */
	function wxRedirect(){
		if ($_GET['redirect']==1){
			$state=$_GET['state'];
			$temp=Yii::app()->cache[$state];
			if (empty($temp['key'])||($temp&&Yii::app()->cache[$_GET['state'].'isuse']=='no')){
				// 已使用过state,直接重新授权处理
				if (Yii::app()->cache['wreload_'.$state]){
					header('Location:'.Yii::app()->cache['wreload_'.$state]);
					exit();
				}else{
					$this->error('该链接无效'); // 已使用过的code或者refresh_token
				}
			}
			$ghidinfo=Yii::app()->cache[$state];
			if (!empty($_GET['openid'])){
				unset($_GET['key']);
				unset($_GET['oauthtoken']);
				unset($_GET['redirect']);
				dump($_GET);
				Yii::app()->cache[$_GET['state'].'isuse']='no';
				exit();

			}else{
				if (Yii::app()->cache['wreload_'.$state]){
					header('Location:'.Yii::app()->cache['wreload_'.$state]);
					exit();
				}else{
					$this->error('该链接无效');
				}
			}
		}
	}
	/**
	 * 微信授权开始
	 * @date: 2015-5-29
	 * @author : wintrue<328945440@qq.com>
	 */
	function wxLogin(){
		// 1、精准分众、2、联众互动、100公众号自己
		$scope='&scope=snsapi_userinfo';
		$ghid='wx7390a485f3a9b1d3';
		$reurl=Yii::app()->request->hostInfo.$this->createUrl('/default');
		// Yii::app()->request->hostInfo.Yii::app()->request->getUrl()
		$state=md5(time().mt_rand(1, 1000000));
		$reurl=Yii::app()->request->hostInfo.Yii::app()->request->getUrl();
		if (strpos($reurl, '?')){
			$reurl=$reurl.'&redirect=1';
		}else{
			$reurl=$reurl.'?redirect=1';
		}
		$location=$this->authorizeapi.'?returnUrl='.urlencode($reurl.'&state='.$state.'&key='.time()).'&ghid='.$ghid.$scope;
		Yii::app()->cache['wreload_'.$state]=$location;
		Yii::app()->cache[$state]=array(
			'ghid'=>$ghid,
			'key'=>$this->ghidlist[$ghid],
			'scope'=>$scope,
			'returnUrl'=>urldecode($_GET['returnUrl'])
		);

		header('Location:'.$location);
		exit();
	}
	public function getSignPackage(){
		$url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$opts=array(
			'http'=>array(
				'method'=>"GET",
				'timeout'=>5
			)
		); // 单位秒


		$cnt=0;
		while ($cnt<3&&($result=@file_get_contents('http://hd.playwx.com/jssdk/config?ghid=wx7390a485f3a9b1d3&url='.urlencode($url), false, stream_context_create($opts)))===FALSE){
			$cnt++;
		}
		if ($result===FALSE){
			// $this->log('JSSDK接口访问超时,请重新进入应用！',Yii::app ()->request->hostInfo . $this->createUrl ( $_GET ['_akey']));
		}else{
			$temp=json_decode($result, true);
			if ($temp&&$temp['errmsg']=='ok'){
				$signPackage=$temp;
			}else{
				// $this->log('JSSDK接口返回错误：'.$temp['errmsg'],Yii::app ()->request->hostInfo . $this->createUrl ( $_GET ['_akey']));
			}
		}
		return $signPackage;
	}
	/**
	 * 由于某些微信用户没有头像，因以此函数进行头像处理，没有头像则返回一张默认头像
	 * @date: 2014-9-16
	 * @author : wintrue<328945440@qq.com>
	 * @param string $headimgurl
	 */
	function getHeadimgurl($headimgurl){
		return $headimgurl ? $headimgurl : $this->_defaultHeadimg;
	}

	/**
	 * 浏览器过滤
	 * @date: 2014-9-29
	 * @author : wintrue<328945440@qq.com>
	 * @param
	 * $activity
	 */
	function browerfilter($activity){
		if (empty($this->userinfo)){
			if (!checkWeixinbrower()){
				// statJs
				// 输出活动第三方统计代码
				// $this->msgTip('亲，请在微信浏览器中打开。',2,$activity['statJs']);
				$this->inpc($activity['statJs'], $_GET['_akey']);
			}
		}
	}
	function assets(){
		return Yii::app()->theme->baseUrl.'/static';
	}
	/**
	 * 错误提示
	 * @date: 2014-11-18
	 * @author : wintrue<328945440@qq.com>
	 * @param unknown $message
	 * @param string $jumpUrl
	 * @param number $time
	 * @param string $ajax
	 */
	function error($message, $jumpUrl='', $time=3, $ajax=false){
		$this->tip('操作失败', $message, 2, $jumpUrl, $time, $ajax);
	}
	/**
	 * 成功提示
	 * @date: 2014-11-18
	 * @author : wintrue<328945440@qq.com>
	 * @param unknown $message
	 * @param string $jumpUrl
	 * @param number $time
	 * @param string $ajax
	 */
	function success($message, $jumpUrl='', $time=1, $ajax=false){
		$this->tip('操作成功', $message, 1, $jumpUrl, $time, $ajax);
	}
	/**
	 * 提示信息
	 * @date: 2014-11-18
	 * @author : wintrue<328945440@qq.com>
	 * @param unknown $msgTitle
	 * @param unknown $message
	 * @param number $status
	 * @param string $jumpUrl
	 * @param number $waitSecond
	 * @param string $ajax
	 */
	function tip($msgTitle, $message, $status=1, $jumpUrl='', $waitSecond=1, $ajax=false){
		$c='success_cont';

		if ($jumpUrl=='top_refresh'){
			$jumpUrl="top.location.href='".WEB_URL."'";
		}else{
			if (empty($jumpUrl))
				$jumpUrl="history.back(-1);";
			else
				$jumpUrl="location.href='$jumpUrl'";
		}
		if ($status==2)
			$c='error_cont';
		$wtime=$waitSecond*1000;
		$path=WEB_URL.'/static/css';
		echo <<<JOT
		<!doctype html>
		<html>
		<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>提示信息</title>
		<link href="$path/msgtip.css" rel="stylesheet">
		</head>
		<body>
		<div class="wrap">
		<div id="error_tips">
		<h2>$msgTitle</h2>
		<div class="$c">
		<ul>
		<li>$message</li>
		</ul>
		<div class="error_return"><a href="javascript:;" onclick="$jumpUrl" class="btn">返回</a></div>
		</div>
		</div>
		</div>
		<script language="javascript">
		setTimeout(function(){
			$jumpUrl;
		},$wtime);
		</script>
		</body>
		</html>
JOT;
		exit();
	}
}