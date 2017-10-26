<?php

/**
 * This is the model class for table "sys_slide_img".
 *
 * The followings are the available columns in table 'sys_slide_img':
 * @property integer $id
 * @property integer $sid
 * @property string $pic
 * @property string $title
 * @property string $url
 * @property string $note
 * @property string $minpic
 * @property integer $listorder
 */
class SysSlideImg extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sys_slide_img';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sid,title', 'required'),
			array('sid, listorder', 'numerical', 'integerOnly'=>true),
			array('pic, url, minpic', 'length', 'max'=>200),
			array('title', 'length', 'max'=>50),
			array('note', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sid, pic, title, url, note, minpic, listorder', 'safe', 'on'=>'search'),
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
			'sid' => '幻灯片栏位对应slide表id',
			'pic' => '大图',
			'title' => '题标',
			'url' => '接链',
			'note' => '描述',
			'minpic' => '缩略图',
			'listorder' => '排序',
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
		$criteria->compare('sid',intval($_GET['sid']));
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('minpic',$this->minpic,true);
		$criteria->compare('listorder',$this->listorder);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SysSlideImg the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
