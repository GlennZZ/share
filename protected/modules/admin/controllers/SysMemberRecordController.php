<?php

class SysMemberRecordController extends BaseController{
	
	public function actionCreate(){
		$model=new SysMemberRecord();
		if (isset($_POST['SysMemberRecord'])){
			$model->attributes=$_POST['SysMemberRecord'];
			if ($model->save())
				$this->redirect(array(
					'view', 
					'id'=>$model->id
				));
		}
		
		$this->render('create', array(
			'model'=>$model
		));
	}
	
	public function actionUpdate($id){
		$model=$this->loadModel($id);
		if (isset($_POST['SysMemberRecord'])){
			$model->attributes=$_POST['SysMemberRecord'];
			if ($model->save())
				$this->redirect(array(
					'view', 
					'id'=>$model->id
				));
		}
		
		$this->render('update', array(
			'model'=>$model
		));
	}
	
	public function actionDelete($id){
		$this->loadModel($id)->delete();
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
				'admin'
			));
	}

	public function actionAdmin(){
		$model=new SysMemberRecord('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['SysMemberRecord']))
			$model->attributes=$_GET['SysMemberRecord'];
		
		$this->render('admin', array(
			'model'=>$model
		));
	}
	public function actionAdmin2(){
		$model=new SysMemberRecord('search2');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['SysMemberRecord']))
			$model->attributes=$_GET['SysMemberRecord'];
	
		$this->render('admin2', array(
			'model'=>$model
		));
	}
	public function loadModel($id){
		$model=SysMemberRecord::model()->findByPk($id);
		if ($model===null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}
	
	protected function performAjaxValidation($model){
		if (isset($_POST['ajax'])&&$_POST['ajax']==='sys-member-record-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
