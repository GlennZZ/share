<?php

/**
* BaseinfoController.php
* ----------------------------------------------
* 版权所有 2014-2015 联众互动
* ----------------------------------------------
* @date: 2014-11-18
* mankio <546234549@qq.com>
*/
class BaseinfoController extends BaseController {
	/**
	 * 调用基本信息编辑模板
	 */
	public function actionIndex() {
		$this->render('info',array(
			    'info' => user(),					
			));
	}
	/**
	 * 调用密码修改模板
	 */
	public function actionModifypwd(){
		$this->render('modifypwd');
	}
	/**
	 * 修改基本信息和session数据
	 */
	public function actionUpdateInfo(){
		$info = $_POST['info'];  //接收表单数据
		$save =array();
		if (!empty($info)){
			//过滤表单数据
			$save['nickname'] = $info['nickname'];
			$save['phone'] = $info['phone'];
			$save['qq'] = $info['qq'];
			$save['email'] = $info['email'];
			$save['headimg'] = $info['headimg'];
		    $res = Yii::app()->db->createCommand()->update('sys_user',$save,'id=:id',array(':id'=>user()->id));
		    unset($info);
		    if ($res !== false){
		    	//更新session数据
		        $secache = user();
		    	$secache->nickname = $save['nickname'];
		    	$secache->phone = $save['phone'];
		    	$secache->qq = $save['qq'];
		    	$secache->email = $save['email'];
		    	$secache->headimg = $save['headimg'];
		    	unset($save);
		    	$this->success("保存成功！");
		    } else {
		    	unset($save);
		    	$this->error("保存失败！", $_SERVER['HTTP_REFERER']);
		    } 
		} 
	}
	/**
	 * 保存新密码
	 */
	public function actionSaveNewpwd(){
		$info = $_POST['info'];  //接收表单数据
		if (!empty($info)){
			//判断输入旧密码是否正确
			if(crypt($info['oldpwd'],user()->password) === user()->password){
				$newpwd = SysUser::model()->hashPassword($info['newpwd']);//新密码加密后的结果
				$efc = Yii::app()->db->createCommand()->update('sys_user',array('password'=>$newpwd),'id=:id',array(':id'=>user()->id));
				unset($info);
				if ($efc > 0){
					user()->password = $newpwd;
					unset($newpwd);
					$this->success("修改成功！");
				} else {
					$this->error("修改失败！");
				}
			} else {
				unset($info);
				$this->error("你输入的原始密码不正确!");
			}
		}
	}


}