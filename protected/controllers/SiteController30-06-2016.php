<?php

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
	 
	public function actionlanding(){
		
		$this->render('landing');
	} 
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$this->render('index');
		$this->render('testview');
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
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	public function actionHomescreen()
	{
		
		 $images = MpsUploads::model()->findAll();
		 $imgcode = array();
		
		
		 foreach($images as $image)
			{
				$imgcode['slide'][]=$image['imagepath'];//encode
			
			}
			
		 $endata=json_encode($imgcode);
		
		
		            $url="http://localhost/yiitest/index.php/site/FetchDataHomescreen";
					$ch = curl_init($url);
// Disable SSL verification
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					// Will return the response, if false it print the response
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_POSTFIELDS,$endata);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					// Set the url
					curl_setopt($ch, CURLOPT_URL,$url);
					// Execute
					$result=curl_exec($ch);
					//echo count($result);
					//var_dump($result);
					// Closing
					curl_close($ch); 
					ECHO '<PRE>';
					//$res=json_decode($result);
					print_r($result);
					
		
		
	}
	public function actionfirsttest()//excecute 
	{
		
		$images = MpsUploads::model()->findAll();
		$array1 = array();
		$array8 = array();
		foreach($images as $image)
		{
			$imgcode['Images'][]=$image['data'];//encode
			
		}
		//$array8['img']=$imgcode;
		//$imgcode['slides']=$imgcode['Images'];
		
					$endata=json_encode($imgcode);
				
					$url="http://localhost/yiitest/index.php/site/FetchData";
					$ch = curl_init($url);
					// Disable SSL verification
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					// Will return the response, if false it print the response
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_POSTFIELDS,$endata);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					// Set the url
					curl_setopt($ch, CURLOPT_URL,$url);
					// Execute
					$result=curl_exec($ch);
					
					curl_close($ch); 
					print_r( $result );
					//
					
					
	  }
		public function actionFetchDataHomescreen()
		{
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$rawData1=json_decode($rawData,true);
			//print_r( $rawData1 );
			if(empty($rawData1))
					{
						
					echo 'No data available';	
					}
					else{
						
						print_r($rawData1);
					}
			//
		}
		public function actionFetchData()
		{
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$rawData1=json_decode($rawData,true);
			//print_r( $rawData1 );
			if(empty($rawData1))
					{
						
					echo 'No data available';	
					}
					else{
						
						print_r($rawData1);
					}
			//
		}
		 public function actionMapajax1()
     {
            $services=Yii::app()->db->createCommand("SELECT * from HIRE_A_MECHANIC")->queryAll();
            $out=array();
            foreach($services as $service)
            {
                $out[]=array($service['location'],$service['lag'],$service['lat']);
            }
            echo json_encode($out); 
            die;
     }
	
}