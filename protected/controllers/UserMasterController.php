<?php

class UserMasterController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $header;

	/**
	 * @return array action filters
	 */
	/*public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}*/

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','verify','create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new UserMaster;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserMaster']))
		{
			$model->attributes=$_POST['UserMaster'];
            if(isset($_POST['UserMaster']['password']) && !empty($_POST['UserMaster']['password']))
                $model->password = md5($_POST['UserMaster']['password']);
            if(isset($_POST['UserMaster']['repeatpassword']) && !empty($_POST['UserMaster']['repeatpassword']))
                $model->repeatpassword = md5($_POST['UserMaster']['repeatpassword']);
            $model->status = UserMaster::$enumStatus['inactive'];
			if($model->save())
			{
                $link = "http://".$_SERVER['SERVER_NAME']."".Yii::app()->controller->createUrl('verify',array('id'=>EasyGeneralize::encryptKey($model->id)));
                $this->mailUser($model->email,$link);
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserMaster']))
		{
            if(isset($_POST['UserMaster']['password']) && !empty($_POST['UserMaster']['password']))
               $_POST['UserMaster']['password'] = md5($_POST['UserMaster']['password']);
			$model->attributes=$_POST['UserMaster'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('UserMaster');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    public function actionVerify($id='')
    {
        if(isset($id))
        {
            $id = EasyGeneralize::decryptKey($id);
            $model = UserMaster::model()->findByPk($id);
            $model->status = UserMaster::$enumStatus['active'];
            $model->save();
            $msg = 'Email verified successfully, please login to add contacts.';
            header('location: ../../login?msg='.$msg);
            exit();
        }
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserMaster('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserMaster']))
			$model->attributes=$_GET['UserMaster'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return UserMaster the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=UserMaster::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param UserMaster $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-master-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    public function mailUser($email,$link)
    {

        $body = '';
        $body .= " Dear User,<br>
        
        Thank you for register on Contact Management!! 
        <br>To verify email ID please <a href=".$link.">click here</a>
        
        <br><br>
        Thanks,<br>
        Ajinkya Chavare
            ";
        $subject = "Registration successful at " . date('d M y');
        $to = $email;

        $xheaders = "";
        $xheaders .= "From: <1ajinkya1@gmail.com>\n";
        $xheaders .= "X-Sender: <1ajinkya1@gmail.com>\n";
        $xheaders .= "X-Mailer: PHP\n";
        $xheaders .= "X-Priority: 1\n";
        $xheaders .= "Content-Type:text/html; charset=\"iso-8859-1\"\n";

        if(mail($to, $subject, $body, $xheaders))
        {
            $msg = 'User Registered Successfully, Verification link sent to your registered mail ID';
            header('location: ../login?msg='.$msg);
            exit();
        }
        else
        {
            echo "Error while mail sending";
        }
    }

}
