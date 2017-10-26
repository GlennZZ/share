<?php

/**
 * This is the model class for table "sys_wxredpack_record".
 *
 * The followings are the available columns in table 'sys_wxredpack_record':
 * @property integer $id
 * @property string $appid
 * @property string $mchid
 * @property string $billno
 * @property string $proveName
 * @property string $sendName
 * @property string $re_openid
 * @property integer $money
 * @property string $wishing_words
 * @property string $ext_info
 * @property integer $statue
 * @property string $msg
 * @property string $ip
 * @property string $ua
 * @property string $ctm
 * @property string $utm
 */
class SysWxredpackRecord extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sys_wxredpack_record';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('money, statue', 'numerical', 'integerOnly'=>true),
			array('appid, proveName, sendName, re_openid, ext_info', 'length', 'max'=>50),
			array('mchid', 'length', 'max'=>15),
			array('billno', 'length', 'max'=>30),
			array('wishing_words', 'length', 'max'=>150),
			array('msg', 'length', 'max'=>100),
			array('ip', 'length', 'max'=>20),
			array('ua', 'length', 'max'=>250),
			array('ctm, utm', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, appid, mchid, billno, proveName, sendName, re_openid, money, wishing_words, ext_info, statue, msg, ip, ua, ctm, utm', 'safe', 'on'=>'search'),
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
			
				'user'=>array(self::HAS_ONE,'SysMember',array('openid'=>'re_openid'),'select'=>'nickname,headimgurl')
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'id',
			'appid' => '商户appid',
			'mchid' => '微信支付分配的商户号',
			'billno' => '户商订单号',
			'proveName' => '包红提供方名称',
			'sendName' => '红包发送方的名称',
			're_openid' => '接收红包用户的openid',
			'money' => '发放红包的金额(元)',
			'wishing_words' => '红包祝福语',
			'ext_info' => '红包发送者的openid',
			'statue' => '红包发送状态：0-未成功  1-已成功',
			'msg' => '红包发放的返回信息',
			'ip' => '用户IP',
			'ua' => '用户浏览器信息',
			'ctm' => '创建时间',
			'utm' => '刷新时间',
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

		/*$criteria->compare('id',$this->id);
		$criteria->compare('appid',$this->appid,true);
		$criteria->compare('mchid',$this->mchid,true);
		$criteria->compare('billno',$this->billno,true);
		$criteria->compare('proveName',$this->proveName,true);
		$criteria->compare('sendName',$this->sendName,true);
		$criteria->compare('re_openid',$this->re_openid,true);
		$criteria->compare('money',$this->money);
		$criteria->compare('wishing_words',$this->wishing_words,true);
		$criteria->compare('ext_info',$this->ext_info,true);
		$criteria->compare('statue',$this->statue);
		$criteria->compare('msg',$this->msg,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('ua',$this->ua,true);
		$criteria->compare('ctm',$this->ctm,true);
		$criteria->compare('utm',$this->utm,true);*/
		if(empty($_GET['openid']))Yii::app()->getController()->error('参数错误');
		$criteria->compare('re_openid',$_GET['openid']);

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
	 * @return SysWxredpackRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
