<?php

/**
 * This is the model class for table "app_game".
 *
 * The followings are the available columns in table 'app_game':
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property string $icon
 * @property string $url
 * @property integer $classify
 * @property integer $area
 * @property string $company
 * @property string $prize_name
 * @property integer $category
 * @property integer $type
 * @property integer $posid
 * @property integer $clicks
 * @property integer $participation_num
 * @property integer $participation_num_t
 * @property integer $share_num
 * @property integer $share_num_t
 * @property double $share_proportion
 * @property double $share_proportion_t
 * @property string $start_tm
 * @property string $stop_tm
 * @property string $ctm
 * @property string $utm
 */
class AppGame extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'app_game';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, start_tm,unid,stop_tm', 'required'),
			array('classify,promote, area, category, type, clicks, participation_num, participation_num_t, share_num, share_num_t,integral_all,integral,integral_self,integral_share,integral_limit,share_clicks', 'numerical', 'integerOnly'=>true),
			array('share_proportion, share_proportion_t', 'numerical'),
			array('name', 'length', 'max'=>100),
			array('icon,note', 'length', 'max'=>200),
			array('classify_text', 'length', 'max'=>25),
			array('posid', 'length', 'max'=>50),
			array('url, company', 'length', 'max'=>150),
			array('prize_name', 'length', 'max'=>50),
			array('desc,desc1, stop_tm', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, desc, icon, url, classify, area, company, prize_name,  category, type, posid, clicks, participation_num, participation_num_t, share_num, share_num_t, share_proportion, share_proportion_t, start_tm, stop_tm, ctm, utm', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'addr'=>array(self::HAS_ONE,'DsArea',array('id'=>'area'),'select'=>'title')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'unid' => '所属商户',//关联app_uni表的id
			'name' => '活动名称',
			'note'=>'活动简述',
			'desc' => '活动说明',
			'desc1' => '奖品说明',
			'icon' => '图标',
			'url' => '活动链接',
			'classify' => '分类 ',//0默认1首发2推荐3热度4开服5精品
			'promote'=>'推荐值',
			'classify_text'=>'分类描述',
			'area' => '地区',
			'company' => '主办单位',
			'prize_name' => '奖品名称',
			'category' => '类别',//1互动游戏2商家游戏3竞赛游戏
			'type' => '游戏类型',
			'posid' => '推荐位',
			'clicks' => '平台点击数',
			'participation_num' => '显示参与人数',
			'participation_num_t' => '真实参与人数',
			'share_num' => '活动分享数',
			'share_num_t' => '真实分享人数',
			'share_proportion' => '显示转发率',
			'share_proportion_t' => '转发率',
			'start_tm' => '上线时间',
			'stop_tm' => '下线时间',//，留空刚永久显示
			'ctm' => '创建时间',
			'utm' => '更新时间',
			'integral_self'=>'分享后可获得积分',
			'integral'=>'当前剩余积分',
			'integral_all'=>'投放总积分',
			'integral_share'=>'好友帮忙点击后获得积分',
			'integral_limit'=>'单个用户积分上限',
			'share_clicks'=>'活动点击数'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$category=intval($_GET['category']);
		$category?$category=1:$category;

		$criteria->compare('name',$this->name,true);
		$criteria->compare('classify',$this->classify);
		$criteria->compare('area',$this->area);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('prize_name',$this->prize_name,true);

		$criteria->compare('category',intval($_GET['category']));
		$criteria->compare('type',$this->type);
		$criteria->compare('posid',$this->posid);
		$criteria->compare('clicks',$this->clicks);
		$criteria->compare('participation_num',$this->participation_num);
		$criteria->compare('participation_num_t',$this->participation_num_t);
		$criteria->compare('share_num',$this->share_num);
		$criteria->compare('share_num_t',$this->share_num_t);
		$criteria->compare('share_proportion',$this->share_proportion);
		$criteria->compare('share_proportion_t',$this->share_proportion_t);
		$criteria->compare('start_tm',$this->start_tm,true);
		$criteria->compare('stop_tm',$this->stop_tm,true);
		$criteria->compare('ctm',$this->ctm,true);
		$criteria->compare('utm',$this->utm,true);
		$criteria->compare('unid',$this->unid);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>15
			),
			'sort'=>array(
				'defaultOrder'=>'ctm desc',
			),
		));
	}
	/**
	 * 全部互动游戏
	 * @date: 2015-6-1
	 * @author: wintrue<328945440@qq.com>
	 * @param number $pageSize
	 * @return CActiveDataProvider
	 */
	function getAlllist($pageSize=15){
		$criteria=new CDbCriteria;
		$criteria->compare('category',1);
		$criteria->select='id,name,icon,url,clicks,utm,classify_text';
		$criteria->addCondition("start_tm<'".date('Y-m-d H:i:s')."' and (stop_tm>'".date('Y-m-d H:i:s')."' or stop_tm is null or stop_tm='')");
		$criteria->order='utm desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>$pageSize
			),
		));
	}
	/**
	 * 24小时热度,也就是总的热度 互动游戏
	 * @date: 2015-5-28
	 * @author: wintrue<328945440@qq.com>
	 * @param number $pageSize
	 * @return CActiveDataProvider
	 */
	function getHot24($pageSize=10){
		$criteria=new CDbCriteria;
		$criteria->compare('category',1);
		$criteria->select='id,name,icon,url,clicks,utm,yesterday_clicks,share_proportion,classify,classify_text';
		$criteria->addCondition("start_tm<'".date('Y-m-d H:i:s')."' and (stop_tm>'".date('Y-m-d H:i:s')."' or stop_tm is null or stop_tm='')");
		$criteria->order='classify desc,clicks desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>$pageSize
			),
		));
	}
	/**
	 * 本月热度 互动游戏 按添加时间
	 * @date: 2015-5-28
	 * @author: wintrue<328945440@qq.com>
	 * @return CActiveDataProvider
	 */
	function getHotm($pageSize=10){
		$criteria=new CDbCriteria;
		$criteria->compare('category',1);
		$criteria->select='id,name,icon,url,clicks,utm,lmonth_clicks,share_proportion';
		$criteria->addCondition("start_tm<'".date('Y-m-d H:i:s')."' and (stop_tm>'".date('Y-m-d H:i:s')."' or stop_tm is null or stop_tm='') and ctm>'".date('Y-m-d',strtotime("0 month"))."' and ctm<'".date('Y-m-d',strtotime("+1 month"))."'");
		$criteria->order='classify desc,lmonth_clicks desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>$pageSize
			),
		));
	}
	/**
	 * 上个月热度 互动游戏 按添加时间
	 * @date: 2015-6-1
	 * @author: wintrue<328945440@qq.com>
	 * @param number $pageSize
	 */
	function getHott($pageSize=10){
		
		
		$criteria=new CDbCriteria;
		$criteria->compare('category',1);
		$criteria->select='id,name,icon,url,clicks,utm,lmonth_clicks,share_proportion';
		$criteria->addCondition("start_tm<'".date('Y-m-d H:i:s')."' and (stop_tm>'".date('Y-m-d H:i:s')."' or stop_tm is null or stop_tm='') and ctm>'".date('Y-m-d',strtotime("-1 month"))."' and ctm<'".date('Y-m-d',strtotime("0 month"))."'");
		$criteria->order='classify desc,lmonth_clicks desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>$pageSize
			),
		));
	}
	/**
	 * 昨日比赛
	 * @date: 2015-6-1
	 * @author: wintrue<328945440@qq.com>
	 */
	function getGamey(){
		$criteria=new CDbCriteria;
		$criteria->compare('category',3);
		$criteria->select='id,name,icon,url,clicks,utm,prize_name';
		$criteria->compare('start_tm',date('Y-m-d',strtotime('-1 day')));
		$criteria->order='utm desc';
		return $this->find($criteria);
	}
	/**
	 * 今日比赛
	 * @date: 2015-5-28
	 * @author: wintrue<328945440@qq.com>
	 */
	function getGame(){
		$criteria=new CDbCriteria;
		$criteria->compare('category',3);
		$criteria->select='id,name,icon,url,clicks,utm,prize_name';
		$criteria->compare('start_tm',date('Y-m-d'));
		$criteria->order='utm desc';
		return $this->find($criteria);
		
	}
	/**
	 * 明日比赛预告
	 * @date: 2015-5-28
	 * @author: wintrue<328945440@qq.com>
	 */
	function getGamet(){
		$criteria=new CDbCriteria;
		$criteria->compare('category',3);
		$criteria->select='id,name,icon,url,clicks,prize_name,utm';
		$criteria->compare('start_tm',date('Y-m-d',strtotime('+1 day')));
		$criteria->order='utm desc';
		return $this->find($criteria);
	}
	public function mobile_search()
	{
		$criteria=new CDbCriteria;
		$criteria->addInCondition('category', array(1,2));
		if(empty($this->name)){$this->name='000';};
		$criteria->compare('name',$this->name,true);
		//$criteria->select='id,name,icon,url,clicks,utm';
		$criteria->addCondition("start_tm<'".date('Y-m-d H:i:s')."' and (stop_tm>'".date('Y-m-d H:i:s')."' or stop_tm is null or stop_tm='')");
		$criteria->order='utm desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>15
			),
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AppGame the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	function beforeSave(){
		if($this->isNewRecord){
			$this->ctm=date('Y-m-d H:i:s',time());
			$this->utm=date('Y-m-d H:i:s',time());
			$this->type=0;
		}else{
			$this->utm=date('Y-m-d H:i:s',time());
		}
		if(!$this->stop_tm){
			$this->stop_tm=null;
		}

		return parent::beforeSave();
	}
}
