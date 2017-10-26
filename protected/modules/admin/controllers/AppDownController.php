<?php

class AppDownController extends BaseController{
	public function actionView($id){
		$this->render('view', array(
			'model'=>$this->loadModel($id)
		));
	}
	public function actionCreate(){
		$model=new AppDown();
		
		// $this->performAjaxValidation($model);
		
		if (isset($_POST['AppDown'])){
			$model->attributes=$_POST['AppDown'];
			if ($model->save()){
				if($_POST['down_old']==1){
					$m=AppDown::model()->updateAll(array('status'=>0),"unid=:unid and id!=:id",array(':unid'=>$model->unid,':id'=>$model->id));
				}
				$this->success('添加成功', $this->createUrl('admin'));
			}else{
				$this->error(getErrStr($model->errors));
			}
		}
		
		$this->render('create', array(
			'model'=>$model
		));
	}
	public function actionUpdate($id){
		$model=$this->loadModel($id);
		// $this->performAjaxValidation($model);
		if (isset($_POST['AppDown'])){
			$model->attributes=$_POST['AppDown'];
			if ($model->save()){
				if($_POST['down_old']==1){
					$m=AppDown::model()->updateAll(array('status'=>0),"unid=:unid and id!=:id",array(':unid'=>$model->unid,':id'=>$model->id));
				}
				$this->success('操作成功', $this->createUrl('admin'));
			}else{
				
				$this->error(getErrStr($model->errors));
			}
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
		$model=new AppDown('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['AppDown']))
			$model->attributes=$_GET['AppDown'];
		
		$this->render('admin', array(
			'model'=>$model
		));
	}
	public function loadModel($id){
		$model=AppDown::model()->findByPk($id);
		if ($model===null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * AJAX验证
	 * @param AppDown $model
	 * 模型验证
	 */
	protected function performAjaxValidation($model){
		if (isset($_POST['ajax'])&&$_POST['ajax']==='app-down-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
