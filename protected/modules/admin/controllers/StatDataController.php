<?php

/**
* StatDataController.php
* ----------------------------------------------
* 版权所有 2014-2015 联众互动
* ----------------------------------------------
* @date: 2015-3-24
* @author: wintrue <328945440@qq.com>
*/
class StatDataController extends BaseController{
	
	/**
	 * 统计概况
	 * @date: 2015-3-30
	 * @author : wintrue<328945440@qq.com>
	 */
	function actionProfile(){
		// Yii::app()->cache->set(gh()->ghid.'profile', null);
		$cc=Yii::app()->cache->get(gh()->ghid.'profile');
		if (empty($cc)){
			$wx_data=$data1=Yii::app()->db->createCommand()
				->select('*')
				->from('stat_wx')
				->where("ghid='".gh()->ghid."' and day>'".date('Y-m-d', strtotime("-1 day"))."' and day<'".date('Y-m-d')."'")
				->queryRow();
			// 总pv,总uv,新用户，Ip数
			$data1=Yii::app()->db->createCommand()
				->select('SUM(pv) as pv, SUM(cid) as addu, COUNT( DISTINCT wxid ) as uv,COUNT( DISTINCT ip ) as ip')
				->from('stat_data')
				->where("ghid='".gh()->ghid."' and rtime>'".date('Y-m-d', strtotime("-1 day"))."' and rtime<'".date('Y-m-d')."'")
				->queryRow();
			// 分享给朋友
			$data2=Yii::app()->db->createCommand()
				->select('count(id)')
				->from('stat_data')
				->where("ghid='".gh()->ghid."' and shareType=1 and rtime>'".date('Y-m-d', strtotime("-1 day"))."' and rtime<'".date('Y-m-d')."'")
				->queryScalar();
			// 分享到朋友圈
			$data3=Yii::app()->db->createCommand()
				->select('count(id)')
				->from('stat_data')
				->where("ghid='".gh()->ghid."'  and shareType=2  and rtime>'".date('Y-m-d', strtotime("-1 day"))."' and rtime<'".date('Y-m-d')."'")
				->queryScalar();
			$days=Yii::app()->db->createCommand()
				->select(' DATE_FORMAT(rtime,"%Y%m%d") days,SUM(pv) as pv, SUM(cid) as addu, COUNT( DISTINCT wxid ) as uv,COUNT( DISTINCT ip ) as ip')
				->from('stat_data')
				->where("ghid='".gh()->ghid."' and rtime>'".date('Y-m-d', strtotime("-7 day"))."' and rtime<'".date('Y-m-d')."'")
				->group('days')
				->queryAll();
			// 分享给朋友7
			$data4=Yii::app()->db->createCommand()
				->select(' DATE_FORMAT(rtime,"%Y%m%d") days,count(id) as id')
				->from('stat_data')
				->where("ghid='".gh()->ghid."' and shareType=1  and rtime>'".date('Y-m-d', strtotime("-7 day"))."' and rtime<'".date('Y-m-d')."'")
				->group('days')
				->queryAll();
			// 分享到朋友圈7
			$data5=Yii::app()->db->createCommand()
				->select(' DATE_FORMAT(rtime,"%Y%m%d") days,count(id) as id')
				->from('stat_data')
				->where("ghid='".gh()->ghid."' and shareType=2  and rtime>'".date('Y-m-d', strtotime("-7 day"))."' and rtime<'".date('Y-m-d')."'")
				->group('days')
				->queryAll();
			$os=Yii::app()->db->createCommand()
				->select('count(id) num,os')
				->from('stat_data')
				->where("ghid='".gh()->ghid."' and rtime>'".date('Y-m-d', strtotime("-7 day"))."' and rtime<'".date('Y-m-d')."'")
				->group('os')
				->queryAll();
			// select count(id) num,mobile from stat_data group by mobile ORDER BY num desc LIMIT 15;
			$mobile=Yii::app()->db->createCommand()
				->select('count(id) num,mobile')
				->from('stat_data')
				->where("ghid='".gh()->ghid."' and rtime>'".date('Y-m-d', strtotime("-7 day"))."' and rtime<'".date('Y-m-d')."'")
				->group('mobile')
				->order('num desc')
				->limit(15)
				->queryAll();
			// dump($os);
			$cc=array(
				'data'=>$wx_data,
				'data1'=>$data1, 
				'data2'=>$data2, 
				'data3'=>$data3, 
				'data4'=>$data4, 
				'data5'=>$data5, 
				'days'=>$days, 
				'os'=>$os, 
				'mobile'=>$mobile
			);
			Yii::app()->cache->set(gh()->ghid.'profile', $cc, 12*60*60);
		}
		$this->render('profile', $cc);
	}

