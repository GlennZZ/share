<?php

class PrizeLogController extends BaseController
{
	

	/**
	 * @return array action filters
	 */
	/*public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	*/
	

	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	
	public function actionCreate()
	{
		$model=new PrizeLog;

		// $this->performAjaxValidation($model);

		if(isset($_POST['PrizeLog']))
		{
			$model->attributes=$_POST['PrizeLog'];
			if ($model->save()){
				$this->success('添加成功',$this->createUrl('admin'));
			}else{
				$this->error(getErrStr($model->errors));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}


	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// $this->performAjaxValidation($model);
		if(isset($_POST['PrizeLog']))
		{
			$model->attributes=$_POST['PrizeLog'];
			if ($model->save()){
				$this->success('操作成功',$this->createUrl('admin'));
			}else{
					$this->error(getErrStr($model->errors));
				}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}


	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		// 如果是AJAX请求删除,请取消跳转
		if(!isset($_GET['ajax']))
			$this->success('操作成功');
	}

	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('PrizeLog');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	
	public function actionAdmin()
	{
		$model=new PrizeLog('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PrizeLog']))
			$model->attributes=$_GET['PrizeLog'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	
	public function loadModel($id)
	{
		$model=PrizeLog::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * AJAX验证
	 * @param PrizeLog $model 模型验证
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='prize-log-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
