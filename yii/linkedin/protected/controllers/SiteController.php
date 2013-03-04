<?php
session_start();
class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		/*$this->layout = '/layouts/main';
		$model=new Users;
		if(isset(Yii::app()->session['logininfo']))
				unset(Yii::app()->session['logininfo']);*/
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	public function actionLinkedinReg()
	{
		
		if($_REQUEST['url']=='linkreg')
		{
			if(isset(Yii::app()->session['userinfo'])){
				/* print "<pre>";
				print_r(Yii::app()->session['userinfo']);
				 print "</pre>";exit;*/

				$myprofile=Yii::app()->session['userinfo'];
				$this->render('myprofile',array('myprofile'=>$myprofile));
			}
		}
	}
	public function actionSendMessage()
	{
		
		 if(!empty($_POST['message_copy'])) {
          $copy = TRUE;
        } else {
          $copy = FALSE;
        }

			$API_CONFIG = array(
		    'appKey'       => '9hvj1btmfvhk',
			  'appSecret'    => 'w1ONNdmLEcsZk1mF',
			  'callbackUrl'  => NULL 
		  );
		error_reporting(E_ALL);
		$srvPath=$_SERVER["DOCUMENT_ROOT"];
		require_once($srvPath.'/byio/yii/linkedin/hybridauth/Hybrid/thirdparty/LinkedIn/LinkedIn.php');
		$hybridauth = new LinkedIn($API_CONFIG);
		
		if(!empty($_POST['message_copy'])) {
          $copy = TRUE;
        } else {
          $copy = FALSE;
        }
		$hybridauth->setTokenAccess($_SESSION['oauth']['linkedin']['access']/*Yii::app()->session['oauth']['linkedin']['access']*/);
		$response = $hybridauth->message($_POST['connections'], $_POST['message_subject'], $_POST['message_body'], $copy);
		if($response['success'] === TRUE) {
          // message has been sent
          echo "Message has been sent successfully enjoy..";
        } else {
          // an error occured
          echo "Error sending message:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($hybridauth, TRUE) . "</pre>";
        }
		
	}
   public function actionLogfacebook(){
   	error_reporting(E_ALL);
   	$srvPath=$_SERVER["DOCUMENT_ROOT"];
   	/* require_once($srvPath.'/byio/yii/linkedin/facebook.php');
  $hybridauth = new Hybrid_Auth($hybridauth_config);
   $srvPath=$_SERVER["DOCUMENT_ROOT"];*/
   	require_once($srvPath.'/byio/yii/linkedin/facebook.php');
   
	
		 $facebook = new Facebook(array(
		  'appId'  => '242828585838365',
		  'secret' => 'b561622c4d204f08b84e73c68e284eed',
		));

// Get User ID
$user = $facebook->getUser();
if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    
	
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}
$naitik = $facebook->api('/naitik');


	
	
	
   }
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	
	public function actionRegister()
	{
		$model=new Userregister;
		$this->render('myview',array('model'=>$model));
	}
	
	public function actionSaveUserInfo()
	{
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Userregister']))
		{
			
			if(isset($_POST['Userregister']['id']) && $_POST['Userregister']['id']>0){
				$id=$_POST['Userregister']['id'];
				$model=$this->loadModel($id);
			}else{
				$model=new Userregister;
			}
			$model->attributes=$_POST['Userregister'];
			$model->cimage=CUploadedFile::getInstance($model,'cimage');
					
			 if(isset($model->cimage)){
					$model->image= $model->cimage->name;	
			}
			if($model->save(false)) {
			
			
			
			$chId=Yii::app()->db->getLastInsertId();
			if(isset($model->image) && $model->image !=""){
					$model->cimage->saveAs(dirname(__FILE__).'/../../images/userimages/'.$chId."_".$model->image);
			}
			$this->redirect(array('view','id'=>$model->id));
			$this->refresh();
			}
		}

		
	}
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Userregister']))
		{
			$model->attributes=$_POST['Userregister'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('view',array(
			'model'=>$model,'uid'=>$id
		));
	}
	public function actionView()
	{
		if(isset(Yii::app()->session['logininfo'])){
			$this->render('view');
		}else{
			$this->redirect(array('index'));
		}
	}
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new Users;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['Users']))
		{
		
			$model->attributes=$_POST['Users'];
			// validate user input and redirect to the previous page if valid
			$username=$_POST['Users']['username'];
			$password=$_POST['Users']['password'];
			
			
			$users=Users::model()->findByAttributes(array('username'=>$username,'password'=>$password));	
			
			if(count($users)>0){
				$logininfo = array();
			if(isset(Yii::app()->session['logininfo']))
				unset(Yii::app()->session['logininfo']);
			$logininfo["username"] = $users->username;
			$logininfo["userid"] = $users->id;
			Yii::app()->session['logininfo'] = $logininfo;
				$this->redirect(array('/activity/index'));
			}else{
			
				$this->redirect(array('index'));
			}	
			
				
		}
		// display the login form
		$this->render('index',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
}