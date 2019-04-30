<?php

/**
 * This is the model class for table "contact_list".
 *
 * The followings are the available columns in table 'contact_list':
 * @property integer $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property integer $primary_phone
 * @property integer $secondary_phone
 * @property string $email
 * @property string $image
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 */
class ContactList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contact_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, primary_phone, email', 'required'),
			array('created_by,is_shared,shared_by', 'numerical', 'integerOnly'=>true),
			array('first_name, middle_name, last_name, email, image', 'length', 'max'=>250),
            array('created_at','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'insert'),
            array('updated_at','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'update'),
            array('email', 'email'),
            array('email', 'unique', 'className' => 'ContactList',
                'attributeName' => 'email',
                'message'=>'This Email is already in use'),
            array('image', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, first_name, middle_name, last_name, primary_phone, secondary_phone, email, image, created_by, created_at, updated_at,is_shared,shared_by', 'safe', 'on'=>'search'),
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
            'user'=>array(self::BELONGS_TO, 'UserMaster', 'created_by'),
            'shared' => array(self::HAS_MANY, 'SharedContacts', 'contact_id','condition'=>'user_id='.Yii::app()->user->id),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'middle_name' => 'Middle Name',
			'last_name' => 'Last Name',
			'primary_phone' => 'Primary Phone',
			'secondary_phone' => 'Secondary Phone',
			'email' => 'Email',
			'image' => 'Image',
			'created_by' => 'Created By',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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
        $criteria->with = array('user'=>array('select'=>'user_name'));
		$criteria->compare('id',$this->id);
        $criteria->compare('created_by',Yii::app()->user->id);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('primary_phone',$this->primary_phone,true);
		$criteria->compare('secondary_phone',$this->secondary_phone,true);
		$criteria->compare('t.email',$this->email,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('user.user_name',$this->created_by,true);
		$criteria->compare('t.created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ContactList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
