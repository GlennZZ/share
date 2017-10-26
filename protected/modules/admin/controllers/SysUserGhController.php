<?php

/**公众账号
* SysUserGhController.php
* ----------------------------------------------
* 版权所有 2014-2015 联众互动
* ----------------------------------------------
* @date: 2014-12-9
* @author: wintrue <328945440@qq.com>
*/
class SysUserGhController extends BaseController{
	public function actionView($id){
		$this->render('view', array(
			'model'=>$this->loadModel($id)
		));
	}
	public function actionUpdate(){
		$model=SysUserGh::model()->findByAttributes(array(
			'ghid'=>gh()->ghid
		));
		if (isset($_POST['SysUserGh'])){
			unset($_POST['SysUserGh']['ghid']);
			$model->attributes=$_POST['SysUserGh'];
			$model->utm=date('Y-m-d H:i:s');
			if ($model->save())
				$this->success('操作成功');
		}
		
		$this->render('update', array(
			'model'=>$model
		));
	}
	function actionTranspond(){
		$model=SysUserGh::model()->findByAttributes(array(
			'ghid'=>gh()->ghid
		));
		if (isset($_POST['SysUserGh'])){
			
			// 不可更改下列
			unset($_POST['SysUserGh']['ghid']);
			$model->attributes=$_POST['SysUserGh'];
			$model->utm=date('Y-m-d H:i:s');
			if ($model->save())
				$this->success('操作成功');
		}
		
		$this->render('transpond', array(
			'model'=>$model
		));
	}
	public function actionInfo(){
		
		if (!gh()->ghid){
			if (!empty(user()->ghid)){
				$this->redirect(U('&update'));
				exit();
			}else{
				$model=new SysUserGh();
				if (isset($_POST['SysUserGh'])){
					$model->attributes=$_POST['SysUserGh'];
					if (SysUserGh::model()->find("ghid='".$model->ghid."'")){
						$this->error('该公众号已经添加过,不能再添加!');
					}
					$model->tenant_id=user()->id;
					$model->ctm=date('Y-m-d H:i:s');
					if ($model->save()){
						$model_user=user();
						$model_user->ghid=$model->ghid;
						yii::app()->session['admin']=$model_user;
						resetGh($model->ghid);
						$model_user->save();
						$this->success('操作成功', 'top_refresh');
					}else{
						
						
						$this->error('操作失败！'.getErrStr($model->errors));
					}
				}
				$this->render('info', array(
					'model'=>$model
				));
			}
		}else{
			$this->redirect(U('&update'));
			exit();
		}
	}
	/**
	 * 切换管理
	 * @date: 2014-12-17
	 * @author: wintrue<328945440@qq.com>
	 * @param unknown $ghid
	 */
	function actionSwitch($ghid){
		if(empty($ghid))$this->error('请先绑定公众号');
		resetGh($ghid); 
		$this->success('正在处理,请稍后...', 'top_refresh', 0.5);
	}
	
	public function loadModel($id){
		$model=SysUserGh::model()->findByPk($id);
		if ($model===null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}
	public function actionAdmin(){
		$model=new SysUserGh('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['SysUserGh']))
			$model->attributes=$_GET['SysUserGh'];
		
		$this->render('admin', array(
			'model'=>$model
		));
	}
	/**
	 * AJAX验证
	 * @param SysUserGh $model
	 * 模型验证
	 */
	protected function performAjaxValidation($model){
		if (isset($_POST['ajax'])&&$_POST['ajax']==='sys-user-gh-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
