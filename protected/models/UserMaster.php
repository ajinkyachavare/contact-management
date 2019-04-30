<?php

/**
 * This is the model class for table "user_master".
 *
 * The followings are the available columns in table 'user_master':
 * @property integer $id
 * @property string $user_name
 * @property string $email
 * @property string $password
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class UserMaster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_master';
	}

    public static $enumStatus = array('active'=>'1','inactive'=>'0');
    public static $arrStatus = array('1'=>'Active','0'=>'Inactive');

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name, email, password, repeatpassword', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('user_name, email', 'length', 'max'=>250),
            array('password', 'length', 'min'=>6),
            array('created_at','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'insert'),
            array('updated_at','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'update'),
            array('status','default','value'=>self::$enumStatus['active'],'setOnEmpty'=>true),
            array('email', 'email'),
            array('email', 'unique', 'className' => 'UserMaster',
                'attributeName' => 'email',
                'message'=>'This Email is already in use'),
            array('user_name', 'unique', 'className' => 'UserMaster',
                'attributeName' => 'user_name',
                'message'=>'This User Name is already in use'),
            array('repeatpassword', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match"),

            // The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_name, email, password, status, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'user_name' => 'User Name',
			'email' => 'Email',
			'password' => 'Password',
			'status' => 'Status',
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
	public function search( $excludeUser='' )
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		if(isset( $excludeUser ))
        {
            $criteria->addCondition('id != :id');
            $criteria->params[':id'] = $excludeUser;
        }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
