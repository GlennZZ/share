<?php

/**
* MemberController.php 个人中心模块
* ----------------------------------------------
* 版权所有 2014-2015 联众互动
* ----------------------------------------------
* @date: 2015-6-8
* @author: wintrue <328945440@qq.com>
*/
class MemberController extends WapBController{
	function init(){
		parent::init();
		$this->userinfo=SysMember::model()->findByAttributes(array(
			'openid'=>$this->userinfo['openid']
		));
	}
	public function actionIndex(){
		$this->pageTitle="用户中心";
		$money=Yii::app()->db->createCommand("select sum(money) from sys_wxredpack_record where  statue=1 and re_openid='".$this->userinfo['openid']."'")->queryScalar();
		$this->render('index', array(
			'model'=>SysMember::model()->findByAttributes(array(
				'openid'=>$this->userinfo['openid']
			)
			), 
			'money'=>intval($money)
		));
	}
	function actionMyinfo(){
		$this->pageTitle="个人信息";
		$this->render('myinfo');
	}
	
	/**
	 * 信息提交
	 * @date: 2015-6-1
	 * @author : wintrue<328945440@qq.com>
	 */
	function actionInsert(){
		$username=htmlspecialchars($_POST['userName']);
		$phone=htmlspecialchars($_POST['userPhone']);
		$addr=htmlspecialchars($_POST['otherInfo']);
		if (empty($username)||empty($phone)||empty($phone)){
			exit(json_encode(array(
				'result_code'=>-1, 
				'result_msg'=>'请填写完成的信息'
			)));
		}
		$model=SysMember::model()->findByAttributes(array(
			'openid'=>$this->userinfo['openid']
		));
		$model->username=$username;
		$model->phone=$phone;
		$model->addr=$addr;
		$model->iscompleteinfo=1;
		if ($model->save()!==false){
			exit(json_encode(array(
				'result_code'=>1, 
				'result_msg'=>'操作成功！'
			)));
		}else{
			exit(json_encode(array(
				'result_code'=>-1, 
				'result_msg'=>'操作失败'
			)));
		}
	}
	
