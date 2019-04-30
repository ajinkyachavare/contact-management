<?php

class ContactListController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','share'),
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
        $folder = Yii::app()->request->baseUrl.'/../Profiles/';
		$this->render('view',array(
			'model'=>$this->loadModel($id),'folder'=>$folder
		));
	}

    public function actionShare($firstName='',$contactId='')
    {
        $excludeUser = Yii::app()->user->id;
        $model = new UserMaster;
        $dataProvider = $model->search( $excludeUser );
        $data = $dataProvider->getData();
        if(isset($_POST['yt0']))
        {
            if(is_array($_POST) && sizeof($_POST)>1)
            {
                $users = array_keys($_POST);
                foreach($users as $i=>$val)
                {
                    if( $val!='yt0' )
                    {
                        $mod = new SharedContacts;
                        $mod->contact_id = $contactId;
                        $mod->user_id = $val;
                        if($mod->save())
                        {
                        }
                        else
                        {
                            print_R($mod->errors);
                        }
                    }
                }
                $this->redirect(array('admin'));
            }
            else
            {
                echo "Please select atleast 1 user!";
            }
        }
        $this->render('share',array('data'=>$data,'contactId'=>$contactId,'firstName'=>$firstName));
    }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ContactList;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ContactList']))
		{
            $rnd = rand(0,9999);
            $model->attributes=$_POST['ContactList'];
            $uploadedFile=CUploadedFile::getInstance($model,'image');
            $fileName = "{$rnd}-{$uploadedFile}";
            $model->image = $fileName;
            $model->created_by = Yii::app()->user->id;
			if($model->save())
			{
			    if( $uploadedFile )
			    {
                    $folder = Yii::app()->basePath . '/../Profiles/';
                    !file_exists($folder) && mkdir($folder, 0777);
                    $uploadedFile->saveAs($folder . '/' . $fileName);
                }
                $this->redirect(array('admin'));
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

		if(isset($_POST['ContactList']))
		{
            $image = $model->image;
			$model->attributes=$_POST['ContactList'];
            $model->image = $_POST['ContactList']['image'];
            $uploadedFile=CUploadedFile::getInstance($model,'image');
            if( $uploadedFile )
            {
                $rnd = rand(0,9999);
                $fileName = "{$rnd}-{$uploadedFile}";
                $model->image = $fileName;
            }
            else
            {
                $model->image = $image;
            }

			if($model->save())
			{
                if( $uploadedFile )
                {
                    $folder = Yii::app()->basePath.'/../Profiles/';
                    $uploadedFile->saveAs($folder.'/'.$model->image);
                }
                $this->redirect(array('admin'));
            }
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
		$dataProvider=new CActiveDataProvider('ContactList');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ContactList('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ContactList']))
			$model->attributes=$_GET['ContactList'];

		$this->render('admin',array(
			'model'=>$model
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ContactList the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ContactList::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ContactList $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='contact-list-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
