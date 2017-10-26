<?php
/**
* AppGameController.php
* ----------------------------------------------
* 版权所有 2014-2015 联众互动
* ----------------------------------------------
* @date: 2015-5-11
* @author: wintrue <328945440@qq.com>
*/
class AppGameController extends BaseController{
	public function actionCreate(){
		$model=new AppGame();
		if (isset($_POST['AppGame'])){
			$model->attributes=$_POST['AppGame'];
			/*if(!empty($model->posid)){
			$model->posid=implode(',', $model->posid);
			}else{
				$model->posid=0;
			}*/
			$model->integral=$model->integral_all;
			if ($model->save()){
				$this->success('添加成功', $this->createUrl('admin', array(
					'category'=>$model->category
				)));
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
		$oldmodel=$model;
		if (isset($_POST['AppGame'])){
			$model->attributes=$_POST['AppGame'];
			/*if(!empty($model->posid)){
			$model->posid=implode(',', $model->posid);
			}else{
				$model->posid=0;
			}*/
			$model->integral=$oldmodel->integral;
			$model->integral_all=$oldmodel->integral_all;
			if ($model->save()){
				$this->success('操作成功', $this->createUrl('admin', array(
					'category'=>$model->category
				)));
			}else{
				$this->error(getErrStr($model->errors));
			}
		}

		$this->render('update', array(
			'model'=>$model
		));
	}
	function actionUpdateNum(){
		$num_type=intval($_POST['num_type']);
		$num=intval($_POST['num']);
		$aid=intval($_POST['aid']);
		if($num_type==1){
			$stock_value=$num;
		}else{
			$stock_value=-$num;
		}
		//表写锁定
		try {
			Yii::app()->db->createCommand()->setText("lock tables app_game WRITE")->execute();
			$row=Yii::app ()->db->createCommand("select * from app_game where id=$aid")->queryRow();
			if($stock_value<0){
				if($row['integral']+$stock_value<0){
					//表解锁
					Yii::app()->db->createCommand()->setText("unlock  tables")->execute();
					$this->json_result('操作失败,当前可用积分为：'.$row['integral'].",无法减少$num分");
				}
			}
			Yii::app()->db->createCommand()->setText("update app_game set integral=integral+".$stock_value." where id=$aid")->execute();
			Yii::app()->db->createCommand()->setText("update app_game set integral_all=integral_all+".$stock_value." where id=$aid")->execute();
			//表解锁
			Yii::app()->db->createCommand()->setText("unlock  tables")->execute();
			$this->json_result('操作成功',1,array('integral'=>$row['integral']+$stock_value,'integral_all'=>$row['integral_all']+$stock_value));
		} catch (Exception $e) {
			Yii::app()->db->createCommand()->setText("unlock  tables")->execute();
			$this->json_result('操作失败！');
		}
		
	
	}
	function json_result($msg='',$code=-1,$result=''){
		echo json_encode(array('result'=>$result,'code'=>$code,'msg'=>$msg));exit;
	}
	public function actionDelete($id){
		$this->loadModel($id)->delete();
		// 如果是AJAX请求删除,请取消跳转
		if (!isset($_GET['ajax']))
			$this->success('操作成功');
	}
	public function actionAdmin(){
		$model=new AppGame('search');
		$model1=AppGame::model()->findByPk(1620);
		$mm=new AppGame();
		$mm->attributes=$model1->attributes;
		$mm->save();
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['AppGame']))
			$model->attributes=$_GET['AppGame'];

		$this->render('admin', array(
			'model'=>$model
		));
	}
	public function loadModel($id){
		$model=AppGame::model()->findByPk($id);
		if ($model===null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}
	/**
	 * 获取地区列表，暂时获取广东省的
	 *
	 * @date: 2015-5-6
	 * @author: wintrue<328945440@qq.com>
	 * @return Ambigous <multitype:CActiveRecord , mixed, CActiveRecord, NULL, multitype:unknown Ambigous <CActiveRecord, NULL> , unknown, multitype:unknown Ambigous <unknown, NULL> , multitype:, multitype:unknown >
	 */
	function getAreaList(){
		return DsArea::model()->findAllByAttributes(array(
			'pid'=>423
		));
	}
	/**
	 * 批量操作
	 * @date: 2015-5-6
	 * @author : wintrue<328945440@qq.com>
	 */
	function actionBatchOps(){
		$data=$_POST['data'];
		if (!empty($data)){
			foreach ((array) $data as $v){
				$model=AppGame::model()->findByAttributes(array(
					'id'=>$v
				));
				switch (intval($_GET['type'])){
					case 1://删除
						if ($model){
							$model->delete();
						}
						break;
					case 2://首发
						if ($model){
							$model->classify=4;
							$model->save();
						}
						break;
					case 3://推荐
						if ($model){
							$model->classify=2;
							$model->save();
						}
						break;
					case 4://上架
						if ($model){
							if(strtotime($model->start_tm)>time()){
								$model->start_tm=date('Y-m-d H:i:s');
							}
							if(strtotime($model->stop_tm)<time()){
								$model->stop_tm=date('Y-m-d H:i:s',time()+30*24*60*60);;
							}
							$model->save();
						}
						break;
					case 5://下架
						if ($model){
							$model->stop_tm=date('Y-m-d H:i:s');
							$model->save();
						}
						break;
				}
				unset($model);

			}
			echo 'ok';
			exit();
		}
	}
	/**
	 * AJAX验证
	 * @param AppGame $model
	 * 模型验证
	 */
	protected function performAjaxValidation($model){
		if (isset($_POST['ajax'])&&$_POST['ajax']==='app-game-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
