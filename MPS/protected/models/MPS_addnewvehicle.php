<?php
//echo 'dsfjklslk'.Yii::app()->session['username'];

/*  var_dump($vmakelist);
exit; */ 
// Yii::app()->session['bookloc'];
  
// $bodytag = str_replace(" ", "+", "Hyderabad International Airport, Shamshabad, Hyderabad, Telangana, India");

		 // $url = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$bodytag&sensor=false&region=india");
				// $response = json_decode($url);

				// echo $lat = $response->results[0]->geometry->location->lat;
				// $long = $response->results[0]->geometry->location->lng; 
				// exit;


?>
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dist/locationpicker.jquery.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>

<script>
      $(function(){
        $(".geocomplete").geocomplete({
        
          details: "form",
          types: ["geocode", "establishment"],
        });

      
      });
</script>
 


<script>
$(document).ready(function()
{
	
	
	
	
	$("#regemail").change(function(){
				
				var emailid = $('#regemail').val();
				
				$.post('emailValidation',{
		            emailid:emailid,
		
					beforeSend : function(){ 	}
	},
		function(data)
		{ 
			
			 if(data>0)
			{
				
				$("#emailerror").html('<font color="red">Email Id already exist.</font>');
				return false;
			}
			else{
				$("#emailerror").html('');
				
			}  
		}); 
       
			});
		
		
		
		$('#register1').click(function()
		{
		
		var regemail= $("#regemail").val();
		alert(regemail);
		 var adrs= $("#adrs").val();
		 var location= $("#location").val();
		
		 var picdate= $("#picdate").val();
		 //alert(picdate);
		  var pickhr= $("#pickhr").val();
		  var amount= $("#amount").val(); 
		  var packageid= $("#package").val();  
		  var makes_id= $("#makes_id").val();
		  var model_id= $("#model_id").val();
		  var upwd= $("#regupwd").val();
		  	var mobNo= $("#regmobNo").val();
			 var uname= $("#reguname").val();
		//alert('skdjkl');
		if(regemail=='')
		 {
			 $('#emailerror').html("<font color='red'>Enter Email ID</font>");
			 $('#reguname').focus();
		 }
		 else if(reguname=='')
		 {
			 $('#emailerror').html("<font color='red'>Enter Username</font>");
			 $('#regmobNo').focus();
		 }
		  else if(regmobNo=='')
		 {
			 $('#emailerror').html("<font color='red'>Enter Mobile Number</font>");
			 $('#regupwd').focus();
		 }
		  else if(regupwd=='')
		 {
			 $('#emailerror').html("<font color='red'>Enter password</font>");
			 //$('#regmobNo').focus();
		 }
		
		/*  var regemail= $("#regemail").val();
		 var adrs= $("#adrs").val();
		 var location= $("#location").val();
		
		 var picdate= $("#picdate").val();
		 //alert(picdate);
		 var pickhr= $("#pickhr").val();
		  var amount= $("#amount").val(); 
		  var packageid= $("#package").val();  
		  var makes_id= $("#makes_id").val();
		  var model_id= $("#model_id").val();
		  var upwd= $("#regupwd").val();
		  	var mobNo= $("#regmobNo").val();
			 var uname= $("#reguname").val();
	
		 if(regemail='')
		 {
			 $('#emailerror').html("error");
			 $('#reguname').focus();
		 }
		 else if(reguname='')
		 {
			  $('#emailerror').html("regu");
			 $('#reguname').focus();
		 } */
		/*  $.post('register',{
						   regemail:regemail,
						   adrs:adrs,
						    location:location,
							  picdate:picdate,
							    pickhr:pickhr,
								amount:amount,
								packageid:packageid, 
								makes_id:makes_id,
								  model_id:model_id,
								  upwd:upwd,
								   mobNo:mobNo, 
								   uname:uname,
						  
						   
						   
				 },
					 function(data)
					 {
					//alert(data);
					 if(data==1)
					{
					 window.location="AddVehicle";
					}  
					 });  */ 
	 });
	 //-----------
	 $('#btnsub').click(function()
	 {
		
		
		//customer vehicle added details
		
		// model_id=$("#model_id").val();
		var uname= $("#uname").val();
		var password= $("#password").val();
		
		 var makes_id= $("#makes_id").val();
		var model_id= $("#model_id").val();
		var pickadrs= $("#adrs").val();
		var picdate= $("#picdate").val();
		
		var pickhr= $("#pickhr").val(); 
		var amount= $("#amount").val(); 
		
		var packageid= $("#package").val(); 
		
		 $.post('loginuser',{
						  uname:uname,
						  password:password,
						  pickadrs:pickadrs,
						  picdate:picdate,
						  pickhr:pickhr,
						  makes_id:makes_id,
						  model_id:model_id, 
						  amount:amount,
						  packageid:packageid,
						  
						 
				 },
					 function(data)
					 {
					//alert(data);
					if(data==1)
					{
						$("#loginerror").html('<font color=red>Invalid username and password</font>');
					}
					else
					{
						window.location="AddVehicle";
					}
					 });  
	 });
	 //------------
	
	/*  $.post('FetchRepairLists',{
						plan:'basic',
						model_id:model_id,
					},
					function(data)
					{
						alert(data);
						 datas=data.split('**');
						$("#basicdata").html(datas[0]);
						$("#estamt").html(datas[1]);
						$("#esthour").html(datas[2]); 
						
					});  */
	
	 $('#basic').click(function()
	  {
		// makes_id=$("#makes_id").val();
		 model_id=$("#model_id").val();
		//falert(model_id);
		  $.post('FetchRepairLists',{
						//makes_id:makes_id,
						model_id:model_id,
					},
					function(data)
					{
						//alert(data);
						datas=data.split('**');
						$("#basicdata").html(datas[0]);
						$("#estamt").html(datas[1]);
						 $("#amount").val(datas[1]);
							$("#package").val('1'); 
							 $("#esthour").html(datas[2]);
					}); 
	  });
	 $('#elite').click(function()
	  {
		 /* makes_id=$("#makes_id").val(); */
		 model_id=$("#model_id").val();
		  $.post('FetchRepairListsElite',{
						// makes_id:makes_id,
						model_id:model_id
						
					},
					function(data)
					{
					 datas=data.split('**');
						//$("#basicdata").html(data[0]);
					 $("#elitedata").html(datas[0]);
					 $("#estamt").html(datas[1]);
					 $("#amount").val(datas[1]);
					 $("#package").val('2'); 
					  $("#esthour").html(datas[2]);
					}); 
	  });
	  
	  
	   $('#advance').click(function()
	  {
		 /* makes_id=$("#makes_id").val(); */
		 model_id=$("#model_id").val(); 
		  $.post('FetchRepairListsAdvance',{
						/* makes_id:makes_id, */
						model_id:model_id
					},
					function(data)
					{
					 datas=data.split('**');
					 $("#advancedata").html(datas[0]);
					 $("#estamt").html(datas[1]);
					  $("#amount").val(datas[1]);
					  $("#package").val('3'); 
					   $("#esthour").html(datas[2]);
							
					}); 
	  });
	
	$('.services').change(function() {
		services=$('.services').val();
		$("#servnm").val(services);
	});
	$('#carlist li').click(function() {
     //Get the id of list items
       var vmakeid = $(this).attr('id');
	   $('#makes_id').val(vmakeid);
	    $('#makes_idd').val(vmakeid);
		//return false;
     // alert($( "li " ).text());
	 
				//alert(vmakeid);
				$.post('Getvmodel',{
						Maker:vmakeid,
					},
					function(data)
					{
							//alert(data);
							
					     $("#modellist").html(data);
							
					});
			
   });
   $("#modellist").on('click','li',function (){
	   var modelid = $(this).attr('id');
	    $('#model_id').val(modelid);
		 $('#model_idd').val(modelid);
	  
    text1=$(this).text();
	$('#span1').text(text1);
	
});
   
   
});



