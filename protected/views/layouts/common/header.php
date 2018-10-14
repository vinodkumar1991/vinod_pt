<!-- HEADER -->
    <header class="header fixed">
        <div class="header-wrapper">
            <div class="container">

                <!-- Logo -->
                <div class="logo">
                    <a href="<?php echo Yii::app()->baseUrl; ?>"><img src="<?php echo Yii::app()->baseUrl; ?>/assets/img/logo-rentit.png" alt="Rent It"/></a>
                </div>
                <!-- /Logo -->

                <!-- Mobile menu toggle button -->
                <a href="#" class="menu-toggle btn ripple-effect btn-theme-transparent"><i class="fa fa-bars"></i></a>
                <!-- /Mobile menu toggle button -->
			
			<div class="topnav pull-right">
					<div class="pull-right dwn-app">
						<a href="" class="btn btn-submit btn-theme">Download App <i class="fa fa-mobile animated" aria-hidden="true"></i></a>
                    </div>
                    <div class="pull-right myaccount">
					<?php 
					
					if((Yii::app()->controller->action->id=="VehicleInfo" || Yii::app()->controller->action->id=="Booking" ||
					Yii::app()->controller->action->id=="loginuser" || Yii::app()->controller->action->id=="VehicleList" ||
					Yii::app()->controller->action->id=="Bookingsevicedetails" || Yii::app()->controller->action->id=="loginuser" || Yii::app()->controller->action->id=="Selfdrivedetails" || Yii::app()->controller->action->id=="Modificationdetails" || Yii::app()->controller->action->id=="Hiremechanicdetails" ||  Yii::app()->controller->action->id=="Vehicleguidedetails"
					|| Yii::app()->controller->action->id=="Savebookservice" || Yii::app()->controller->action->id=="saveVehicle" || Yii::app()->controller->action->id=="AddVehicle") && !empty(Yii::app()->session['username']))
					{
						//echo Yii::app()->controller->action->id;
						echo ' <a href="'.$this->createUrl('Vendor/Vendor/Vendor').'" class="dropdown-toggle">Partner With Us</a>
								<a href="#" class="dropdown-toggle">Add your vehicle</a>
								<div class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome '.Yii::app()->session['username'].' <b class="caret"></b></a>							
			                        <ul class="dropdown-menu">
			                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/VehicleList').'">My Vehicles</a></li>							
			                            <li><a href="'.$this->createUrl('Orders/').'">My Orders</a></li>
			                           <li><a href="">Settings</a></li>';
									
		                          echo '  <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/Dashboard').'">Logout</a></li>';
								
		                       echo ' </ul>
		                        </div>';
					}
					
					else if(isset($_GET['name']))
					{
						 Yii::app()->session['username']=$_GET['name'];
						 echo '<a href="'.$this->createUrl('Vendor/Vendor/Vendor').'" class="dropdown-toggle">Partner With Us</a>
						 	   <a href="" class="dropdown-toggle">Add your vehicle</a>
								 <div class="dropdown">
									 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome '.$_GET['name'].' <b class="caret"></b></a>						
				                        <ul class="dropdown-menu">
				                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/VehicleList').'">My Vehicles</a></li>
				                            <li><a href="'.$this->createUrl('Orders/').'">My Orders</a></li>
				                             <li><a href="">Settings</a></li>';
									
								
		                          echo '  <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/Dashboard').'">Logout</a></li>';
									
		                       echo ' </ul>
			                    </div>'; 
						
					}
					   else if((count($data) > 3) && !empty(Yii::app()->session['username']))
					{
						//echo 'else';
						 echo '<a href="'.$this->createUrl('Vendor/Vendor/Vendor').'" class="dropdown-toggle">Partner With Us</a>
						 	   <a href="" class="dropdown-toggle">Add your vehicle</a>
						 	   <div class="dropdown">
							 	   <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome '.Yii::app()->session['username'].' <b class="caret"></b></a>
			                        <ul class="dropdown-menu">
			                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/VehicleList').'">My Vehicles</a></li>
			                            <li><a href="'.$this->createUrl('Orders/').'">My Orders</a></li>
			                            <li><a href="">Settings</a></li>';
								
		                          echo '  <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/Dashboard').'">Logout</a></li>';
									
		                       echo ' </ul>
			                    </div>'; 
					}  
					  else if((count($data) < 3) && !empty(Yii::app()->session['username']))
					{
						//echo 'igkjklf';
						 echo '<a href="'.$this->createUrl('Vendor/Vendor/Vendor').'" class="dropdown-toggle">Partner With Us</a>
						 	   <a href="" class="dropdown-toggle">Add your vehicle</a>
						 	<div class="dropdown">
						 	   	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome '.Yii::app()->session['username'].' <b class="caret"></b></a>		
		                        <ul class="dropdown-menu">
		                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/VehicleList').'">My Vehicles</a></li>
		                            <li><a href="'.$this->createUrl('Orders/').'">My Orders</a></li>
		                             <li><a href="">Settings</a></li>';
									
		                          echo '  <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/Dashboard').'">Logout</a></li>';
									
		                       echo ' </ul>
		                    </div>'; 
					}   
					else if(empty(Yii::app()->session['username']))
					{
						//echo 'k;d'.Yii::app()->session['username'];
						echo '<a href="'.$this->createUrl('Vendor/Vendor/Vendor').'" class="dropdown-toggle">Partner With Us</a>
						      <a href="#" class="dropdown-toggle" data-toggle = "modal" id="fblogin" data-target = "#signup-model_main">Register / Login</a>';
					
					}
					else{
						//echo 'fjflk;dhk;';
						echo '<a href="'.$this->createUrl('Vendor/Vendor/Vendor').'" class="dropdown-toggle">Partner With Us</a>
							  <a href="" class="dropdown-toggle">Add your vehicle</a>
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome '.Yii::app()->session['username'].' <b class="caret"></b></a>
							<div class="dropdown">
		                        <ul class="dropdown-menu">
		                            <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/VehicleList').'">My Vehicles</a></li>
		                            <li><a href="'.$this->createUrl('Orders/').'">My Orders</a></li>
		                            <li><a href="">Settings</a></li>';
									
		                          echo '  <li><a href="'.$this->createUrl('mPSVEHICLES_DETAILS/Dashboard').'">Logout</a></li>';
									
		                       echo ' </ul>
	                        </div>'; 
					}					
					
					?>
                    </div>
                    
                </div>
                <!-- Navigation -->
                <nav class="navigation closed clearfix">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <!-- navigation menu -->
                            <a href="#" class="menu-toggle-close btn"><i class="fa fa-times"></i></a>
                            <ul class="nav sf-menu">
                            <li class="<?php if(Yii::app()->controller->action->id=="Booking") echo "active";?>">
							
							
							<a href="<?php echo $this->createUrl('mPSVEHICLES_DETAILS/Booking');?>">Book a Service</a></li>
							
                                <li class="<?php if(Yii::app()->controller->id=="selfdrive") echo "active";?>">
								<a href="<?php echo $this->createUrl('Selfdrive/');?>">Self Drive</a>
								
                                    <!-- <ul>
                                        <li><a href="index.html">Home 1</a></li>
                                        <li><a href="index-2.html">Home 2</a></li>
                                        <li><a href="index-3.html">Home 3</a></li>
                                        <li><a href="index-4.html">Home 4</a></li>
                                        <li><a href="index-5.html">Home 5</a></li>
                                        <li><a href="index-6.html">Home 6</a></li>
                                    </ul> -->
                                </li>
                                <li class="<?php if(Yii::app()->controller->id=="hireMechanic") echo "active";?>">
								
								<a href="<?php echo $this->createUrl('HireMechanic/');?>">Hire a Mechanic</a></li>
								
								
                                <li class="<?php if(Yii::app()->controller->id=="modificationshop") echo "active";?>">
								
								<a href="<?php echo $this->createUrl('Modificationshop/');?>">Modifications</a></li>
								
								
                                <li class="<?php if(Yii::app()->controller->id=="vehicleGuide") echo "active";?>">
								
								<a href="<?php echo $this->createUrl('VehicleGuide/');?>">Vehicle Guide</a>
								
                                 
                                </li>
                                <li>
                                    <ul class="social-icons">
                                        <li><a href="https://www.facebook.com/metrepersecond" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="https://twitter.com/metrepersecond" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                       </ul>
                                </li>
                            </ul>
                            <!-- /navigation menu -->
                        </div>
                    </div>
                    <!-- Add Scroll Bar -->
                    <div class="swiper-scrollbar"></div>
                </nav>
                <!-- /Navigation -->

            </div>
        </div>

    </header>
    <!-- /HEADER -->



<?php 

?>

<?php 

?>