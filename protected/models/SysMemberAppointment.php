<?php

/**
 * This is the model class for table "sys_member_appointment".
 *
 * The followings are the available columns in table 'sys_member_appointment':
 * @property integer $id
 * @property string $openid
 * @property integer $aid
 * @property string $score
 * @property integer $ranking
 * @property string $ctm
 * @property string $utm
 */
class SysMemberAppointment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sys_member_appointment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('aid, ranking,isgetPrize', 'numerical', 'integerOnly'=>true),
			array('openid', 'length', 'max'=>50),
			array('score', 'length', 'max'=>20),
			array('isgetPrize', 'length', 'max'=>4),
			array('ctm, utm', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, openid, aid, score, ranking, ctm, utm', 'safe', 'on'=>'search'),
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
			'appgame'=>array(self::HAS_ONE,'AppGame',array('id'=>'aid'),'select'=>'name,icon,clicks')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'openid' => 'Openid',
			'aid' => 'Aid',
			'score' => 'Score',
			'ranking' => 'Ranking',
			'isgetPrize'=>'是否已经领取奖品',
			'ctm' => 'Ctm',
			'utm' => 'Utm',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('openid',$this->openid,true);
		$criteria->compare('aid',$this->aid);
		$criteria->compare('score',$this->score,true);
		$criteria->compare('ranking',$this->ranking);
		$criteria->compare('ctm',$this->ctm,true);
		$criteria->compare('utm',$this->utm,true);

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
	 * @return SysMemberAppointment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