</script>

<style type="text/css">
.modal-header{
    border-bottom: none;
}
    @media screen and (min-width: 768px) {
        .modal-dialog {
          width: 760px; /* New width for default modal */
        }
        .modal-sm {
          width: 380px; /* New width for small modal */
        }
    }
    @media screen and (min-width: 992px) {
        .modal-lg {
          width: 950px; /* New width for large modal */
        }
    }
</style>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Track Your Vehicle</h4>
      </div>
      <div class="modal-body">
	   
        <p>Track you vehichle by clicking download app button
		 
		
		</p>
		<div class="pull-left dwn-app">
                        <a href="" class="btn btn-submit btn-theme">Download App <i class="fa fa-mobile animated" aria-hidden="true"></i></a>
                    </div>
					<br/><br/><br/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<input type="hidden" name="amount" id="amount"/>
<input type="hidden" name="package" id="package"/>
<?php

				if(empty(Yii::app()->session['username']))
				{
				echo  '<div class = "customer-signup modal fade" id = "signup-model" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog">
      <div class = "modal-content pull-left">
      <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;</button>       
         <div class = "modal-body pull-left">
            <div class="aside-signup col-md-4">
                <h3 class="block-title">Signup Today and You will be able to</h3>
                    <ul class="list-check">
                        <li>Online Order Status</li>
                        <li>See Ready Hot Deals</li>
                        <li>Love List</li>
                        <li>Sign up to receive exclusive news and private sales</li>
                        <li>Quick Buy Stuffs</li>
                    </ul>
            </div><div class="col-md-8">
                <ul id = "myTab" class = "nav nav-tabs">
                    <li class = "active">
                        <a href = "#logintab" data-toggle = "tab">Login</a>
                    </li>
                    <li>
                        <a href = "#signuptab" data-toggle = "tab">Sign Up</a>
                    </li>   
                </ul>

				
				<!---login block-->
				<div id = "myTabContent" class = "tab-content">
                   <div class = "tab-pane fade in active" id = "logintab">
                      <div class="col-sm-12">
                        
						<input type="hidden" name="makes_idd" id="makes_idd">
				    <input type="hidden" name="model_idd" id="model_idd">
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control" type="text" name="uname" id="uname" placeholder="User name or email"></div>
                                </div>                               
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control" type="password" name="password" id="password" placeholder="Enter Password"></div>
                                </div>
                                <div class="bottomservice-btn overflowed reservation-now col-md-12 col-lg-6">
                                    <div class="checkbox pull-left">
                                        <input type="checkbox" name="remember" id="checkboxa1">
                                        <label for="checkboxa1">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6 text-right-lg">
                                    <a href="#" class="forgot-password">forgot password?</a>
                                </div>
                                <div class="col-md-12 text-center">
								
								<div id="loginerror"></div>
								<input type="submit" value="Login" id="btnsub" name="btnsub" class="col-md-12 btn btn-theme"></div>
                                <div class="col-md-6 mrg-top-20">
                                    <a href="#" class="btn btn-theme btn-block btn-icon-left facebook"><i class="fa fa-facebook"></i>Login with Facebook</a>
                                </div>
                                <div class="col-md-6 mrg-top-20">
                                    <a href="#" class="btn btn-theme btn-block btn-icon-left google"><i class="fa fa-google-plus" aria-hidden="true"></i>Login with Google</a>
                                </div>                                
                                
                        
                    </div>
                   </div>                   
                   <div class = "tab-pane fade" id = "signuptab">
				 
                    <div class="col-md-12">
                        <div class="form-group"><input class="form-control alt" type="text" name="regemail" id="regemail"  placeholder="Enter Email*" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="text" name="reguname" id="reguname" placeholder="Name" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-icon has-label">
                            <input type="text" class="form-control alt" id="regmobNo" name="regmobNo" placeholder="Enter Mobile Number*" maxlength="10" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="password" name="regupwd" id="regupwd" placeholder="Enter Password*" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password*" required></div>
                        <div class="col-md-6">                    
                    </div>
                   </div>
				  
                   <div class="col-md-12 text-center"><input type="button" value="Create Account" id="register1" name="register1" class="col-md-12 btn btn-theme"></div>
                   <div class="col-md-6 mrg-top-20">
				   <div id="emailerror">dfggsdg</div>
                        <a href="#" class="btn btn-theme btn-block btn-icon-left facebook"><i class="fa fa-facebook"></i>Sign in with Facebook</a>
                    </div>
                    <div class="col-md-6 mrg-top-20">
                        <a href="#" class="btn btn-theme btn-block btn-icon-left google"><i class="fa fa-google-plus" aria-hidden="true"></i>Sign in with Google</a>
                    </div>
                   </div>
				   
            </div>
			
         </div>
         
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.Registration Sign up Modal -->
</div>';
				}
				
				?>
