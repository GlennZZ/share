<?php

/**
 * This is the model class for table "prize".
 *
 * The followings are the available columns in table 'prize':
 * @property integer $id
 * @property string $name
 * @property string $img
 * @property integer $integral
 * @property integer $unid
 * @property string $code
 * @property integer $status
 * @property integer $num
 * @property string $create_time
 */
class Prize extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'prize';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('integral, unid, status, num', 'numerical', 'integerOnly'=>true),
			array('name, img, code', 'length', 'max'=>255),
			array('create_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, img, integral, unid, code, status, num, create_time', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '奖品名称',
			'img' => '奖品照片',
			'integral' => '所需积分',
			'unid' => '商家ID',
			'code' => '微信卡劵ID',
			'status' => '状态',// 1启用 2禁用
			'num' => '奖品数量',
			'create_time' => ' 创建时间',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('integral',$this->integral);
		$criteria->compare('unid',$this->unid);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('num',$this->num);
		$criteria->compare('create_time',$this->create_time,true);

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
	 * @return Prize the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
