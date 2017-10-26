<?php

/**
 * This is the model class for table "app_uni".
 *
 * The followings are the available columns in table 'app_uni':
 * @property integer $id
 * @property string $name
 * @property string $ctm
 * @property string $utm
 * @property string $note
 */
class AppUni extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'app_uni';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>50),
			array('note', 'length', 'max'=>255),
			array('ctm, utm', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, ctm, utm, note', 'safe', 'on'=>'search'),
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
			'name' => '商户名称',
			'ctm' => '创建时间',
			'utm' => '更新时间',
			'note' => '描述',
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
		$criteria->compare('ctm',$this->ctm,true);
		$criteria->compare('utm',$this->utm,true);
		$criteria->compare('note',$this->note,true);
		

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
	 * @return AppUni the static model class
	 */
	public static function model($className=__CLASS__)
	{
		
		return parent::model($className);
	}
	function beforeSave(){
		if($this->isNewRecord){
			$this->ctm=date('Y-m-d H:i:s',time());
			$this->utm=date('Y-m-d H:i:s',time());
		}else{
			$this->utm=date('Y-m-d H:i:s',time());
		}
		return parent::beforeSave();
	}
}
