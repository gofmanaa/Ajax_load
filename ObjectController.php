<?php

class ObjectController extends Controller
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
				'actions'=>array('index','view','list_tiles'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
		$model=new Object;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Object']))
		{
			$model->attributes=$_POST['Object'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Object']))
		{
			$model->attributes=$_POST['Object'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
        if(isset($_GET['Object_page']))
        {
            $page = $_GET['Object_page'] -1;
        }
        else
            $page = 0;


        if(Yii::app()->request->isAjaxRequest){
            if(isset($_POST['test']))
            {
                $test = $_POST['test'];
            }
            else
            {
                $test = 0;
            }

            $dataProvider=new CActiveDataProvider('Object', array(
                'criteria' => array(
                    'condition' => 't.id >= :search',
                    'params' =>array(':search' => (int)$test),
                ),
                'pagination'=>array(
                    'pageSize'=>5,
                    'currentPage'=>$page
                ),
            ));
            $dataProvider->getData();
            //$cs = Yii::app()->clientScript;
            //$cs->scriptMap['*.js'] = false;
            $this->renderPartial('_index',array('dataProvider'=>$dataProvider),false,true);
            Yii::app()->end();
        }
        $dataProvider=new CActiveDataProvider('Object',array(
            'pagination'=>array(
                'pageSize'=>5,
                'currentPage'=>$page
            ))
        );
		$this->render('index',array(
			'dataProvider'=>$dataProvider,

		));
	}
     public function   actionList_tiles()
     {
         if(!Yii::app()->request->isAjaxRequest) throw new CHttpException(404,'The requested page does not exist.');
         if(isset($_POST['view']) && $_POST['view']=='tiles')
         {
             Yii::app()->user->setState('object_main_view','tiles');

         }
         else
         {
             Yii::app()->user->setState('object_main_view','list');

         }
         echo Yii::app()->user->getState('object_main_view') ;

         Yii::app()->end();
     }
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Object('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Object']))
			$model->attributes=$_GET['Object'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Object the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Object::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Object $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='object-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
