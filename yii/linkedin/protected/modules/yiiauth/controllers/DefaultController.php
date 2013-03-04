<?php

class DefaultController extends Controller {
	public $url;
	public $userinfo;
	public function actionIndex() {
		$this -> renderPartial('index');
	}

	public function actionauthenticatewith($provider = "") {
		$hybridauth_config = Yiiauth::hybridAuthConfig();

		$error = false;
		$user_profile = false;
		//echo "before try";
		try {
			// create an instance for Hybridauth with the configuration file path as parameter\
			
			
			$hybridauth = new Hybrid_Auth($hybridauth_config);

			// try to authenticate the selected $provider
			if (isset($_REQUEST['openid'])) {
				$provider = "openid";
				/*print_r("hiii");
				 exit;*/
				$adapter = $hybridauth -> authenticate($provider, array("openid_identifier" => $_REQUEST['openid']));
				/*print_r($adapter);
				 exit;*/
			} else {
error_reporting(E_ALL);
				$adapter = $hybridauth -> authenticate($provider);
				
			}
			
			//echo "in try";
			// grab the user profile

			$user_profile = $adapter -> getUserProfile();
			print "<pre>";
			print_r($user_profile);
			print "</pre>";
				 exit;
			$userconnections = $adapter -> getUserContacts();
			
		} catch( Exception $e ) {
			/*echo "after try";
			 exit;*/
			// Display the recived error
			switch( $e->getCode() ) {
				case 0 :
					$error = "Unspecified error.";
					break;
				case 1 :
					$error = "Hybriauth configuration error.";
					break;
				case 2 :
					$error = "Provider not properly configured.";
					break;
				case 3 :
					$error = "Unknown or disabled provider.";
					break;
				case 4 :
					$error = "Missing provider application credentials.";
					break;
				case 5 :
					$error = "Authentification failed. The user has canceled the authentication or the provider refused the connection.";
					break;
				case 6 :
					$error = "User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.";
					$adapter -> logout();
					break;
				case 7 :
					$error = "User not connected to the provider.";
					$adapter -> logout();
					break;
			}

			// well, basically your should not display this to the end user, just give him a hint and move on..
			$error .= "<br /><br /><b>Original error message:</b> " . $e -> getMessage();
			$error .= "<hr /><pre>Trace:<br />" . $e -> getTraceAsString() . "</pre>";

		}

		if (isset($user_profile) && count($user_profile)>0) {
			
								$userinfo = array();
								
								if(isset(Yii::app()->session['userinfo']))
										unset(Yii::app()->session['userinfo']);	
								
								
								$userinfo["fname"] = $user_profile->firstName;
								$userinfo["lname"] = $user_profile->lastName;
								$userinfo["email"] = $user_profile->email;
								$userinfo["zip"] = $user_profile->zip;
								$userinfo["gender"] = $user_profile->gender;
								$userinfo["photourl"] = $user_profile->photoURL;
								$userinfo["country"] = $user_profile->country;
								$userinfo["contactnumber"] = $user_profile->phone;
								$userinfo["jobtitle"] = $user_profile->jobtitle;
								$userinfo["company"] = $user_profile->companyname;
								$userinfo["degrees"] = $user_profile->degrees;
								$userinfo["skills"] = $user_profile->skills;
								$userinfo["connections"] = $user_profile->connections;
								$userinfo["city"] = $user_profile->city;
								$userinfo["age"] = $user_profile->age;
								$userinfo["birthday"] = $user_profile->birthDay;
								$userinfo["birthmonth"] = $user_profile->birthMonth;
								$userinfo["birthyear"] = $user_profile->birthYear;
								$userinfo["SocialNetworkID"] = $user_profile->identifier;
								$userinfo["SocialNetwork"] = $provider;
								Yii::app()->session['userinfo'] = $userinfo;
								
								$myprofile=Yii::app()->session['userinfo'];
			/*$this->redirect(array('/site/linkedinReg','url'=>'linkreg'));*/
			$this->render('myprofile',array('myprofile'=>$myprofile,'connections'=>$userconnections));
		

		} else {
			$this -> redirect('/');
		}
		/* }*/
	}

	public function workOnUser($provider, $provideruser) {
		$social = Social::model() -> find("provider='" . $provider . "' AND provideruser='" . $provideruser . "'");
		if ($social) {
			$user = User::model() -> find("userid=" . $social -> yiiuser);
			return $user;
		} else {
			// we want to create a new user, but since we get no user input the validation rules will cause
			//errors on save to counter this i added 'on'=>'validation' to all my user validation rules
			//example:      array('username, password', 'required','on'=>'validation'),
			// on normal user registration with user input I use: new User('validation')
			$user = new User;
			$user -> socialnetworkid = $provideruser;
			/*print_r($user->firstname);
			 exit;*/
			if ($user -> save()) {//we get an user id
				//add a social connection between the newly created yii user and the provider user account to avoid double regestrations and enable the same yii user to have many providers associated with it.

				$social = new Social;
				$social -> yiiuser = $user -> userid;
				$social -> provider = $provider;
				$social -> provideruser = $provideruser;
				if ($social -> save())
					return $user;
			}
		}

	}
	public function actionSendMessage()
	{
		echo "came here";
	$hybridauth_config = Yiiauth::hybridAuthConfig();
	           print "<pre>";
				print_r($hybridauth_config);
				 print "</pre>";exit;
		
		
	}
	public function autoLogin($user)//accepts a user object
	{
		/*$identity=new UserIdentity($user->fname, "");
		 $identity->hybridauth($user->fname);
		 if ( $identity->errorCode == UserIdentity::ERROR_NONE )
		 {
		 $duration= 3600*24*30; // 30 days
		 Yii::app()->user->login($identity,$duration);
		 return true;
		 }
		 else
		 {*/
		//   echo $identity->errorCode;
		return false;
		/*}*/

	}

}
?>