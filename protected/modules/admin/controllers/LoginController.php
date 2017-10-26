<?php

/**用户 登录模块
* LoginController.php
* ----------------------------------------------
* 版权所有 2014-2015 联众互动
* ----------------------------------------------
* @date: 2014-12-10
* @author: wintrue <328945440@qq.com>
*/
class LoginController extends BController{
	public function actionIndex(){
		// 要求crypt的支持
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500, "This application requires that PHP was compiled with Blowfish support for crypt().");
		
		$model=new SysUser();
		if (isset($_POST['SysUser'])){
			$model->attributes=$_POST['SysUser'];
			$model->rememberMe=$_POST['SysUser']['rememberMe'];
			if ($model->login()){
				//$this->success('登录成功！',WEB_URL,0.3);
				$config=get_websetup_config();
				if($config['webclose']==0&&user()->id!=1){
					$this->error('系统正在维护中，请稍后再登录！');//网站关闭后仅超级管理员可登录
				}
				$this->redirect('/admin/default');
			}else{
				
				$this->render('index', array(
					'model'=>$model, 
					'error'=>1
				));
				exit();
			}
		}
		$saveData=json_decode(cookie('admin_local'),true);
		if($saveData){
			$model->username=$saveData['username'];
			$model->password=authcode($saveData['password'],'DECODE');
			$model->rememberMe=1;
		}
		$this->render('index', array(
			'model'=>$model
			
		));
	}
	/**
	 * 退出操作
	 * @date: 2014-12-10
	 * @author : wintrue<328945440@qq.com>
	 */
	function actionLogout(){
		Yii::app()->session['admin']=null;
		yii::app()->session['gh']=null;
		$this->redirect('/admin/login');
	}
}