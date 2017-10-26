<?php

class DefaultController extends WapBController{
	public function actionIndex(){
		$this->pageTitle="首页";
		$this->render('index', array(
			'tenant'=>AppUni::model()->findAll(),
			)
		);
	}

	public function actionView($id){
		$this->pageTitle='活动详情';
		$model=$this->loadModel($id);
		$config=get_websetup_config();
		$desc=$config['share_desc'];
		$desc=str_replace(array("{商家}","{活动标题}","{获得积分}"), array(AppUni::model()->findByPk($model->unid)->name,$model->name,$model->integral_self), $desc);
		$this->render('view', array(
			'model'=>$model,
			'desc'=>$desc
		));
	}
	public function loadModel($id){
		$model=AppGame::model()->findByPk($id);
		if ($model===null)
			throw new CHttpException(404, 'The requested page does not exist.');
		$model->clicks=$model->clicks+1;
		$model->save();
		return $model;
	}

	/**
	 * 全部活动
	 * @date: 2015-5-28
	 * @author : wintrue<328945440@qq.com>
	 */
	function actionGetList(){
		$page=intval($_POST['page']);
		$type=intval($_POST['type']);
		$data=$this->getAlllist($page,$type);
	}
	function actionSearch2(){
		$name=$_POST['name'];
		$data=Yii::app ()->db->createCommand("select * from app_uni where name like '%$name%' limit 15")->queryAll();
		$this->ajax_return('ok',1,array('list'=>$data));
	}
	/**
	 * 搜索数据
	 * @date: 2016-5-10
	 * @author: wintrue<328945440@qq.com>
	 * @param number $page
	 * @return multitype:
	 */
	function actionSearch($page=1){
		$_GET['AppGame_page']=$page;
		$criteria=new CDbCriteria;
		//$criteria->compare('category',1);
		//$criteria->select='id,name,icon,url,clicks,utm,classify_text';
		//$criteria->addCondition("start_tm<'".date('Y-m-d H:i:s')."' and (stop_tm>'".date('Y-m-d H:i:s')."' or stop_tm is null or stop_tm='')");
		$criteria->order='ctm desc';
		//$criteria->addCondition('');
		//$criteria->compare('unid', $_POST['id']);
		//$criteria->select='id,name,icon,url,utm,clicks';
		$criteria->limit=8;
		$criteria->condition="unid=".intval($_POST['id'])." and (stop_tm is null or stop_tm>'".date('Y-m-d H:i:s')."') and start_tm<='".date('Y-m-d H:i:s')."'";
		//dump($criteria);exit;
		$m=new CActiveDataProvider(new AppGame(), array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>8
			),
			'sort'=>array(
				'defaultOrder'=>'ctm desc',
			),
		));
		$data=$m->data;
		$pageCount=$m->getPagination()->pageCount;
		if ($page>$pageCount){
			echo json_encode(array(
				'result_code'=>1,
				'gameList'=>'',
				'allPage'=>0
			));
			exit();
		}else{
			foreach ($data as $k=>$v){
				unset($tmp);
				$tmp=$v->attributes;
				foreach ($tmp as $kkk=>$vvv){
					if (in_array($kkk, array(
						'id',
						'name',
						'icon',
						//'url',
						'utm',
						'clicks',
						'integral_share',
						'note',
						'start_tm',
						'stop_tm',
					))){
						if ($kkk=='utm'){
							$vvv=time_format($vvv);
						}
						if ($kkk=='start_tm'){
							$vvv=date('Y/m/d',strtotime($vvv));
						}
						if ($kkk=='stop_tm'){
						if(empty($vvv)){$vvv='不限';}else{$vvv=date('Y/m/d',strtotime($vvv));}
						}
						$tmp2[$kkk]=$vvv;
					}
				}
				if (time()-strtotime($tmp['utm'])<24*60*60){
					$tmp2['new']=1;
				}

				$tmp2['tenant']=AppUni::model()->findByPk($tmp['unid'])->name;
				if(SysMemberCollect::model()->findByAttributes(array('aid'=>$tmp['id'],'openid'=>$this->userinfo['openid']))){
				$tmp2['collect']=1;}else{$tmp2['collect']=0;}
				$ndata[$k]=$tmp2;
				unset($tmp2);
			}

			//dump($ndata);exit;
			echo json_encode(array(
				'result_code'=>1,
				'gameList'=>$ndata,
				'allPage'=>$pageCount
			));
			exit();
		}
	}
	/**
	 * 列表数据
	 * @date: 2016-5-10
	 * @author: wintrue<328945440@qq.com>
	 * @param number $page
	 * @param number $type
	 * @return multitype:
	 */
	function getAlllist($page=1,$type=1){
		$_GET['AppGame_page']=$page;
		$criteria=new CDbCriteria;
		//$criteria->compare('category',1);
		//$criteria->select='id,name,icon,url,clicks,utm,classify_text';
		//$criteria->addCondition("start_tm<'".date('Y-m-d H:i:s')."' and (stop_tm>'".date('Y-m-d H:i:s')."' or stop_tm is null or stop_tm='')");
		$criteria->limit=8;
		switch ($type){
			case 1:
				$criteria->order='ctm desc';
				break;
			case 2:
				$criteria->order='clicks desc';
				break;
			case 3:
				$criteria->order='promote desc';
				break;
		}
			$criteria->condition="(stop_tm is null or stop_tm>'".date('Y-m-d H:i:s')."') and start_tm<='".date('Y-m-d H:i:s')."'";
		
		$m=new CActiveDataProvider(new AppGame(), array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>8
			),
			'sort'=>array(
				'defaultOrder'=>'ctm desc',
			),
		));
		$data=$m->data;
		$pageCount=$m->getPagination()->pageCount;
		if ($page>$pageCount){
			echo json_encode(array(
				'result_code'=>1,
				'gameList'=>'',
				'allPage'=>0
			));
			exit();
		}else{
			foreach ($data as $k=>$v){
				unset($tmp);
				$tmp=$v->attributes;
				foreach ($tmp as $kkk=>$vvv){
					if (in_array($kkk, array(
						'id',
						'name',
						'icon',
						//'url',
						'utm',
						'clicks',
						'integral_share',
						'note',
						'start_tm',
						'stop_tm',
					))){
						if ($kkk=='utm'){
							$vvv=time_format($vvv);
						}
						if ($kkk=='start_tm'){
							$vvv=date('Y/m/d',strtotime($vvv));
						}
						if ($kkk=='stop_tm'){
							if(empty($vvv)){$vvv='不限';}else{$vvv=date('Y/m/d',strtotime($vvv));}
						}
						$tmp2[$kkk]=$vvv;
					}
				}
				if (time()-strtotime($tmp['utm'])<24*60*60){
					$tmp2['new']=1;
				}

				$tmp2['tenant']=AppUni::model()->findByPk($tmp['unid'])->name;
				if(SysMemberCollect::model()->findByAttributes(array('aid'=>$tmp['id'],'openid'=>$this->userinfo['openid']))){
				$tmp2['collect']=1;}else{$tmp2['collect']=0;}
				$ndata[$k]=$tmp2;
				unset($tmp2);
			}

			//dump($ndata);exit;
			echo json_encode(array(
				'result_code'=>1,
				'gameList'=>$ndata,
				'allPage'=>$pageCount
			));
			exit();
		}
	}
	/**
	 * 添加 收藏
	 * @date: 2016-5-10
	 * @author: wintrue<328945440@qq.com>
	 */
	function actionAdd_collect(){
		$id=intval($_POST['id']);
		$row=SysMemberCollect::model()->findByAttributes(array('aid'=>$id,'openid'=>$this->userinfo['openid']));
		if(!empty($row)){
			if(SysMemberCollect::model()->deleteByPk($row->id)){
				$this->ajax_return('取消收藏成功');
			}else{
				$this->ajax_return('操作失败,请稍后重试',-1);
			}
		}
		$model=new SysMemberCollect();
		$model->aid=$id;
		$model->openid=$this->userinfo['openid'];
		$model->uid=0;
		if($model->save()){$this->ajax_return('收藏成功！');}else{$this->ajax_return('收藏失败，请稍后 再试！',-1);}
	}
	/**
	 * 跳转扣积分
	 * @date: 2016-5-26
	 * @author: wintrue<328945440@qq.com>
	 */
	function actionJump(){
		$id=intval($_GET['id']);
		$from_id=$_GET['_from'];
		$row=AppGame::model()->findByPk($id);
		//活动不存在
		if(empty($row))$this->error('活动不存在');
		$row->share_clicks=intval($row->share_clicks)+1;
		$row->save();
		$integral=Yii::app ()->db->createCommand("select sum(integral) from sys_member_record where aid=$id and openid='$from_id'")->queryScalar();
		$integral=intval($integral);//分享的用户当前活动的总积分
		$webconfig=get_websetup_config();
		$u=SysMember::model()->findByAttributes(array('openid'=>$from_id));
		//dump($integral);exit;
		
		if(!empty($u)){
			if(strtotime($row->stop_tm)<time()){
				//$this->error('活动下架啦！11');
				//exit('1');
				$this->renderInternal(Yii::getPathOfAlias ( 'webroot.themes.mobile.views.default' ).'/tip.php',array(
					'msg'=>'该商户活动推广已结束',
					'user'=>$u,
					'msg2'=>"在本次活动推广已获得".$integral."积分",
					'webconfig'=>$webconfig
				));
				exit;
			}
			if($row->integral-$row->integral_share<0){
				//exit('2');
				//商家积分用完,直接显示活动结束
				//header("Location: http://share.i-lz.cn");
				$this->renderInternal(Yii::getPathOfAlias ( 'webroot.themes.mobile.views.default' ).'/tip.php',array(
				'msg'=>'该商户活动推广已结束',
				'user'=>$u,
				'msg2'=>"在本次活动推广已获得".$integral."积分",
				'webconfig'=>$webconfig
				));
				exit;
					
			}
			//单个用户有积分限制
			if(intval($row->integral_limit>0)){
				if($integral>=$row->integral_limit){
					//单个用户积分达上限
					//在本次活动推广已获得XXX积分
					//header("Location: http://share.i-lz.cn");
					//exit('3');
					$this->renderInternal(Yii::getPathOfAlias ( 'webroot.themes.mobile.views.default' ).'/tip.php',array(
						'msg'=>'',
						'user'=>$u,
						'url'=>$row->url,
						'msg2'=>"在本次活动推广已获得".$integral."积分",
						'webconfig'=>$webconfig
					));
					exit;
				}
			}
			//是否已经帮该好友点击过
			$recordRow=Yii::app ()->db->createCommand("select * from sys_member_record where type=2 and aid=$id and openid='$from_id' and fopenid='".$this->userinfo['openid']."'")->queryRow();
			if(!empty($recordRow)){
				//已经帮忙点击过
				//exit('4');
				$this->renderInternal(Yii::getPathOfAlias ( 'webroot.themes.mobile.views.default' ).'/tip.php',array(
						'msg'=>'',
						'user'=>$u,
						'url'=>$row->url,
						'msg2'=>"获得本次活动推广积分".$row->integral_share."积分",
						'msg3'=>'正在跳转至活动..',
						'msg4'=>'您已帮',
						'webconfig'=>$webconfig
					));
				exit;
			}
			$code=updateIntegral(0, $id,2);//用户点击，扣活动投放积分
			//积分花完了
			if($code==2)$this->error('活动积分已经花完啦！');
			updateMyIntegral($row->integral_share, $from_id,'好友点击分享链接获得',$row->id,2,$this->userinfo['openid']);
		}else {
			//分享用户不存在
			//exit;
			//header("Location: http://share.i-lz.cn");
			$this->error('分享用户不存在!');
			
		}
		$this->renderPartial('jump', array(
			'model'=>$row,
			'user'=>$u,
			'webconfig'=>$webconfig
		));
		//header("Location: ".$row['url']);

	}
	function actionShare(){
		$id=intval($_POST['id']);
		$app_game=AppGame::model()->findByPk($id);
		if(empty($app_game))exit;
		$app_game->share_num=intval($app_game->share_num)+1;
		$app_game->save();
		$user=SysMember::model()->findByAttributes(array('openid'=>$this->userinfo['openid']));
		if(empty($user->phone)){
			$this->ajax_return('请先注册成为会员，才能提现哦！',-2);
		}
		$row=SysMemberShare::model()->findByAttributes(array('aid'=>$id,'openid'=>$this->userinfo['openid']));
		if(!empty($row)){
			$this->ajax_return('分享成功！',1,array('frist'=>0));
		}else{
			$model=new SysMemberShare();
			$model->aid=$id;
			$model->openid=$this->userinfo['openid'];
			$model->uid=0;
			if($model->save()){
				$code=updateIntegral(-$app_game->integral_self,$app_game->id);
				if($code==2)$this->ajax_return('您首次分享,但积分不足了！',-1);
				updateMyIntegral($app_game->integral_self, $this->userinfo['openid'],'首次分享获得积分',$app_game->id);
				$this->ajax_return('您首次分享，获得'.$app_game->integral_self.'积分！',1,array('frist'=>1));
			}else{
				$this->ajax_return('验证失败，请稍后 再试！',-1);
			}
		}
	}
	
}