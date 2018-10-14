<?php

class OrdersController extends Controller
{
	public function actionIndex()
	{
		$user=Yii::app()->session['lastid'];
		$rawslfData=Yii::app()->db->createCommand("SELECT book.book_id,addv.vehicle_id,addv.vehicle_type,book.created_date,addv.vehicle_category,addv.security_deposit,book.fromdate,book.todate,book.amount FROM SLD_ADD_VEHICLE as addv,selfdrive_bookings as book where addv.id=book.vehicle_id and book.status=1 and book.user_id='$user' ORDER BY created_date DESC")->queryAll();
		$models=Yii::app()->db->createCommand("SELECT book.status,hire.hire_mechanic_id,book.book_id,book.userid,book.amount,book.billingaddrs,book.location,book.created_date,hire.vehicle_type,hire.name FROM HIRE_A_MECHANIC as hire,hire_mechanic_trans as book where book.mechanic_id=hire.id and book.userid='$user' ORDER BY created_date DESC")->queryAll();			
		$final=Yii::app()->db->createCommand("SELECT book.status,book.bookid,book.vehicle_type,book.service_name,book.plan_name,book.userid,book.amout,book.billingadrs,book.timestamp FROM MPS_PACKAGEWISE_AMT_DETAILS as book where book.userid='$user' ORDER BY timestamp DESC")->queryAll();			
	
		  		 $this->render('index',array("data"=>$rawslfData,"hiredate"=>$models,"final"=>$final));
	}
	public function actionMyOrders()
	{
		$user=Yii::app()->session['lastid'];
		$rawslfData=Yii::app()->db->createCommand("SELECT book.book_id,addv.vehicle_id,addv.vehicle_type,book.created_date,addv.vehicle_category,addv.security_deposit,book.fromdate,book.todate,book.amount FROM SLD_ADD_VEHICLE as addv,selfdrive_bookings as book where addv.id=book.vehicle_id and book.status=1 and book.user_id='$user' ORDER BY created_date DESC")->queryAll();
		$models=Yii::app()->db->createCommand("SELECT book.status,hire.hire_mechanic_id,book.book_id,book.userid,book.amount,book.billingaddrs,book.location,book.created_date,hire.vehicle_type,hire.name FROM HIRE_A_MECHANIC as hire,hire_mechanic_trans as book where book.mechanic_id=hire.id and book.userid='$user' ORDER BY created_date DESC")->queryAll();			
		$final=Yii::app()->db->createCommand("SELECT book.status,book.bookid,book.vehicle_type,book.service_name,book.plan_name,book.userid,book.amout,book.billingadrs,book.timestamp FROM MPS_PACKAGEWISE_AMT_DETAILS as book where book.userid='$user' ORDER BY timestamp DESC")->queryAll();			
	
		  		 $this->render('myorders',array("data"=>$rawslfData,"hiredate"=>$models,"final"=>$final));
	}
	public function actionlogout()
	{
		  unset(Yii::app()->session['username']);
		  unset(Yii::app()->session['lastid']);
		  unset(Yii::app()->session['bookid']);
		  unset(Yii::app()->session['fbid']);
		   $this->render('myorders');
	}
		public function actionfblogin()
	{
			/*$email_id=$_POST['regemail'];			
			$uname=$_POST['uname'];
			$fbid=$_POST['id'];
		$check=Yii::app()->db->createCommand("SELECT fbid from MPS_CUSTOMERACC_INFO where fbid='$fbid' LIMIT 1")->queryAll();
		if(empty($check))
		{
			$MPSCUSTOMERINFO=new MPSCUSTOMERINFO();	
			$MPSCUSTOMERINFO->username=$uname;
			$MPSCUSTOMERINFO->emailid=$email_id; 
			$MPSCUSTOMERINFO->mobile_no=0; 
			$MPSCUSTOMERINFO->save();
			if($MPSCUSTOMERINFO->save())
			{
				$userid=$MPSCUSTOMERINFO->id;
				Yii::app()->session['lastid']=$lastid;
			}  
			$MPSCUSTOMER=new MPSCUSTOMERACCINFO();
			$MPSCUSTOMER->loginid=$userid;			
			$MPSCUSTOMER->username=$email_id;
			$MPSCUSTOMER->fbid=$fbid;
			$MPSCUSTOMER->password=0;
			$MPSCUSTOMER->otp_status=0;
			$MPSCUSTOMER->save(); 
			Yii::app()->session['username'] = $uname;
			Yii::app()->session['lastid']=$userid;
			Yii::app()->session['emailid']=$email_id;
				Yii::app()->session['fbid']=$fbid;
			echo '1';
		}else
		{
			$check=Yii::app()->db->createCommand("SELECT * from MPS_CUSTOMERACC_INFO where fbid='$fbid' LIMIT 1")->queryAll();
			
			Yii::app()->session['username'] = $uname;
			Yii::app()->session['lastid']=$check[0]['loginid'];
			Yii::app()->session['emailid']=$check[0]['email_id'];
			Yii::app()->session['fbid']=$fbid;
			echo '1';
		}*/
                    echo 1;
			
	}
		public function actionDashboard()
	{
		
		/* if($session->isActive)
		{} */
	  unset(Yii::app()->session['username']);
	  unset(Yii::app()->session['lastid']);
	  unset(Yii::app()->session['bookid']);

	    
//		$session->destroy();
		//$session->close();

// destroys all data registered to a session.
		//$session->destroy();
		$this->actionAddVehicle();
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}