	/**
	 * 手机号注册
	 * @date: 2016-5-6
	 * @author : wintrue<328945440@qq.com>
	 */
	function actionRegester(){
		$this->pageTitle="注册";
		
		if (isset($_GET['get_code'])){
			if (!empty(SysMember::model()->findByAttributes(array(
				'phone'=>$_POST['phone']
			)))){
				exit(json_encode(array(
					'result_data'=>'', 
					'result_code'=>0, 
					'result_msg'=>'该手机号已经被注册了,请更换一个！'
				)));
			}
			$code=getRandKey(6, '', '01');
			// $code=110;
			$result=sendUserBindCode($_POST['phone'], "您的短信验证码是$code,5分钟内有效，如非本人操作，请立即登录修改密码.本条短信免费。", 60, $this->userinfo['openid']);
			// if(!Yii::app()->cache->get('_phone_check_'.$cache_key)){
			if (is_array($result)){
				exit(json_encode(array(
					'result_data'=>'', 
					'result_code'=>0, 
					'result_msg'=>'请'.$result['time'].'秒后再发送！'
				)));
			}else{
				if (!$result)
					exit(json_encode(array(
						'result_data'=>'', 
						'result_code'=>0, 
						'result_msg'=>'短信发送失败，请确认填写的手机号码是否正解！'
					)));
			}
			Yii::app()->cache->set('phone_checkimg'.$this->userinfo['openid'], array(
				$code, 
				$_POST['phone']
			), 60*5);
			exit(json_encode(array(
				'result_data'=>'', 
				'result_code'=>1, 
				'result_msg'=>'发送成功'
			)));
		}
		if (isset($_POST['code_check'])){
			if (empty($_POST['phone']))
				exit(json_encode(array(
					'result_data'=>'', 
					'result_code'=>0, 
					'result_msg'=>'请填写手机号码！'
				)));
			if (empty($_POST['code']))
				exit(json_encode(array(
					'result_data'=>'', 
					'result_code'=>0, 
					'result_msg'=>'请填写验证码！'
				)));
			$imgcode=Yii::app()->cache->get('phone_checkimg'.$this->userinfo['openid']);
			if (empty($imgcode))
				exit(json_encode(array(
					'result_data'=>'', 
					'result_code'=>0, 
					'result_msg'=>'验证码已经失效'
				)));
			if ($_POST['code']!=$imgcode[0]||$_POST['phone']!=$imgcode[1])
				exit(json_encode(array(
					'result_data'=>'', 
					'result_code'=>0, 
					'result_msg'=>'验证码不正确'
				)));
			$post['phone']=$_POST['phone'];
			if (!empty(SysMember::model()->findByAttributes(array(
				'phone'=>$_POST['phone']
			)))){
				exit(json_encode(array(
					'result_data'=>'', 
					'result_code'=>0, 
					'result_msg'=>'该手机号已经被注册了,请更换一个！'
				)));
			}
			$model=SysMember::model()->findByAttributes(array(
				'openid'=>$this->userinfo['openid']
			));
			$model->phone=$_POST['phone'];
			if ($model->save()){
				exit(json_encode(array(
					'result_data'=>'', 
					'result_code'=>1, 
					'result_msg'=>'注册成功！'
				)));
			}else{
				exit(json_encode(array(
					'result_data'=>'', 
					'result_code'=>0, 
					'result_msg'=>'注册失败请稍后 再试！'
				)));
			}
		}
		$this->render('regester', array(
			'user'=>SysMember::model()->findByAttributes(array(
				'openid'=>$this->userinfo['openid']
			))
		));
	}
	function actionAbout(){
		$this->pageTitle="关于我们";
		$this->render('about');
	}
	function actionScoreRules(){
		$this->pageTitle="积分提现规则";
		$this->render('scoreRules', array(
			'setting'=>get_websetup(true)
		));
	}
	function actionMyfavor(){
		$this->pageTitle="收藏活动";
		if ($this->isAjax()){
			$limit=10;
			$conut=Yii::app()->db->createCommand("select count(*) from sys_member_collect,app_game where sys_member_collect.aid=app_game.id and sys_member_collect.openid='".$this->userinfo['openid']."'")->queryScalar();
			$_GET['page']=intval($_POST['page']);
			$pages=$this->setPage($conut, $limit);
			$total_page_nums=$pages->pageCount;
			$list=Yii::app()->db->createCommand()
				->select("sys_member_collect.id,sys_member_collect.aid,app_game.unid,app_game.integral,app_game.name,app_game.icon,app_game.start_tm,app_game.stop_tm")
				->from('sys_member_collect,app_game')
				->where("sys_member_collect.aid=app_game.id and sys_member_collect.openid='".$this->userinfo['openid']."'")
				->order('sys_member_collect.ctm ASC')
				->limit($pages->pageSize)
				->offset($pages->currentPage*$pages->pageSize)
				->queryAll();
			foreach ($list as $k=>$v){
				$v['uname']=AppUni::model()->findByPk($v['unid'])->name;
				if (strtotime($v['start_tm'])<=time()&&strtotime($v['stop_tm'])>=time()){
					$v['status']=1; // '进行中';
				}else 
					if (strtotime($v['start_tm'])>time()){
						$v['status']=2; // '未开始';
					}else{
						
						$v['status']=3; // '已结束';
					}
				$v['start_tm']=date('Y/m/d', strtotime($v['start_tm']));
				$v['stop_tm']=date('Y/m/d', strtotime($v['stop_tm']));
				
				$list[$k]=$v;
			}
			echo json_encode(array(
				'result_code'=>1, 
				'gameList'=>$list, 
				'allPage'=>$total_page_nums
			));
			exit();
		}
		$this->render('myfavor');
	}
	function actionWithdrawRecord(){
		$this->pageTitle="提现记录";
		if ($this->isAjax()){
			$limit=10;
			$conut=Yii::app()->db->createCommand("select count(*) from sys_wxredpack_record,sys_member where sys_wxredpack_record.re_openid=sys_member.openid  and sys_wxredpack_record.statue=1 and sys_wxredpack_record.re_openid='".$this->userinfo['openid']."'")->queryScalar();
			$_GET['page']=intval($_POST['page']);
			$pages=$this->setPage($conut, $limit);
			$total_page_nums=$pages->pageCount;
			$list=Yii::app()->db->createCommand()
				->select("sys_wxredpack_record.id,sys_wxredpack_record.money,sys_wxredpack_record.ctm,sys_member.openid,sys_member.nickname,sys_member.headimgurl")
				->from('sys_wxredpack_record,sys_member')
				->where("sys_wxredpack_record.re_openid=sys_member.openid  and sys_wxredpack_record.statue=1 and sys_wxredpack_record.re_openid='".$this->userinfo['openid']."'")
				->order('sys_wxredpack_record.ctm desc')
				->limit($pages->pageSize)
				->offset($pages->currentPage*$pages->pageSize)
				->queryAll();
			foreach ($list as $k=>$v){
				$v['ctm']=date('Y/m/d', strtotime($v['ctm']));
				$v['money']=$v['money']/100;
				$list[$k]=$v;
			}
			echo json_encode(array(
				'result_code'=>1, 
				'gameList'=>$list, 
				'allPage'=>$total_page_nums
			));
			exit();
		}
		$this->render('withdrawRecord');
	}
	function actionMyshare(){
		$this->pageTitle="我的分享";
		if ($this->isAjax()){
			$limit=10;
			$conut=Yii::app()->db->createCommand("select count(*) from sys_member_share,app_game where sys_member_share.aid=app_game.id and sys_member_share.openid='".$this->userinfo['openid']."'")->queryScalar();
			$_GET['page']=intval($_POST['page']);
			$pages=$this->setPage($conut, $limit);
			$total_page_nums=$pages->pageCount;
			$list=Yii::app()->db->createCommand()
				->select("sys_member_share.id,sys_member_share.aid,sys_member_share.integral,app_game.unid,app_game.name,app_game.icon,app_game.start_tm,app_game.stop_tm")
				->from('sys_member_share,app_game')
				->where("sys_member_share.aid=app_game.id and sys_member_share.openid='".$this->userinfo['openid']."'")
				->order('sys_member_share.ctm ASC')
				->limit($pages->pageSize)
				->offset($pages->currentPage*$pages->pageSize)
				->queryAll();
			foreach ($list as $k=>$v){
				$v['uname']=AppUni::model()->findByPk($v['unid'])->name;
				if (strtotime($v['start_tm'])<=time()&&strtotime($v['stop_tm'])>=time()){
					$v['status']=1; // '进行中';
				}else 
					if (strtotime($v['start_tm'])>time()){
						$v['status']=2; // '未开始';
					}else{
						
						$v['status']=3; // '已结束';
					}
				$v['start_tm']=date('Y/m/d', strtotime($v['start_tm']));
				$v['stop_tm']=date('Y/m/d', strtotime($v['stop_tm']));
				
				$list[$k]=$v;
			}
			echo json_encode(array(
				'result_code'=>1, 
				'gameList'=>$list, 
				'allPage'=>$total_page_nums
			));
			exit();
		}
		$this->render('myshare');
	}
	function actionMyshareDetail(){
		$this->pageTitle="我的分享详细";
		$id=intval($_GET['id']);
		$model=SysMemberShare::model()->findByAttributes(array(
			'id'=>$id, 
			'openid'=>$this->userinfo['openid']
		));
		if (empty($model))
			exit();
		$game=AppGame::model()->findByPk($model->aid);
		if (empty($game))
			$this->error('活动已经删除！');
		$count_integral=Yii::app()->db->createCommand("select sum(integral) from sys_member_record where openid='".$this->userinfo['openid']."' and type=2 and aid=".$model->aid)->queryScalar();
		$this->render('myshareDetail', array(
			'count_integral'=>$count_integral, 
			'model'=>$model, 
			'game'=>$game, 
			/*'record'=>SysMemberRecord::model()->findAllByAttributes(array(
				'aid'=>$model->aid, 
				'openid'=>$this->userinfo['openid'], 
				'type'=>2
			))*/
		));
	}
	/**
	 * 获取我的分享下好友帮点击获得积分的列表
	 * @date: 2016-5-12
	 * @author : wintrue<328945440@qq.com>
	 */
	function actionMyshareRecodList(){
		if ($this->isAjax()){
			$limit=10;
			$aid=intval($_POST['id']);
			// echo "select count(*) from sys_member_record where aid=$aid and type=2 and openid='".$this->userinfo['openid']."'";exit;
			$conut=Yii::app()->db->createCommand("select count(*) from sys_member_record where aid=$aid and type=2 and openid='".$this->userinfo['openid']."'")->queryScalar();
			$_GET['page']=intval($_POST['page']);
			$pages=$this->setPage($conut, $limit);
			$total_page_nums=$pages->pageCount;
			$list=Yii::app()->db->createCommand()
				->select("integral,fnickname,fheadimgurl,ctm")
				->from('sys_member_record')
				->where("aid=$aid and type=2 and openid='".$this->userinfo['openid']."'")
				->order('ctm ASC')
				->limit($pages->pageSize)
				->offset($pages->currentPage*$pages->pageSize)
				->queryAll();
			echo json_encode(array(
				'result_code'=>1, 
				'gameList'=>$list, 
				'allPage'=>$total_page_nums
			));
			exit();
		}
	}
	function actionWithdraw(){
		$this->pageTitle="提现";
		$setting=get_websetup(true);
		if ($this->isAjax()){
			$user=SysMember::model()->findByAttributes(array('openid'=>$this->userinfo['openid']));
			if(empty($user->phone)){
				$this->ajax_return('请先注册成为会员，才能提现哦！',-3);
			}
			$money=$_POST['num'];
			if (empty($money))
				$this->ajax_return('请输入提现金额！', -2);
			if ((int) $money!=$money)
				$this->ajax_return('提现金额必须为整数！', -2);
			$money=intval($_POST['num']);
			if ($money>200)
				$this->ajax_return('每次提现金额不能大于200！', -2);
			if (!$this->checkSubscribe()){
				$this->ajax_return('请先关注1杯公众号', -1);
			}
			if (Yii::app()->cache->get($this->userinfo['openid'].'_redpack_do')){
				$this->ajax_return('1分内只能提现一次，请稍后再操作！', -2);
			}
			$conut=Yii::app()->db->createCommand("select count(*) from sys_wxredpack_record,sys_member where sys_wxredpack_record.re_openid=sys_member.openid  and sys_wxredpack_record.statue=1 and sys_wxredpack_record.re_openid='".$this->userinfo['openid']."'")->queryScalar();
			$user=SysMember::model()->findByAttributes(array(
				'openid'=>$this->userinfo['openid']
			));
			if ($conut<=0){
				// 首次
				if ($user->integral<$setting['frist_integral']){
					$this->ajax_return('首次提现需要积分大于'.$setting['frist_integral'].'才可提现哦', -2);
				}
			}else{
				// 非首次
				if ($user->integral<$setting['custom_ntegral']){
					$this->ajax_return('积分需要大于'.$setting['custom_ntegral'].'才可提现哦', -2);
				}
			}
			$take_integral=$money/$setting['rule_integral']; // 积分需要消耗的积分
			if ($user->integral<$take_integral){
				$this->ajax_return('您的积分不足,提现'.$money.'元需要消耗'.$take_integral."积分", -2);
			}
			updateMyIntegral(-$take_integral, $this->userinfo['openid'], '提现消耗积分');
			try{
				$result=sendRed($this->userinfo['openid'], $money);
				if ($result){
					Yii::app()->cache->set($this->userinfo['openid'].'_redpack_do', time(), 2);
					$this->ajax_return("提现成功,$money元现金红包已经通过1杯公众号发放给您，请及时领取。", 1);
				}else{
					updateMyIntegral($take_integral, $this->userinfo['openid'], '提现未完成，返回积分');
					$this->ajax_return('提现失败，请稍后再试哦', -2);
				}
			}catch (Exception $e){
				updateMyIntegral($take_integral, $this->userinfo['openid'], '提现未完成，返回积分');
				$this->ajax_return('提现失败，请稍后再试哦', -2);
			}
		}
		
		$this->render('withdraw', array(
			'user'=>SysMember::model()->findByAttributes(array(
				'openid'=>$this->userinfo['openid']
			)), 
			'setting'=>$setting
		));
	}
	function isAjax(){
		return isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH']==='XMLHttpRequest';
	}
	function setPage($count, $pageSize){
		$criteria=new CDbCriteria();
		$pages=new CPagination($count);
		$pages->pageSize=$pageSize;
		$pages->applylimit($criteria);
		return $pages;
	}
	/**
	 * 判断是否关注，对file_get_contents进行超时限定为5秒，超时3次则提示访问接口超时
	 * @date: 2014-9-16
	 * @author : wintrue<328945440@qq.com>
	 */
	function checkSubscribe(){
		$opts=array(
			'http'=>array(
				'method'=>"GET", 
				'timeout'=>5
			) // 单位秒

		);
		$cnt=0;
		// 从公众号表中读取类型
		while ($cnt<3&&($result=@file_get_contents('http://openapi.i-lz.cn/oauth2/authorize/CheckSubscribe?openid='.$this->userinfo['openid'].'&ghid=gh_48b3246a7bb7', false, stream_context_create($opts)))===FALSE){
			$cnt++;
		}
		if ($result===FALSE){
			return 1;
			// $this->log('关注接口访问超时');
			// $this->error('关注接口访问超时,请重新进入应用！',Yii::app ()->request->hostInfo . $this->createUrl ( $_GET ['_akey']));
		}else{
			return intval($result);
		}
	}
}