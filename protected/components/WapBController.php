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
	protected $userinfo; // 当前访问用户的基本资料
	private $_defaultHeadimg='http://www.playwx.com/hd/images/anymonus.png';
	protected $signPackage;
	private $_cookieUser='_userloc';
	private $_cookieTime=604800; // 24*60*60*7 7天保留
	public $jssdk_debug=false;
	public $fromwx;
	public $fromType=0;
	protected $authorizeapi='http://oauth.i-lz.cn/authorize';


	protected $webconfig='';
	function init(){
		parent::init();
		yii::app()->theme='mobile';
		// 手动清除会话存储
		if (!empty($_GET['r-id'])&&$_GET['r-id']==1){
			unset($_GET['r-id']);
			Yii::app()->session['addon_userinfo_platform']=null;
			cookie(null);
		}
		//o1nl5uDJiR1VtnRVt2IVlBCn8G00 线上调试号
		if(!empty($_GET['debug-wintrue'])){
			$row=Yii::app ()->db->createCommand ()->select ( '*' )->from ( 'sys_member' )->where ( 'openid=:openid', array (':openid' => 'o1nl5uDJiR1VtnRVt2IVlBCn8G00') )->queryRow ();
			yii::app ()->session ['addon_userinfo_platform'] = $row;
			$this->saveCookieUser($row);

		}
		if (yii::app()->session['addon_userinfo_platform']){
			$this->userinfo=yii::app()->session['addon_userinfo_platform'];
		}else{
			if (empty($this->userinfo)){
				$this->readCookieUser($this->getFullUrl());
			}
			if($this->isAjax()){
				$this->ajax_return('登录信息失效,请重新进入！',-1);
			}
			$this->wxLogin();
		}
		$this->signPackage=$this->getSignPackage();
		if (!empty($_GET['_fromwx'])){
			$this->fromwx=$_GET['_fromwx'];
		}
		$type=$_GET['from'];
		if (empty($type)){ // 1 公众号
			$this->fromType="1";
		}else if ($type=="timeline"){ // 2 朋友圈
			$this->fromType="2";
		}else if ($type=="singlemessage"){ // 3 好友
			$this->fromType="3";
		}else{
			$this->fromType="0";
		}
		$this->webconfig=get_websetup();
	}
	function getFullUrl(){
		/*$url=Yii::app()->request->hostInfo.Yii::app()->request->getUrl();
		$url=str_replace('r-id', 'r-ud', $url);*/
		$url=Yii::app()->request->hostInfo.'/'.Yii::app()->request->getPathInfo().'?'.http_build_query($_GET);
		return $url;
	}
	/**
	 * 判断是否是AJAX提交，是根据AJAX特性进行判断，非带参数标识的判断
	 * @date: 2014-9-15
	 * @author : wintrue<328945440@qq.com>
	 */
	function isAjax(){
		return isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']==='XMLHttpRequest';
	}
	/**
	 * 微信授权开始
	 * @date: 2015-5-29
	 * @author : wintrue<328945440@qq.com>
	 */
	function wxLogin(){
		
		//$scope='&scope=1';
		//if($is_oauth==2)$scope='';
		$scope='&scope=1';
		$ghid='gh_7cd507733d96';
		$location=$this->authorizeapi.'?returnUrl='.urlencode(Yii::app()->request->hostInfo.'/'.Yii::app()->request->getPathInfo().'?'.http_build_query($_GET)).'&ghid='.$ghid.$scope;
		if (! empty ( $_GET ['uuauthtoken'] )) {
			$uuauthtoken=$_GET ['uuauthtoken'];
			$_GET['uuauthtoken']='';
			unset($_GET['uuauthtoken']);
			$reload=$this->getFullUrl();
			$row=json_decode($re=@file_get_contents(''.$this->authorizeapi.'/userinfo?uuauthtoken='.$uuauthtoken),true);
			if($row&&empty($row['errcode'])){
				$member=Yii::app()->db->createCommand()
				->select('*')
				->from('sys_member')
				->where('openid=:openid and ghid=:ghid', array(
					':openid'=>$row['openid'],
					':ghid'=>$row['ghid']
				))
				->queryRow();
				$data['srcOpenid']=$row['openid'];
				$data['nickname']=$row['nickname'];
				$data['headimgurl']=$row['headimgurl'];
				$data['sex']=$row['sex'];
				$data['province']=$row['province'];
				$data['city']=$row['city'];
				$data['channel']=$row['channel'];

				if (empty($member)){
					$data['openid']=$row['openid'];
					$data['ghid']=$row['ghid'];
					$data['ctm']=date('Y-m-d H:i:s');
					Yii::app()->db->createCommand()->insert('sys_member', $data);
					/*$member=Yii::app()->db->createCommand()
					->select('*')
					->from('sys_member')
					->where('openid=:openid and ghid=:ghid', array(
						':openid'=>$row['openid'],
						':ghid'=>$row['ghid']
					))
					->queryRow();*/
				}else{
					$data['utm']=date('Y-m-d H:i:s');
					Yii::app()->db->createCommand()->update('sys_member', $data, 'openid=:openid and ghid=:ghid', array(
					':openid'=>$row['openid'],
					':ghid'=>$row['ghid']
					));
				}
				$data['openid']=$row['openid'];
				$data['ghid']=$row['ghid'];
				yii::app()->session['addon_userinfo_platform']=$data;
				$this->saveCookieUser($data);
				header('Location: '.$reload);exit;
			}else{
				//重新授权
				header('Location: '.$reload);exit;
			}
		} else {
			header ( 'Location: '.$location);exit();
		}
		/*$ghid='gh_48b3246a7bb7';
		$scope=$_GET['scope'];
		$state=md5(time().mt_rand(1, 1000000));
		unset($_GET['r-id']);
		Yii::app()->cache['wreload_'.$state]=$this->getFullUrl();
		Yii::app()->cache[$state]=array(
			'ghid'=>$ghid,
			'key'=>$this->ghidlist[$ghid],
			'scope'=>$scope
		);
		$scope='&scope='.($scope ? $scope : 'snsapi_userinfo');
		$returnUrl=$this->getFullUrl();
		if (strpos($returnUrl, '?')){
			$url=$returnUrl.'&state='.$state.'&key='.time();
		}else{
			$url=$returnUrl.'?state='.$state.'&key='.time();
		}
		$location='http://hd.i-lz.cn/oauth_api?returnUrl='.urlencode($url).'&ghid='.$ghid.$scope;
		header('Location:'.$location);
		exit();*/
	}
	/**
	 * 微信授权回调
	 * @date: 2015-5-29
	 * @author: wintrue<328945440@qq.com>
	 */
	function wxRedirect(){
		if (isset($_GET['state'])){
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
			if (!empty($_GET['oid'])){
				unset($_GET['key']);
				unset($_GET['oauthtoken']);
				$userinfo=Yii::app()->wxdb->createCommand()
					->select('*')
					->from('wx_user_info')
					->where('openid=:openid and ghid=:ghid', array(
					':openid'=>$_GET['oid'],
					':ghid'=>$ghidinfo['ghid']
				))
					->queryRow();
				if ($userinfo){
					$member=Yii::app()->db->createCommand()
						->select('*')
						->from('sys_member')
						->where('openid=:openid and ghid=:ghid', array(
						':openid'=>$userinfo['openid'],
						':ghid'=>$userinfo['ghid']
					))
						->queryRow();
					if (empty($member)){
						unset($userinfo['id']);
						Yii::app()->db->createCommand()->insert('sys_member', $userinfo);
					}else{
						unset($userinfo['id']);
						Yii::app()->db->createCommand()->update('sys_member', $userinfo, 'openid=:openid and ghid=:ghid', array(
							':openid'=>$userinfo['openid'],
							':ghid'=>$userinfo['ghid']
						));
					}
					yii::app()->session['addon_userinfo_platform']=$userinfo;
					$this->saveCookieUser($userinfo);
					Yii::app()->cache[$_GET['state'].'isuse']='no';
					unset($_GET['state']);
					unset($_GET['key']);
					unset($_GET['oauthtoken']);
					unset($_GET['oid']);
					unset($_GET['r-id']);
					unset($_GET['r-ud']);
					$url=$this->getFullUrl();
					//$url=Yii::app()->request->hostInfo.'/'.Yii::app()->request->getPathInfo().'?'.http_build_query($_GET);
					echo <<<JOT
<!DOCTYPE html><html><head><meta http-equiv="Content-Type"content="text/html; charset=UTF-8"/><meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;"name="viewport"/><meta content="yes"name="apple-mobile-web-app-capable"/><meta content="black"name="apple-mobile-web-app-status-bar-style"/><meta content="telephone=no"name="format-detection"/><title>正在返回....</title><style>body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,textarea,p,blockquote,th,td{padding:0;margin:0;font:0/0'Microsoft YaHei';}.loding{background:#F5F5F5;;width:100%;height:100%;position:fixed;z-index:999}.spinner{margin:-30px 0 0 -30px;width:60px;height:60px;top:50%;left:50%;position:absolute;text-align:center;-webkit-animation:rotate 2.0s infinite linear;animation:rotate 2.0s infinite linear}.dot1,.dot2{width:60%;height:60%;display:inline-block;position:absolute;top:0;background-color:#15A838;border-radius:100%;-webkit-animation:bounce 2.0s infinite ease-in-out;animation:bounce 2.0s infinite ease-in-out}.dot2{top:auto;bottom:0;-webkit-animation-delay:-1.0s;animation-delay:-1.0s}@-webkit-keyframes rotate{100%{-webkit-transform:rotate(360deg)}}@keyframes rotate{100%{transform:rotate(360deg);-webkit-transform:rotate(360deg)}}@-webkit-keyframes bounce{0%,100%{-webkit-transform:scale(0.0)}50%{-webkit-transform:scale(1.0)}}@keyframes bounce{0%,100%{transform:scale(0.0);-webkit-transform:scale(0.0)}50%{transform:scale(1.0);-webkit-transform:scale(1.0)}}
section{position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;width:100%;height:100%;}</style></head><body><section class="loding"id="loading"><div class="spinner"><div class="dot1"></div><div class="dot2"></div></div></section><script>function goTo(url){var a=document.createElement("a");if(!a.click){window.location=url;return;}a.setAttribute("href",url);a.style.display="none";document.body.appendChild(a);a.click();}goTo('$url');</script></body></html>
JOT;
					exit();
				}else{
					if (Yii::app()->cache['wreload_'.$state]){
						header('Location:'.Yii::app()->cache['wreload_'.$state]);
						exit();
					}else{
						$this->error('该链接无效');
					}
				}
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
	 * 保存本地cookie信息
	 * @date: 2014-9-28
	 * @author : wintrue<328945440@qq.com>
	 * @param
	 * $user
	 */
	function saveCookieUser($user){
		if($user){
			cookie('addon_userinfo_platform'.$this->_cookieUser, json_encode(array(
				'openid'=>$user['openid'],
				'ghid'=>$user['ghid'],
				'nickname'=>$user['nickname'],
				'headimgurl'=>$user['headimgurl'],
				'a_ghid'=>$user['ghid']
			)), $this->_cookieTime);
		}
	}
	/**
	 * 读取本地存储的cookie
	 * @date: 2014-9-28
	 * @author : wintrue<328945440@qq.com>
	 * @param
	 * $url
	 * @param
	 * $action
	 */
	function readCookieUser($url){
		$user=json_decode(cookie('addon_userinfo_platform'.$this->_cookieUser), true);
		if (!empty($user)){
			$this->Quicklogin($user,$url);
		}
	}
	/**
	 * 快速登录
	 * @date: 2014-9-28
	 * @author : wintrue<328945440@qq.com>
	 * @param
	 * $url
	 * @param
	 * $action
	 */
	function Quicklogin($user,$url){
		//$user=json_decode(cookie('addon_userinfo_platform'.$this->_cookieUser), true);
		if ($user){
			$userinfo=Yii::app()->db->createCommand()
				->select('*')
				->from('sys_member')
				->where('openid=:openid and ghid=:ghid', array(
				':openid'=>$user['openid'],
				'ghid'=>$user['ghid']
			))
				->queryRow();
			yii::app()->session['addon_userinfo_platform']=$user;
			header('Location: '.$url);
			exit();
		}
	}

	/**
	 * 微信jssdk签名接口
	 * @date: 2015-5-31
	 * @author: wintrue<328945440@qq.com>
	 * @return mixed
	 */
	public function getSignPackage(){
		$url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$opts=array('http'=>array('method'=>"GET", 	'timeout'=>5)); // 单位秒
		$cnt=0;	
		while ($cnt<3&&($result=@file_get_contents($this->authorizeapi.'/jssdkSignPackage?ghid=gh_7cd507733d96&url='.urlencode($url), false, stream_context_create($opts)))===FALSE){
			$cnt++;
		}
		//dump($result);exit;
		if ($result===FALSE){
			// $this->log('JSSDK接口访问超时,请重新进入应用！',Yii::app ()->request->hostInfo . $this->createUrl ( $_GET ['_akey']));
		}else{
			$temp=json_decode($result, true);
			if ($temp&&empty($temp['errmsg'])){
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
	function error($message, $jumpUrl='', $time=3){
		$this->tip($message, 2, $jumpUrl, $time);
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
	function success($message, $jumpUrl='', $time=1){
		$this->tip($message, 1, $jumpUrl, $time);
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
	function tip($message, $status=1, $jumpUrl='', $waitSecond=1){
		if($this->isAjax()){
			$this->ajax_return($message,-1);
		}else{
			$this->renderInternal(Yii::getPathOfAlias ( 'webroot.themes.mobile.views.default' ).'/exmsg.php',array(
				'msg'=>$message,
				'jumpurl'=>$jumpUrl,
				'type'=>$status,
				'time'=>$waitSecond
			));
			exit;
		}		
	}
	
	function ajax_return($result_msg,$result_code=1,$result_data=''){
		echo json_encode(array(
			'result_data'=>$result_data,
			'result_code'=>$result_code,
			'result_msg'=>$result_msg
		));
		exit();
	}
}