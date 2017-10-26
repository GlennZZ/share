<?php

/**
* StatReportController.php
* ----------------------------------------------
* 版权所有 2014-2015 联众互动
* ----------------------------------------------
* @date: 2015-3-30
* @author: wintrue <328945440@qq.com>
*/
class StatReportController extends BaseController{
	/*
	 * public function actionDelete($id){
	 * $this->loadModel($id)->delete();
	 * // 如果是AJAX请求删除,请取消跳转
	 * if (!isset($_GET['ajax']))
	 * $this->success('操作成功');
	 * }
	 * public function actionIndex(){
	 * $dataProvider=new CActiveDataProvider('StatReport');
	 * $this->render('index', array(
	 * 'dataProvider'=>$dataProvider
	 * ));
	 * }
	 * public function actionAdmin(){
	 * $model=new StatReport('search');
	 * $model->unsetAttributes(); // clear any default values
	 * if (isset($_GET['StatReport']))
	 * $model->attributes=$_GET['StatReport'];
	 *
	 * $this->render('admin', array(
	 * 'model'=>$model
	 * ));
	 * }
	 */
	/**
	 * 流量统计
	 * @date: 2015-3-30
	 * @author : wintrue<328945440@qq.com>
	 */
	function actionFlow(){
		$model=new StatReport('search_flow');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['StatReport']))
			$model->attributes=$_GET['StatReport'];
		
		$this->render('flow', array(
			'model'=>$model, 
			'r1'=>$_GET['StatReport']['day'][1], 
			'r2'=>$_GET['StatReport']['day'][2]
		));
	}
	/**
	 * 移动设备
	 * @date: 2015-3-31
	 * @author : wintrue<328945440@qq.com>
	 */
	function actionMobile(){
		$model=new StatData('search_detail');
		$model->unsetAttributes();
		if (isset($_GET['StatData']))
			$model->attributes=$_GET['StatData'];
		$where='';
		if (!empty($_GET['StatData']['aid']))
			$where.=' and aid='.intval($_GET['StatData']['aid']);
		if (!empty($_GET['StatData']['rtime'][1]))
			$where.=" and rtime>='".$_GET['StatData']['rtime'][1]."'";
		if (!empty($_GET['StatData']['rtime'][2]))
			$where.=" and rtime<='".$_GET['StatData']['rtime'][2]."'";
		if (empty($_GET['StatData']['rtime'][1])&&empty($_GET['StatData']['rtime'][2])){
			$where.=" and rtime>='".date('Y-m-d', strtotime("-7 day"))."'";
			$where.=" and rtime<='".date('Y-m-d')."'";
		}
		
		$os=Yii::app()->db->createCommand()
			->select('count(id) num,os')
			->from('stat_data')
			->where("ghid='".gh()->ghid."'  $where")
			->group('os')
			->queryAll();
		// select count(id) num,mobile from stat_data group by mobile ORDER BY num desc LIMIT 15;
		$mobile=Yii::app()->db->createCommand()
			->select('count(id) num,mobile')
			->from('stat_data')
			->where("ghid='".gh()->ghid."'  $where")
			->group('mobile')
			->order('num desc')
			->limit(15)
			->queryAll();
		// dump($os);
		$cc=array(
			'os'=>$os, 
			'mobile'=>$mobile, 
			'model'=>$model,
			'r1'=>$_GET['StatData']['rtime'][1],
			'r2'=>$_GET['StatData']['rtime'][2]
		);
		
		$this->render('mobile', $cc);
	}
	/**
	 * 访问详细
	 * @date: 2015-3-31
	 * @author : wintrue<328945440@qq.com>
	 */
	function actionDetail(){
		$model=new StatData('search_detail');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['StatData']))
			$model->attributes=$_GET['StatData'];
		
		$this->render('detail', array(
			'model'=>$model
		));
	}
	/**
	 * 新增独立用户
	 * @date: 2015-3-31
	 * @author : wintrue<328945440@qq.com>
	 */
	function actionNouser(){
		$model=new StatData('search_detail');
		$model->unsetAttributes();
		if (isset($_GET['StatData']))
			$model->attributes=$_GET['StatData'];
		$where='';
		if (!empty($_GET['StatData']['aid']))
			$where.=' and aid='.intval($_GET['StatData']['aid']);
		if (!empty($_GET['StatData']['rtime'][1]))
			$where.=" and rtime>='".$_GET['StatData']['rtime'][1]."'";
		if (!empty($_GET['StatData']['rtime'][2]))
			$where.=" and rtime<='".$_GET['StatData']['rtime'][2]."'";
		if (empty($_GET['StatData']['rtime'][1])&&empty($_GET['StatData']['rtime'][2])){
			$where.=" and rtime>='".date('Y-m-d', strtotime("-7 day"))."'";
			$where.=" and rtime<='".date('Y-m-d')."'";
		}
		$data1=Yii::app()->db->createCommand()
			->select('DATE_FORMAT(rtime,"%Y%m%d") days,COUNT( DISTINCT wxid ) as cv')
			->from('stat_data')
			->where("ghid='".gh()->ghid."' $where and cid=1 ")
			->group('days')
			->queryAll();
		$this->render('nouser', array(
			'data1'=>$data1, 
			'model'=>$model, 
			'r1'=>$_GET['StatData']['rtime'][1], 
			'r2'=>$_GET['StatData']['rtime'][2]
		));
	}
	/**
	 * 地区分布、网络运营商
	 * @date: 2015-3-31
	 * @author : wintrue<328945440@qq.com>
	 */
	function actionAisp(){
		$model=new StatData('search_detail');
		$model->unsetAttributes();
		if (isset($_GET['StatData']))
			$model->attributes=$_GET['StatData'];
		$where='';
		if (!empty($_GET['StatData']['aid']))
			$where.=' and aid='.intval($_GET['StatData']['aid']);
		if (!empty($_GET['StatData']['rtime'][1]))
			$where.=" and rtime>='".$_GET['StatData']['rtime'][1]."'";
		if (!empty($_GET['StatData']['rtime'][2]))
			$where.=" and rtime<='".$_GET['StatData']['rtime'][2]."'";
		if (empty($_GET['StatData']['rtime'][1])&&empty($_GET['StatData']['rtime'][2])){
			$where.=" and rtime>='".date('Y-m-d', strtotime("-7 day"))."'";
			$where.=" and rtime<='".date('Y-m-d')."'";
		}
		
		$field=$_GET['type']=='isp' ? 'isp' : 'region';
		$data1=Yii::app()->db->createCommand()
			->select("DISTINCT  $field, count(*) num")
			->from('stat_data')
			->where("ghid='".gh()->ghid."' $where ")
			->group("$field")
			->order('num desc')
			->limit(10)
			->queryAll();
		$this->render('aisp', array(
			'field'=>$field, 
			'data1'=>$data1, 
			'model'=>$model, 
			'r1'=>$_GET['StatData']['rtime'][1], 
			'r2'=>$_GET['StatData']['rtime'][2]
		));
	}
	/**
	 * 当前在线，以15分钟内为在线
	 * @date: 2015-3-31
	 * @author : wintrue<328945440@qq.com>
	 */
	function actionOnline(){
		$model=new StatData('search_detail');
		$model->unsetAttributes();
		if (isset($_GET['StatData']))
			$model->attributes=$_GET['StatData'];
		$where='';
		if (!empty($_GET['StatData']['aid']))
			$where.=' and aid='.intval($_GET['StatData']['aid']);
		
		if ($_POST['dynamic']){
			$where.=" and rtime>='".date('Y-m-d H:i:s', time()-15*60)."'";
			$data1=Yii::app()->db->createCommand()
				->select('SUM(pv) as pv, SUM(cid) as cv, COUNT( DISTINCT wxid ) as uv,COUNT( DISTINCT ip ) as ip')
				->from('stat_data')
				->where("ghid='".gh()->ghid."' $where")
				->queryRow();
			foreach ($data1 as $k=>$v){
				$data1[$k]=intval($v);
			}
			echo json_encode($data1);
			exit();
		}else{
			$data1=Yii::app()->db->createCommand("SELECT SUM(pv) as pv, SUM(cid) as cv, COUNT( DISTINCT wxid ) as uv,COUNT( DISTINCT ip ) as ip from stat_data where rtime>=DATE_SUB(NOW(),INTERVAL 15*60+5*8 SECOND) and ghid='".gh()->ghid."' $where union all SELECT SUM(pv) as pv, SUM(cid) as cv, COUNT( DISTINCT wxid ) as uv,COUNT( DISTINCT ip ) as ip from stat_data where rtime>=DATE_SUB(NOW(),INTERVAL 15*60+5*7 SECOND) and ghid='".gh()->ghid."' $where union all SELECT SUM(pv) as pv, SUM(cid) as cv, COUNT( DISTINCT wxid ) as uv,COUNT( DISTINCT ip ) as ip from stat_data where rtime>=DATE_SUB(NOW(),INTERVAL 15*60+5*6 SECOND) and ghid='".gh()->ghid."' $where union all SELECT SUM(pv) as pv, SUM(cid) as cv, COUNT( DISTINCT wxid ) as uv,COUNT( DISTINCT ip ) as ip from stat_data where rtime>=DATE_SUB(NOW(),INTERVAL 15*60+5*5 SECOND) and ghid='".gh()->ghid."' $where union all SELECT SUM(pv) as pv, SUM(cid) as cv, COUNT( DISTINCT wxid ) as uv,COUNT( DISTINCT ip ) as ip from stat_data where rtime>=DATE_SUB(NOW(),INTERVAL 15*60+5*4 SECOND) and ghid='".gh()->ghid."' $where union all SELECT SUM(pv) as pv, SUM(cid) as cv, COUNT( DISTINCT wxid ) as uv,COUNT( DISTINCT ip ) as ip from stat_data where rtime>=DATE_SUB(NOW(),INTERVAL 15*60+5*3 SECOND) and ghid='".gh()->ghid."' $where union all SELECT SUM(pv) as pv, SUM(cid) as cv, COUNT( DISTINCT wxid ) as uv,COUNT( DISTINCT ip ) as ip from stat_data where rtime>=DATE_SUB(NOW(),INTERVAL 15*60+5*2 SECOND) and ghid='".gh()->ghid."' $where union all SELECT SUM(pv) as pv, SUM(cid) as cv, COUNT( DISTINCT wxid ) as uv,COUNT( DISTINCT ip ) as ip from stat_data where rtime>=DATE_SUB(NOW(),INTERVAL 15*60+5*1 SECOND) and ghid='".gh()->ghid."' $where ")
				->queryAll();
			$this->render('online', array(
				'data1'=>$data1, 
				'model'=>$model
			));
		}
	}
	/**
	 * 获取所有活动
	 * @date: 2014-12-10
	 * @author : wintrue<328945440@qq.com>
	 * @return
	 *
	 */
	function getActList(){
		$criteria=new CDbCriteria();
		// $criteria->select='id,ptype';
		$criteria->with='plugin';
		$criteria->addCondition("t.ghid='".gh()->ghid."'"); // 公众号开通的
		return Activity::model()->findAll($criteria); // $params is not needed
	}
	public function loadModel($id){
		$model=StatReport::model()->findByPk($id);
		if ($model===null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * AJAX验证
	 * @param StatReport $model
	 * 模型验证
	 */
	protected function performAjaxValidation($model){
		if (isset($_POST['ajax'])&&$_POST['ajax']==='stat-report-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