<!-- BREADCRUMBS -->
 <form method="post" action="Bookingsevicedetails" enctype="multipart/form-data">
        <section class="bookservice-main page-section breadcrumbs">
            <div class="container">			
			<?php
			if(empty(Yii::app()->session['username']) && isset(Yii::app()->session['bookloc']) && isset(Yii::app()->session['picdate']) && isset(Yii::app()->session['bookhour']))
						{
						}
						
						
			
			?>
            
            <div class="col-md-6 text-right">
                <div class="page-header">
                    <h1>Book a Service</h1>
                </div>
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Pages</a></li>
                    <li class="active">Booking &amp; Payment</li>
                </ul>
            </div>
            </div>
        </section>
        <!-- /BREADCRUMBS -->

        <!-- PAGE WITH SIDEBAR -->
        <section class="page-section with-sidebar sub-page">
            <div class="container">
                <div class="row">
				    <input type="hidden" name="makes_id" id="makes_id">
				    <input type="hidden" name="model_id" id="model_id">
				    <input type="hidden" name="servnm" id="servnm">
				    <input type="hidden" class="form-control alt"  name="location" id="location" placeholder="Enter Your Location">
                </div>
                    <!-- CONTENT -->
                    <div class="col-md-9 content" id="content">
                   
                    <div class="form-group has-icon has-label">
                        <h2>Vehicle Category</h2>
                        <div class="vehiclestype">
                            <div class="col-sm-6 text-center">
                                <a href="#addcar" class="active"><i aria-hidden="true" class="fa fa-car"></i>
                                <h2>Car</h2></a>
                            </div>
                            <div class="col-sm-6 text-center">
                                <a href="#addbike"><i aria-hidden="true" class="fa fa-motorcycle"></i>
                                <h2>Bike</h2></a>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Category Car -->
                    <div id="addcar" class="vehicles">
						<?php
			if(empty(Yii::app()->session['username']))
						{
                           
                       echo '<div class="row">
                            <div class="col-sm-6">
                                    <div class="form-group has-icon has-label booksel">
                                    <label for="formSearchOffLocation3">Select Brand</label>
                                    <div id="carsbrand" class="wrapper-dropdown-3" tabindex="1">
									<span>Select The Car Brands</span>
									<ul class="dropdown scrollable-menu" id="carlist" require>';
										  foreach($vmakelist as $vmake) {
																					//echo $vmake['makes_name'];

																			echo '<li id="'.$vmake['makes_id'].'" class="cl">
																			<a href="#">'.$vmake['makes_name'].'
																			<img src="http://10.10.10.28/mps/MPS'.$vmake['logo_img'].'"></a></li>';
																			
																				}  
																			//	if(!empty($vmodel))
									/*{
										 foreach($vmodel as $vmode) {
																					//echo $vmake['makes_name'];

																			echo '<li id="'.$vmode['models_id'].'" class="cl">
																			<a href="#">'.$vmode['models_name'].
																			' <img src="http://10.10.10.28/mps/MPS'.$vmode['imgpath'].'"></a></li>';
																			
																				} 
						     }*/
									echo'</ul>
									<div class="form-control-icon"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
                                    </div>
                                    
                                    </div>
                                </div>
                            <div class="col-sm-6">
                                <div class="form-group has-icon has-label booksel">
                                    <label for="formSearchOffLocation3">Select Model</label>
                                    <div id="carsmodel" class="wrapper-dropdown-3" tabindex="1">
									<span id="span1">Select The Model</span>
									<ul class="dropdown scrollable-menu" id="modellist">
										
									</ul>
									<div class="form-control-icon"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
                                    </div>
                                    
                                </div>
                            </div>
                            </div>';
						}
						else if(!empty(Yii::app()->session['username']))
						{
							     echo '<div class="row">
                         
                            <div class="col-sm-6">
                                <div class="form-group has-icon has-label booksel">
                                    <label for="formSearchOffLocation3">Select Model</label>
                                    <div id="carsmodel" class="wrapper-dropdown-3" tabindex="1">
									<span id="span1">Select The Model</span>
									<ul class="dropdown scrollable-menu" id="modellist" require>';
									if(!empty($vmodel))
									{
										 foreach($vmodel as $vmode) {
																					//echo $vmake['makes_name'];

																			echo '<li id="'.$vmode['models_id'].'" class="cl">
																			<a href="#">'.$vmode['models_name'].
																			' <img src="http://10.10.10.28/mps/MPS'.$vmode['imgpath'].'"></a></li>';
																			
																				} 
						     }
								echo'</ul>
									<div class="form-control-icon"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
                                    </div>
                                    
                                </div>
                            </div>
                            </div>';
						}
						?>                        
					    <div class="row">
                            <div class="col-md-12 bookingvhlc">
							 <div class="form-group">
                                <select id="carservices_sel" class="form-control services">
                                    <option>Select Services</option>
                                    <option value="general_serv">General</option>
                                    <option value="periodic_serv">Periodic</option>
                                    <option value="repair_serv">Repair Job</option>
                                    <option value="other_serv">Others</option>
                                    <option value="notsoure_serv">Not Sure</option>         
                                </select> 
                            </div>                         
                            </div>
                            <!-- General Service Code Start -->
                            <div id="general_serv" class="servicelist col-md-12" style="display:none;">
                            <div id="general_servtab"> 
                                <ul class="nav nav-pills">
                                    <li class="active"><a  href="#general_basic_plns" name="baisc" id="basic" data-toggle="tab" value='1'>Basic</a></li>
                                    <li><a href="#general_elite_plns" data-toggle="tab" name="elite" id="elite" value='2'>Elite</a></li>
                                    <li><a href="#general_advanced_plns" data-toggle="tab" name="advance" id="advance" value='3'>Advanced</a></li>
                                </ul>
                                <!-- Plans list tabs strat -->
                                <div class="tab-content clearfix">
                                <!-- Basic Plans list strat -->
                                    <div class="tab-pane active" id="general_basic_plns">
									   <div id="basicdata"></div>                                 
                                   </div>
								    <div class="tab-pane" id="general_elite_plns">
									   <div id="elitedata"></div>                                 
                                   </div>
								    <div class="tab-pane" id="general_advanced_plns">
									   <div id="advancedata"></div>                                 
                                   </div>
                                    
                            </div>
                            <div class="bottomservice-btn overflowed reservation-now">                         
                             <a class="btn btn-theme pull-right btn-theme-dark" href="#">Cancel</a>
                            <!--<input type="submit" name="books" id="books" value="Book a Service" data-target = "#signup-model" class="btn btn-theme pull-right">-->
