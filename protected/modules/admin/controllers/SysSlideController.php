<?php

class SysSlideController extends BaseController{
	public function actionView($id){
		$this->render('view', array(
			'model'=>$this->loadModel($id)
		));
	}
	public function actionCreate(){
		$model=new SysSlide();
		
		// $this->performAjaxValidation($model);
		
		if (isset($_POST['SysSlide'])){
			$model->attributes=$_POST['SysSlide'];
		if ($model->save()){
				$this->success('添加成功',$this->createUrl('admin'));
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
		if (isset($_POST['SysSlide'])){
			$model->attributes=$_POST['SysSlide'];
		if ($model->save()){
				$this->success('操作成功',$this->createUrl('admin'));
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
		$model=new SysSlide('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['SysSlide']))
			$model->attributes=$_GET['SysSlide'];
		
		$this->render('admin', array(
			'model'=>$model
		));
	}
	public function loadModel($id){
		$model=SysSlide::model()->findByPk($id);
		if ($model===null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * AJAX验证
	 * @param SysSlide $model
	 * 模型验证
	 */
	protected function performAjaxValidation($model){
		if (isset($_POST['ajax'])&&$_POST['ajax']==='sys-slide-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