	public function actionAdmin(){
		$model=new UserReg('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['UserReg']))
			$model->attributes=$_GET['UserReg'];
		
		$this->render('admin', array(
			'model'=>$model
		));
	}
	public function loadModel($id){
		$model=UserReg::model()->findByPk($id);
		if ($model===null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * AJAX验证
	 * @param UserReg $model
	 * 模型验证
	 */
	protected function performAjaxValidation($model){
		if (isset($_POST['ajax'])&&$_POST['ajax']==='user-reg-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * 计划任务， 数据报表统计
	 * @date: 2015-3-30
	 * @author : wintrue<328945440@qq.com>
	 */
	function actionTask(){
		set_time_limit(120); // 最长两分钟的执行时间
		// 统计昨天
		$d=-1;
		$t=date('Y-m-d', strtotime("$d day"));
		$t2=date('Y-m-d', strtotime(($d+1)." day"));
		// 总pv,总uv,新用户，Ip数
		$data1=Yii::app()->db->createCommand()
			->select('SUM(pv) as pv, SUM(cid) as addu, COUNT( DISTINCT wxid ) as uv,COUNT( DISTINCT ip ) as ip,aid,ghid')
			->from('stat_data')
			->where(" rtime>'".$t."' and rtime<'".$t2."'")
			->group('ghid')
			->queryAll();
		// 1分享到好友 2分享到朋友圈3分享到QQ4分享到微博
		$data2=Yii::app()->db->createCommand()
			->select('count(id) num,aid,ghid,shareType')
			->from('stat_data')
			->where("(shareType=1 or shareType=2 or shareType=3 or shareType=4)  and rtime>'".$t."' and rtime<'".$t2."'")
			->group('ghid,shareType')
			->queryAll();
		/*
		 * $os=Yii::app()->db->createCommand()
		 * ->select('count(id) num,os')
		 * ->from('stat_data')
		 * ->where("ghid='".gh()->ghid."' and rtime>'".date('Y-m-d', strtotime("-7 day"))."' and rtime<'".date('Y-m-d')."'")
		 * ->group('os')
		 * ->queryAll();
		 * // select count(id) num,mobile from stat_data group by mobile ORDER BY num desc LIMIT 15;
		 * $mobile=Yii::app()->db->createCommand()
		 * ->select('count(id) num,mobile')
		 * ->from('stat_data')
		 * ->where("ghid='".gh()->ghid."' and rtime>'".date('Y-m-d', strtotime("-7 day"))."' and rtime<'".date('Y-m-d')."'")
		 * ->group('mobile')
		 * ->order('num desc')
		 * ->limit(15)
		 * ->queryAll();
		 * // dump($os);
		 */
		foreach ($data1 as $k=>$v){
			$m=StatReport::model()->findByAttributes(array(
				'aid'=>$v['aid'], 
				'ghid'=>$v['ghid'], 
				'day'=>$t
			));
			if (empty($m)){
				$model=new StatReport();
				$model->day=$t;
				$model->aid=$v['aid'];
				$model->ghid=$v['ghid'];
				$model->pv=$v['pv'];
				$model->uv=$v['uv'];
				$model->cv=$v['addu'];
				$model->ip=$v['ip'];
				$model->save();
				
			}
		}
		foreach ($data2 as $kk=>$vv){
			$m=StatReport::model()->findByAttributes(array(
				'aid'=>$vv['aid'], 
				'ghid'=>$vv['ghid'], 
				'day'=>$t
			));
			if (empty($m)){
				$model=new StatReport();
				$model->day=$t;
				$model->aid=$vv['aid'];
				$model->ghid=$vv['ghid'];
				$st='s'.$vv['shareType'];
				$model->$st=$vv['num'];
				$model->save();
			}else{
				$st='s'.$vv['shareType'];
				$m->$st=$vv['num'];
				$m->save();
			}
		}
	}
}