<?php
							if(empty(Yii::app()->session['username']))
						{
                            echo '<a class = "btn btn-theme pull-right" id="btnsub1" data-toggle = "modal" data-target = "#signup-model">Book a Service</a>';
						}
						else
						{
							echo '<a class = "btn btn-theme pull-right" id="btnsub1" data-toggle = "modal" data-target = "#myModal">Book a Service</a>';
						}
							?>
							<!--<input type="button" value="Book A Service" id="btnsub1" name="btnsub1" data-target = "#signup-model" class="col-md-12 btn btn-theme">-->
                          
                            </div> 
                            <!-- End Plans list tabs strat -->
                            </div>
                            </div>
                            <!-- Periodic Service Code -->
                            <div id="periodic_serv" class="servicelist col-md-12" style="display:none;">
                            <div id="periodic_servtab"> 
                                <ul class="nav nav-pills">
                                    <li class="active"><a href="#periodic_list1" id="periodic1000" data-toggle="tab">1000</a></li>
                                    <li><a href="#periodic_list2" data-toggle="tab" id="periodic5000">5000</a></li>
                                    <li><a href="#periodic_list3" data-toggle="tab" id="periodic10000">10000</a></li>
                                    <li><a href="#periodic_list4" data-toggle="tab" id="periodic20000">20000</a></li>
                                    <li><a href="#periodic_list5" data-toggle="tab" id="periodic30000">30000</a></li>
                                    <li><a href="#periodic_list6" data-toggle="tab" id="periodic40000">40000</a></li>
                                    <li><a href="#periodic_list7" data-toggle="tab" id="periodic50000">50000</a></li>
                                    <li><a href="#periodic_list8" data-toggle="tab" id="periodic60000">60000 +</a></li>
                                </ul>
                                <!-- Plans list tabs strat -->
                                <div class="tab-content clearfix">
                                <!-- Basic Plans list strat -->
                                <div class="tab-pane active" id="periodic_list1">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Recommended Services</legend>
                                        <div class="col-md-4">
                                            <h3 class="block-title">Air Conditioning</h3>
                                            <ul class="list-check">
                                                <li>Compressor Check</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 class="block-title">Battery</h3>
                                            <ul class="list-check">
                                                <li> Battery Water Topup</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 class="block-title">Oils &amp; fluids</h3>
                                            <ul class="list-check">
                                                <li>Coolant Topup</li>
                                                <li>Engine Oil Replace</li>
                                                <li>Grease Topup</li>
                                                <li>Wiper Fluid Topup</li>
                                            </ul>
                                        </div>
                                </fieldset>
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Additional Services</legend>
                                <div class="row clear">
                                        <div class="col-md-4">
                                        <h3 class="block-title"><input type="checkbox" name=""> Lighting</h3>
                                        <ul class="list-check">
                                            <li>Head Lamp Check</li>
                                            <li>Tail Lamp Check</li>
                                        </ul>
                                        </div>
                                        <div class="col-md-4">
                                        <h3 class="block-title">Air Conditioning</h3>
                                        <ul class="list-check">
                                            <li>Compressor Check</li>
                                        </ul>
                                        </div>
                                        <div class="col-md-4">
                                        <h3 class="block-title">Battery</h3>
                                        <ul class="list-check">
                                            <li> Battery Water Topup</li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                        <h3 class="block-title">Horns</h3>
                                        <ul class="list-check">
                                            <li>Horns Check</li>
                                        </ul>
                                        </div>
                                        <div class="col-md-4">
                                        <h3 class="block-title">Spark Plugs</h3>
                                        <ul class="list-check">
                                            <li>Spark Plugs Clean</li>
                                        </ul>
                                        </div>
                                        <div class="col-md-4">
                                        <h3 class="block-title">Instrument Clustor</h3>
                                        <ul class="list-check">
                                            <li>Instrument Clustor Check</li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                        <h3 class="block-title">Oils &amp; fluids</h3>
                                        <ul class="list-check">
                                            <li>Coolant Topup</li>
                                            <li>Engine Oil Replace</li>
                                            <li>Grease Topup</li>
                                            <li>Wiper Fluid Topup</li>
                                        </ul>
                                        </div>
                                        <div class="col-md-4">
                                        <h3 class="block-title">Filters</h3>
                                        <ul class="list-check">
                                            <li>Air Filte Replace</li>
                                            <li>Engine Oil Filte Replace</li>
                                        </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 class="block-title">Clutch</h3>
                                            <ul class="list-check">
                                                <li>Clutch Plate</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-4">
                                        <h3 class="block-title">Steering</h3>
                                        <ul class="list-check">
                                            <li>Basic Steering Functionality Check</li>
                                            <li>Power Steering Check</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h3 class="block-title">Spring</h3>
                                        <ul class="list-check">
                                            <li>Basic Ball Joints Functionality Check</li>
                                        </ul>
                                    </div>                                        
                                    <div class="col-md-4">
                                        <h3 class="block-title">Hydrulic Brakes</h3>
                                        <ul class="list-check">
                                            <li>Basic Brakes Functionality Check</li>
                                        </ul>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h3 class="block-title">Parking Brake</h3>
                                            <ul class="list-check">
                                                <li>Brake Lever Check</li>
                                            </ul>                                        
                                        </div>
                                        <div class="col-md-4">
                                            <h3 class="block-title">Exterior Cleaning</h3>
                                            <ul class="list-check">
                                                <li>Body &amp; Polish Clean</li>
                                                <li>Bumpers Cleaning Clean</li>
                                                <li>Doors Cleaning Clean</li>
                                                <li>Windows Cleaning Clean</li>
                                                <li>Windsheild Cleaning</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 class="block-title">Interior Cleaning</h3>
                                            <ul class="list-check">
                                                <li>Indoor Gates Cleaning</li>
                                                <li>Indoor Glass Cleaning</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h3 class="block-title">Under the hood cleaning</h3>
                                            <ul class="list-check">
                                                <li>Battery Terminal Corrosion Clean</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 class="block-title">Wheel</h3>
                                            <ul class="list-check">
                                                <li>Alignment Check</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 class="block-title">Mirrors</h3>
                                            <ul class="list-check">
                                                <li>ORVM Check</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h3 class="block-title">Locking</h3>
                                            <ul class="list-check">
                                                <li>Central Locking Check</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 class="block-title">Wiring</h3>
                                            <ul class="list-check">
                                                <li>Harnessing Check</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                        <h3 class="block-title">Exterior Body</h3>
                                        <ul class="list-check">
                                            <li>Bumpers Check</li>
                                            <li>Door Handles Check</li>
                                            <li>Door Hinges Check</li>
                                            <li>Door Locking System Check</li>
                                            <li>Windsheild Check</li>
                                            <li>Wiper Check</li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                        <h3 class="block-title">Interior Body</h3>
                                        <ul class="list-check">
                                            <li>Console Check</li>
                                            <li>Door Latch System Check</li>
                                            <li>Panels Check</li>
                                        </ul>
                                        </div>
                                        <div class="col-md-4">
                                        <h3 class="block-title">Denting / Painting</h3>
                                        <ul class="list-check">
                                            <li>Dent Check</li>
                                            <li>Full Body Paint Check</li>
                                        </ul>
                                        </div>
                                        <div class="col-md-4">
                                        <h3 class="block-title">Under the Hood Noice</h3>
                                        <ul class="list-check">
                                            <li>Belts &amp; Pulleys Noise Check</li>
                                            <li>Dead Battery Noise Check</li>
                                            <li>Hoses Noise Check</li>
                                            <li>Manifold Noise Check</li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="row">                                        
                                        <div class="col-md-4">
                                        <h3 class="block-title">Under the Body Noice</h3>
                                        <ul class="list-check">
                                            <li>Brake Noise Check</li>
                                            <li>Exhaust System Noise Check</li>
                                            <li>Suspension Noise Check</li>
                                        </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 class="block-title">Outside the Car Noice</h3>
                                            <ul class="list-check">
                                                <li>Tyre &amp; Aerodynamic Noise</li>
                                            </ul>
                                        </div>
                                        </div>
                                        </fieldset>                                                             
                                   </div>
                                    <div class="tab-pane" id="periodic_list2">
                                       5000                         
                                   </div>
                                    <div class="tab-pane" id="periodic_list3">
                                       10000                              
                                   </div>
                                    <div class="tab-pane" id="periodic_list4">
                                       20000                              
                                   </div>
                                    <div class="tab-pane" id="periodic_list5">
                                       30000                                
                                   </div>
                                    <div class="tab-pane" id="periodic_list6">
                                       40000                              
                                   </div>
                                    <div class="tab-pane" id="periodic_list7">
                                       50000                                
                                   </div>
                                    <div class="tab-pane" id="periodic_list8">
                                       60000                                
                                   </div>
                                    
                            </div>
                            <div class="bottomservice-btn overflowed reservation-now">                         
                             <a class="btn btn-theme pull-right btn-theme-dark" href="#">Cancel</a>
                           <!-- <input type="submit" name="books" id="books" value="Book a Service" data-target = "#signup-model" class="btn btn-theme pull-right">-->
						
                          <!--  <a class = "btn btn-theme pull-right" data-toggle = "modal" data-target = "#signup-model">Book a Service</a>-->
						  <input type="button" value="Book A Service" id="btnsub" name="btnsub" class="col-md-12 btn btn-theme">
                          
                            </div> 
                            <!-- End Plans list tabs strat -->
                            </div>  
                            </div>
                            <!-- Repair Job Service Code -->
                            <div id="repair_serv" class="servicelist" style="display:none;">
                                Repair Job
                            </div>
                            <!-- Others Service Code -->
                            <div id="other_serv" class="servicelist" style="display:none;">
                                Others
                            </div>
                            <!-- Not source Service Code -->
                            <div id="notsoure_serv" class="col-md-12 servicelist" style="display:none;">
                                    <div class="form-group">
                                    <textarea class="form-control alt" placeholder="Addıtıonal Informatıon" name="addinfo" id="addinfo" cols="30" rows="10" style="height:120px;"></textarea></div>
                                    <h3 class="block-title alt describe">Describe More</h3>
                                    <div class="form-group">
                                        <div class="text-right"><i class="fa fa-headphones" aria-hidden="true"></i> | 
                                        <i class="fa fa-video-camera" aria-hidden="true"></i></div>
                                        <input type="file" name="vefinfo" id="vefinfo" class="form-control">
                                    </div>  
                            </div>                           
                            </div>
                            </div>
							</form>
                         <!-- End Vehicle Category Car -->

                         <!-- Vehicle Category Bike -->
                            <div id="addbike" class="vehicles">
                                Bike
                            </div>
                         <!-- End Vehicle Category Bike -->
	<?php
			if(empty(Yii::app()->session['username']))
						{
                           
						echo '<!-- <h3 class="block-title alt">Customer Information</h3>
                       
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="radio radio-inline">
                                        <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                                        <label for="inlineRadio1">Mr</label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <input type="radio" id="inlineRadio2" value="option1" name="radioInline">
                                        <label for="inlineRadio2">Ms</label>
                                    </div>
                                </div>
                               <div class="col-md-6">
                                    <div class="form-group"><input class="form-control alt" type="text" name="uname" id="uname" placeholder="Name:*" required></div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control alt" type="text" name="emailId" id="emailId" placeholder="Your Email Address:*" required></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-icon has-label">
                                        <input type="text" class="form-control alt" id="mobNo" name="mobNo" placeholder="Mobile Number:" maxlength="10" required>
                                    </div>
                                </div>
								
								<div class="col-md-12"><h3 class="block-title alt">Create Account</h3></div>
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control alt" type="text" name="Usernmame" id="Usernmame"  placeholder="Enter User Name:*" required></div>
								</div>
								<div class="col-md-12">
									<div class="form-group"><input class="form-control alt" type="password" name="upwd" id="upwd" placeholder="Enter Password:" required></div>
                                </div>
                                <div class="col-md-12">
									<div class="form-group"><input class="form-control alt" type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password:" required></div>
                                </div>
                            </div> -->
                       ';
						}?>
                    <!--</form>-->
                    </div>
                    <!-- /CONTENT -->

                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar" id="sidebar">
                    <!-- widget Vehicle Servicing Details -->
                        <div class="widget shadow widget-helping-center estimate-widget">
                            <h4 class="widget-title">Vehicle Servicing</h4>
                            <div class="widget-content">
                                <h5>Type of Service</h5>
								<span><div id="typeserve"></div></span>
                                <!--<ul>
                                    <li>oil Service</li>
                                    <li>Washing<li>
                                    <li>General Service<li>
                                </ul>-->
                                <h5>Estimated Hour</h5>
								<span><div id="esthour"></div></span>
                                <span><?php echo Yii::app()->session['bookhour'];?></span>
                                <h5>Estimated Amount</h5>
                               <span><div id="estamt"></div></span>
								
                            </div>
                        </div>
                        <!-- widget testimonials -->
                        <div class="widget shadow">
                            <div class="widget-title">Testimonials</div>
                             <div class="carousel slide" id="testimonials" data-ride="carousel">   
                                <div class="carousel-inner">
                                    <div class="item active">
                                          <div class="media">
                                            <div class="media-body">
                                              <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                              <div class="testimonial-name">John Doe <span class="testimonial-position">Co- founder at Rent It</span></div>
                                            </div>
                                          </div>
                                        </div>
                                        
                                        <div class="item">
                                          <div class="media">
                                            <div class="media-body">
                                              <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                              <div class="testimonial-name">John Doe <span class="testimonial-position">Co- founder at Rent It</span></div>
                                            </div>
                                          </div>
                                        </div>
                                        
                                        <div class="item">
                                          <div class="media">
                                            <div class="media-body">
                                              <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                              <div class="testimonial-name">John Doe <span class="testimonial-position">Co- founder at Rent It</span></div>
                                            </div>
                                          </div>
                                        </div>
                                        <ol class="carousel-indicators">
                                            <li data-target="#testimonials" data-slide-to="0" class="active"></li>
                                            <li data-target="#testimonials" data-slide-to="1"></li>
                                            <li data-target="#testimonials" data-slide-to="2"></li>
                                        </ol>
                                </div>
                            </div>
                        </div>
                        <!-- /widget testimonials -->
                        <!-- widget helping center -->
                        <div class="widget shadow widget-helping-center">
                            <h4 class="widget-title">Helping Center</h4>
                            <div class="widget-content">
                                <p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.</p>
                                <h5 class="widget-title-sub">+90 555 444 66 33</h5>
                                <p><a href="mailto:support@supportcenter.com">support@supportcenter.com</a></p>
                                <div class="button">
                                    <a href="#" class="btn btn-block btn-theme btn-theme-dark">Support Center</a>
                                </div>
                            </div>
                        </div>
                        <!-- /widget helping center -->
                    </aside>
                    <!-- /SIDEBAR -->

                </div>
        </section>
        <!-- /PAGE WITH SIDEBAR -->
			
