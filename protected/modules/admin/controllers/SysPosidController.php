<?php

class SysPosidController extends BaseController{
	public function actionView($id){
		$this->render('view', array(
			'model'=>$this->loadModel($id)
		));
	}
	public function actionCreate(){
		$model=new SysPosid();
		
		// $this->performAjaxValidation($model);
		
		if (isset($_POST['SysPosid'])){
			$model->attributes=$_POST['SysPosid'];
			if ($model->save())
				$this->success('添加成功');
		}
		
		$this->render('create', array(
			'model'=>$model
		));
	}
	public function actionUpdate($id){
		$model=$this->loadModel($id);
		// $this->performAjaxValidation($model);
		if (isset($_POST['SysPosid'])){
			$model->attributes=$_POST['SysPosid'];
			if ($model->save())
				$this->success('操作成功');
		}
		
		$this->render('update', array(
			'model'=>$model
		));
	}
	public function actionDelete($id){
		$this->loadModel($id)->delete();
		// 如果是AJAX请求删除,请取消跳转
		if (!isset($_GET['ajax']))
			$this->success('操作成功');
	}
	public function actionAdmin(){
		$model=new SysPosid('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['SysPosid']))
			$model->attributes=$_GET['SysPosid'];
		
		$this->render('admin', array(
			'model'=>$model
		));
	}
	public function loadModel($id){
		$model=SysPosid::model()->findByPk($id);
		if ($model===null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * AJAX验证
	 * @param SysPosid $model
	 * 模型验证
	 */
	protected function performAjaxValidation($model){
		if (isset($_POST['ajax'])&&$_POST['ajax']==='sys-posid-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
