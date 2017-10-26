<?php

/**
* SysuserController.php
* ----------------------------------------------
* 版权所有 2014-2015 联众互动
* ----------------------------------------------
* @date: 2015-4-17
* @author: wintrue <328945440@qq.com>
*/
class SysuserController extends BaseController{
function actionIndex(){
	
	
}
	/**
	 * 添加用户
	 * @date: 2015-3-5
	 * @author : wintrue<328945440@qq.com>
	 */
	public function actionCreate(){
		$model=new SysUser();
		if (isset($_POST['SysUser'])){
			$model->attributes=$_POST['SysUser'];
			$model->password=$model->hashPassword($model->password);
			if ($model->save())
				$this->success('添加成功!', $this->createUrl('admin'));
			$this->error('操作失败！'.getErrStr($model->errors));
		}
		
		$this->render('create', array(
			'model'=>$model, 
			'title'=>'添加用户', 
			'form'=>'_form'
		));
	}
	/**
	 * 更新用户
	 * @date: 2015-3-5
	 * @author : wintrue<328945440@qq.com>
	 * @param
	 * 用户 id $id
	 */
	public function actionUpdate($id){
		if ($id==1&&user()->id!=1){
			$this->error('拒绝操作！');
		}
		$model=$this->loadModel($id);
		if (isset($_POST['SysUser'])){
			$oldpwd=$model->password;
			if (!empty($_POST['SysUser']['username']))
				$this->error('access');
			$model->attributes=$_POST['SysUser'];
			if (empty($_POST['SysUser']['password'])){
				$model->password=$oldpwd;
			}else{
				if ($_POST['SysUser']['password']!=$_POST['info']['pwdagain']){
					$this->error('两次输入的密码不一样！');
				}
				$model->password=$model->hashPassword($model->password);
			}
			if ($model->save()){
				$this->success('更新成功!');
			}else{
				$this->error(getErrStr($model->errors));
			}
		}
		$this->render('update', array(
			'model'=>$model
		));
	}
	
	/**
	 * 模拟登录
	 * @date: 2015-3-9
	 * @author : wintrue<328945440@qq.com>
	 * @param
	 * $uid
	 */
	function actionSwitchLogin($id){
		$user=SysUser::model()->findByPk($id);
		if (!empty($user)){
			$this->isMyUser($user->id, user()->id);
			
			$user->last_login_time=time();
			$user->last_login_ip=Yii::app()->request->userHostAddress;
			$user->login_count=$user->login_count+1;
			$user->save();
			yii::app()->session['admin']=$user;
			yii::app()->session['gh']=SysUserGh::model()->find("ghid='".$user->ghid."'");
			// cookie('admin_local', null);
			$this->success('正在登录,请稍后...', 'top_refresh', 0.5);
		}
	}
	/**
	 * 删除
	 * @date: 2015-3-5
	 * @author : wintrue<328945440@qq.com>
	 * @param unknown $id 
	 */
	public function actionDelete($id){
		$this->loadModel($id)->delete();
		if (!isset($_GET['ajax']))
			$this->success('删除成功!');
	}
	function getGroupName($id){
		return SysUsergroup::model()->findByPk($id)->groupname;
	}
	/**
	 * 所有用户 管理
	 * @date: 2015-3-9
	 * @author : wintrue<328945440@qq.com>
	 */
	public function actionAdmin(){
		$model=new SysUser('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['SysUser']))
			$model->attributes=$_GET['SysUser'];
		
		$this->render('admin', array(
			'model'=>$model
		));
	}
	public function loadModel($id){
		$model=SysUser::model()->findByPk($id);
		if ($model===null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}
	protected function performAjaxValidation($model){
		if (isset($_POST['ajax'])&&$_POST['ajax']==='sys-user-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