<script type="text/javascript">
//vehicle category code
    $('.vehiclestype').each(function(){
        
            var $active, $content, $links = $(this).find('a');

            $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
            $active.addClass('active');
            $content = $($active.attr('href'));
            
            $links.not($active).each(function () {
                $($(this).attr('href')).hide();
            });
            
            $(this).on('click', 'a', function(e){
                var c = this;
                $active.removeClass('active');
                $content.fadeOut(300, function()
                                 {
                                     $active = $(c);
                                     $content = $($(c).attr('href'));
                                     
                                     $active.addClass('active');
                                     $content.fadeIn(300);
                                 });
                e.preventDefault();
            });
        });
    // services selct options
    $('#carservices_sel').change(function(){
		
	//alert($('#carservices_sel').val();
		// makes_id=$("#makes_id").val();
		 model_id=$("#model_id").val();
		//alert(model_id);
		  $.post('FetchRepairLists',{
						//makes_id:makes_id,
						model_id:model_id,
					},
					function(data)
					{
						//alert(data);
						datas=data.split('**');
						$("#basicdata").html(datas[0]);
						$("#estamt").html(datas[1]);
						 $("#amount").val(datas[1]);
						 $("#esthour").html(datas[2]);
					      $("#package").val('1'); 
							
					}); 
	  
		
            $('.servicelist').hide();
            $('#' + $(this).val()).show();
        });
</script>

<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dropdownscript.js"></script>
