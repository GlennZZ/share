<?php

/**
* SysSetupController.php
* ----------------------------------------------
* 版权所有 2014-2015 联众互动
* ----------------------------------------------
* @date: 2015-4-1
* @author: wintrue <328945440@qq.com>
*/
class SysSetupController extends BaseController{

	public function actionIndex(){
		$this->render('index', array(
			'list'=>get_websetup_config(true)
		));
	}
	function actionWebSetup(){
		$this->render('url', array(
			'list'=>get_websetup(true)
		));
	}
	function actionUpdateh(){
		$info=isset($_POST["info"]) ? $_POST["info"] : "";
		if (!is_array($info)){
			$this->error("没有可以保存的数据！");
		}
		foreach ($info as $keys=>$vals){
			Yii::app()->db->createCommand()->update('sys_setup', array(
			"cvalue"=>$vals
			), "cname='".$keys."'");
		}
		get_websetup(true);
		get_websetup_config(true);
		$this->success("编辑成功！");
	}
	function actionUpdate(){
		$info=isset($_POST["info"]) ? $_POST["info"] : "";
		if (!is_array($info)){
			$this->error("没有可以保存的数据！");
		}
		
		foreach ($info as $keys=>$vals){
			Yii::app()->db->createCommand()->update('sys_setup', array(
				"cvalue"=>$vals
			), "cname='".$keys."'");
		}
		get_websetup_config(true);
		get_websetup(true);
		$this->success("编辑成功！");
	}
}