<?php

?>

 


<script>
$(document).ready(function()
{
	
	$("#usertot").hide();
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
		//alert(regemail);
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
		
		
	 });
	 //-----------
	 
	  $('#btnsub2').click(function()
		 {
			 carservices_sel=$('#carservices_sel').val();
			 if(carservices_sel=='periodic_serv')
			{
			    pkid=$('#package').val();
				model_id=$('#model_id').val();
			    usertot=$('#amttxt').val();
				//alert(usertot);
				value=$('#val'+pkid).val();
				$.post('Updateuserpackage',{
						
						  value:value,
						  model_id:model_id,
						//  usertot:usertot,
						   pkid:pkid
						 
						  
						 
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
		}
		else if(carservices_sel=='repair_serv')
		{
				
				value=$('#valrep3').val();
				model_id=$('#model_id').val();
				
				$.post('Updateuserpackage',{
						
						  value:value,
						  model_id:model_id
						
						 
						  
						 
				 },
					 function(data)
					 {
					
					  /*if(data==1)
					{
						$("#loginerror").html('<font color=red>Invalid username and password</font>');
					}
					else
					{
						window.location="AddVehicle";
					}   */
					 }); 
		}
							
				
		 });
	 $('#btnsub').click(function()
	 {
		
		carservices_sel=$('#carservices_sel').val();
		//customer vehicle added details
	    if(carservices_sel=='periodic_serv')
		{
				pkid=$('#package').val();
				
				valto=$('#val'+pkid).val();
				
				model_id=$('#model_id').val();
				makes_id=$('#makes_id').val();
				
				uname=$('#uname').val();
				usertot=$('#amttxt').val();
				if(usertot=='')
				{
					usertot=$('#amtpackage').val();
				}
				else{
					usertot=usertot;
				}
				//alert(amtpackage);
				$.post('Updateuserpackage',{
						  uname:uname,
						  value:valto,
						  serviceid:2,
						  model_id:model_id,
						  makes_id:makes_id,
						  usertot:usertot,
						  pkid:pkid
						  
						 
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
		}
		else if(carservices_sel=='repair_serv')
		{
			
				value=$('#valrep3').val();
				uname=$('#uname').val();
				model_id=$('#model_id').val();
				makes_id=$('#makes_id').val();
				$.post('Updateuserpackage',{
						  uname:uname,
						  value:value,
						  model_id:model_id,
						  makes_id:makes_id,
						  
						 
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
		}
		else
		{
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
		}
	 });
	
	 $('#basic').click(function()
	  {
		  $("#usertot").show();
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
						$("#typeservice").html('<b>General Service</b><br/><b>Basic</b>'); 
							 
						$("#usertot").html('Total:'+datas[1]+'/-');
					}); 
	  });
	 $('#elite').click(function()
	  {
		  $("#usertot").show();
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
					   $("#usertot").html('Total:'+datas[1]+'/-');
					  $("#usertot").html('Total:'+datas[1]);
					}); 
	  });
	  
	  
	   $('#advance').click(function()
	  {
		  $("#usertot").show();
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
					    $("#typeservice").html('<b>General Service</b><br/><b>Advanced</b>'); 
						 $("#usertot").html('Total:'+datas[1]+'/-');
							
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
	     $('#other_makes_id').val(vmakeid);
	  
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
		 $('#other_model_id').val(modelid);
		 $('#model_idd').val(modelid);
	  
    text1=$(this).text();
	$('#span1').text(text1);
	vmakeid =  $('#makes_id').val();
	  modelid=$('#model_id').val();
	$.post('FetchmodelImage',{
						makeid:vmakeid,
						modelid:modelid
					},
					function(data)
					{
							//alert(data);
							datas=data.split('**');
							 $('#carimg').html("<img src=http://metrepersecond.com/MPS"+datas[0]+" name='carimg' id='carimg' height='100%' width='100%'>");
							 $('#brand').html('<b>'+datas[1]+'</b>');
							 $('#model').html('<b>'+datas[2]+'</b>');
						
					});
			
	
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
<!--<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">-->

    <!-- Modal content-->
   <!-- <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Track Your Vehicle</h4>
      </div>
      <div class="modal-body">
	   
        <p>Track you vehichle by clicking download app button</p>

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
</div>-->
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
							echo '<div class="col-md-6">
                <div class="page-header">
                    <div class="form-group has-icon has-label col-sm-12">
                      <label>&nbsp;</label>
                      <input class="form-control alt geocomplete" type="text" name="adrs" id="adrs" placeholder="picked customer location address" value="'.Yii::app()->session['bookloc'].'" required>
                      <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>  
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group has-icon has-label">
                        <label>&nbsp;</label>
                        <input type="text" class="form-control" id="picdate" name="picdate" placeholder="Picking Up Date" value="'.Yii::app()->session['picdate'].'" required>
                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group has-icon has-label">
                        <label>&nbsp;</label>
                        <input type="text" class="form-control" id="pickhr" name="pickhr" placeholder="Picking Up Hour" value="'.Yii::app()->session['bookhour'].'" required>
                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                    </div>
                    </div>
            </div>
            </div>';
						}
						if(empty(Yii::app()->session['username']) && !isset(Yii::app()->session['bookloc']) && 
						!isset(Yii::app()->session['picdate']) && !isset(Yii::app()->session['bookhour']))
						{
							echo '<div class="col-md-6">
                <div class="page-header">
                    <div class="form-group has-icon has-label col-sm-12">
                      <label>&nbsp;</label>
                      <input class="form-control alt geocomplete" type="text" name="adrs" id="adrs" placeholder="picked customer location address" value="'.Yii::app()->session['bookloc'].'" required>
                      <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>  
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group has-icon has-label">
                        <label>&nbsp;</label>

                        <input type="text" class="form-control" id="picdate" name="picdate" placeholder="Picking Up Date" value="'.Yii::app()->session['picdate'].'" required>
                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group has-icon has-label">
                        <label>&nbsp;</label>
                        <input type="text" class="form-control" id="pickhr" name="pickhr" placeholder="Picking Up Hour" value="'.Yii::app()->session['bookhour'].'" required>
                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                    </div>
                    </div>
            </div>
            </div>';
						}
						else{
							
							echo '
                      <input class="form-control alt geocomplete" type="hidden" name="adrs" id="adrs" placeholder="picked customer location address" value="'.Yii::app()->session['bookloc'].'" required>
                     <input type="hidden" class="form-control" id="pickhr" name="pickhr" placeholder="Picking Up Hour" value="'.Yii::app()->session['bookhour'].'"
					 <input type="text" class="form-control" id="picdate" name="picdate" placeholder="Picking Up Date" value="'.Yii::app()->session['picdate'].'" required>
					 
					 ';
					 
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
                        <h2 class="vhls-title">Vehicle Category</h2>
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
                    <div class="row">
						<?php
			if(empty(Yii::app()->session['username']))
						{
                           
                       echo '<div class="col-sm-4">
                                    <div class="form-group has-icon has-label booksel">
                                    <label for="formSearchOffLocation3">Select Brand</label>
                                    <div id="carsbrand" class="wrapper-dropdown-3" tabindex="1">
									<span>Select The Car Brands</span>
									<ul class="dropdown scrollable-menu" id="carlist" require>';
										  foreach($vmakelist as $vmake) {
																					//echo $vmake['makes_name'];

																			echo '<li id="'.$vmake['makes_id'].'" class="cl">
																			<a href="#">'.$vmake['makes_name'].'
																			<img src="http://metrepersecond.com/MPS'.$vmake['logo_img'].'"></a></li>';
																			
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
                            <div class="col-sm-4">
                                <div class="form-group has-icon has-label booksel">
                                    <label for="formSearchOffLocation3">Select Model</label>
                                    <div id="carsmodel" class="wrapper-dropdown-3" tabindex="1">
									<span id="span1">Select The Model</span>
									<ul class="dropdown scrollable-menu" id="modellist">
										
									</ul>
									<div class="form-control-icon"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
                                    </div>
                                    
                                </div>
                            </div>';
						}
						else if(!empty(Yii::app()->session['username']))
						{
							     echo '<div class="col-sm-4">
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
                            </div>';
						}
						?>                        
</form>
<input type="hidden" name="amttxt" id="amttxt"/>                            <div class="col-sm-4 bookingvhlc">                                    
<input type="hidden" name="amtpackage" id="amtpackage"/>
<?php 
if(empty(Yii::app()->session['username']))
{
							echo '<div class="form-group has-icon has-label booksel">
							 <label for="formSearchOffLocation3">Select Service</label>
                                <select id="carservices_sel" class="form-control services">
                                    <option>Select Services</option>
                                    <option value="general_serv">General</option>
                                    <option value="periodic_serv">Periodic</option>
                                    <option value="repair_serv">Repair Job</option>
                                    <option value="other_serv">Others</option>
                                    <option value="notsoure_serv">Exclusive Service</option>         
                                </select> 
                            </div>';
}
?>							
                            </div>
                            </div>
                            <!-- General Service Code Start -->
                            <div class="row">
                            <div id="general_serv" class="servicelist col-md-12" style="display:none;">
                            <div id="general_servtab"> 
                                <ul class="nav nav-pills">
                                    <li class="active"><a  href="#general_basic_plns" name="basic" id="basic" data-toggle="tab" value='1'>Basic</a></li>
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
                             
                            <!-- End Plans list tabs strat -->
                            </div>
                            </div>
                            <!-- Periodic Service Code -->
                            <div id="periodic_serv" class="servicelist col-md-12" style="display:none;">
                            <div id="periodic_servtab"> 
							<div id="pktot" class="pull-left bks-pkg">Package: <i class="fa fa-inr"></i></div>
							
                                <ul class="nav nav-pills">
                                    <li class="active"><a href="#periodic_list1" id="ten" name="ten "data-toggle="tab">10000</a></li>
                                    <li><a href="#periodic_list2" data-toggle="tab" id="twenty" name="twenty" >20000</a></li>
                                    <li><a href="#periodic_list3" data-toggle="tab" id="thirty" name="thirty">30000</a></li>
                                    <li><a href="#periodic_list4" data-toggle="tab" id="fourty" name="fourty">40000</a></li>
                                    <li><a href="#periodic_list5" data-toggle="tab" id="fifty" name="fifty">50000</a></li>
                                    <li><a href="#periodic_list6" data-toggle="tab" id="sixty" name="sixty">60000</a></li>                                   
                                </ul>
                                <!-- Plans list tabs strat -->
                                <div class="tab-content clearfix">
                                <!-- Basic Plans list strat -->
                                  <div class="tab-pane active" id="periodic_list1">
									                                
                                   </div>
                                    <div class="tab-pane" id="periodic_list2">
                                               
                                   </div>
                                    <div class="tab-pane" id="periodic_list3">
                                                            
                                   </div>
                                    <div class="tab-pane" id="periodic_list4">
                                                      
                                   </div>
                                    <div class="tab-pane" id="periodic_list5">
                                                       
                                   </div>
                                    <div class="tab-pane" id="periodic_list6">
                                                       
                                   </div>                                  
                                    
                            </div>
                         
                            <!-- End Plans list tabs strat -->
                            </div>  
                            </div>
                            <!-- Repair Job Service Code -->
							
                            <div id="repair_serv" class="servicelist" style="display:none;">
                                <div id="pktot1"></div>
							
								<div id="repjob"></div>
                            </div>
                            <!-- Others Service Code -->
                            <div id="notsoure_serv" class="servicelist" style="display:none;">
                                <textarea class="form-control alt" placeholder="Enter Vehicle Problem Here" name="userprob_info" id="userprob_info" cols="30" rows="10" style="height:120px;"></textarea>
								
                            </div>
                            <!-- Not source Service Code -->
                            <div id="other_serv" class="col-md-12 servicelist" style="display:none;">
							<form action="SaveOthers" method="post" name="otherform" id="otherform"  enctype="multipart/form-data">
							  <input type="text" name="other_makes_id" id="other_makes_id">
				             <input type="text" name="other_model_id" id="other_model_id">
                                    <div class="form-group">
                                    <textarea class="form-control alt" placeholder="Addıtıonal Informatıon" name="addinfo" id="addinfo" cols="30" rows="10" style="height:120px;" required></textarea></div>
                                    <h3 class="block-title alt describe">Describe More</h3>
                                    <div class="form-group">
                                        <div class="text-right"><i class="fa fa-headphones" aria-hidden="true"></i> | 
                                        <i class="fa fa-video-camera" aria-hidden="true"></i></div>
                                        <input type="file" name="vefinfo" id="vefinfo" class="form-control"/>
                                    </div>  
									<?php
									// if(isset($$message))
									// {
										// echo "Invalid File";
									// }
									// else{
										// $message='';
									// }
									?>
									 <input type="submit" name="othersub" id="othersub" class="form-control" data-target = "#signup-model">
							</form>
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
							echo '<a  href="BookingDetails" class = "btn btn-theme pull-right" id="btnsub2">Book a Service</a>';
						}
							?>
							<!--<input type="button" value="Book A Service" id="btnsub1" name="btnsub1" data-target = "#signup-model" class="col-md-12 btn btn-theme">"-->
                          
                            </div> 
                            </div>
							</form>
                         <!-- End Vehicle Category Car -->

                         <!-- Vehicle Category Bike -->
                          
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
						
							
							 <div class="aside-vhls-dtls">                            
	                           	<div id="carimg"></div>
	                        <span class="brnd-name" id="brand"></span><br>
	                        <span class="mdl-name" id="model"></span>
                            </div>
							
                                <h5>Type of Service</h5>
								<div id="typeservice">
									
								</div>
                                <h5>Estimated Hour</h5>
								<div id="esthour"><?php echo Yii::app()->session['bookhour'];?></span></div>
                                <h5>Estimated Amount</h5>
							
                               	<div id="estamt"></div>	
									<div id="total"></div>	
									<div id="usertot" class="pull-left totalcost">Total: <i class="fa fa-inr"></i></div>
								
                            </div>
                        </div>
                        
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
		carservices_sel=$('#carservices_sel').val();
		model_id=$("#model_id").val();
	if(carservices_sel=='general_serv')
	{
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
						  $("#typeservice").html('<b>General Service</b><br/><b>Basic</b>'); 
						  $("#usertot").html('Total:'+datas[1]+'/-');
							
					}); 
	}
	else if(carservices_sel=='other_serv')
	{
		  $('#btnsub').prop("disabled","disabled");
		   $('#btnsub2').prop("disabled","disabled");
	}
	else if(carservices_sel=='periodic_serv')
	{
		fetchPeriodicdata(model_id,4)
		$('#typeservice').html("<b>Periodic Service</b><br/><b>10,000 KM</b>");
		 $('#ten').click(function()
		{
			$('#typeservice').html("<b>Periodic Service</b><br/><b>10,000 KM</b>");
			plan=4;
			fetchPeriodicdata(model_id,plan);
		}); 
		$('#twenty').click(function()
		{
			$('#typeservice').html("<b>Periodic Service</b><br/><b>20,000 KM</b>");
			plan=5;
			fetchPeriodicdata(model_id,plan);
		}); 
	   $('#thirty').click(function()
		{
			$('#typeservice').html("<b>Periodic Service</b><br/><b>30,000 KM</b>");
			plan=6;
			fetchPeriodicdata(model_id,plan);
		}); 
	   $('#fourty').click(function()
		{
			$('#typeservice').html("<b>Periodic Service</b><br/><b>40,000 KM</b>");
			plan=7;
			fetchPeriodicdata(model_id,plan);
		});
		$('#fifty').click(function()
		{
			$('#typeservice').html("<b>Periodic Service</b><br/><b>50,000 KM</b>");
			plan=8;
			fetchPeriodicdata(model_id,plan);
		});
		$('#sixty').click(function()
		{
			$('#typeservice').html("<b>Periodic Service</b><br/><b>60,000 KM</b>");
			plan=9;
			fetchPeriodicdata(model_id,plan);
		});
	}
	else if(carservices_sel=='repair_serv')
	{
		
		 model_id=$("#model_id").val();
		 fetchRepairjob(model_id,3);
		
		 
	}
	else if(carservices_sel=='other_serv')
	{
		 model_id=$("#model_id").val();
		 fetchRepairjob(model_id,3);
	}		
		
            $('.servicelist').hide();
            $('#' + $(this).val()).show();
        });
		function fetchRepairjob()
		{
			 model_id=$("#model_id").val();
		//alert(model_id);
		  $.post('FetchRepairListsRepairJob',{
						//makes_id:makes_id,
						model_id:model_id,
						pkid:3,
					},
					function(data)
					{
						   datas=data.split('**');
						 
						   $("#repjob").html(datas[0]);
						  
						  $("#repjob").html(datas[0]);
						  $("#estamt").html(datas[1]+'/-');
						 
						  $("#pktot1").html(datas[1]);
						  $("#usertot2").html("Total:"+datas[4]);
						  $("#package").val('3'); 
					
							
					}); 
		}
		function fetchPeriodicdata(model_id,plan)
		  {
			  //alert(model_id);
			  if(plan==4)
			  {
				  $.post('FetchRepairListsPeriodic',{
						//makes_id:makes_id,
						model_id:model_id,
						pkid:4,
						
					},
					function(data)
					{
						
						 datas=data.split('**');
						 $("#periodic_list1").html(datas[0]);
						 $("#estamt").html(datas[1]);
						 $("#amount").val(datas[1]);
						 $("#esthour").html(datas[2]);
						 $("#pktot").html(datas[1]+'/-');
						
						 $("#usertot").html('Amount: <i></i> '+datas[4]+'/-');
						 $("#usertot i").addClass('fa fa-inr');
					
						 $("#amttxt").val(datas[4]);
						 $("#amtpackage").val(datas[1]);
					     $("#package").val('4'); 
							
					}); 
			  }
			 else if(plan==5)
			  {
				  $.post('FetchRepairListsPeriodic',{
					model_id:model_id,
						pkid:5,
						
					},
					function(data)
					{
						//alert(data);
						datas=data.split('**');
						 $("#periodic_list2").html(datas[0]);
						 $("#estamt").html(datas[1]);
						 $("#amount").val(datas[1]);
						 $("#esthour").html(datas[2]);
					 	 $("#pktot").html(datas[1]+'/-');
						 $("#usertot").html('Total:'+datas[4]+'/-');
						 $("#usertot i").addClass('fa fa-inr');
						 $("#amttxt").val(datas[4]);
						 $("#amtpackage").val(datas[1]);
					     $("#package").val('5');
						 
							
					}); 
			  }
			   else if(plan==6)
			  {
				  $.post('FetchRepairListsPeriodic',{
					model_id:model_id,
						pkid:6,
						
					},
					function(data)
					{
						//alert(data);
						datas=data.split('**');
						 $("#periodic_list3").html(datas[0]);
						 $("#estamt").html(datas[1]);
						 $("#amount").val(datas[1]);
						 $("#esthour").html(datas[2]);
						 $("#pktot").html(datas[1]+'/-');
						 $("#usertot").html('Total: <i></i> '+datas[4]+'/-');
						 $("#usertot i").addClass('fa fa-inr');
					     $("#package").val('6'); 
					    //$("#amttxt").val(datas[4]);
						 $("#amtpackage").val(datas[1]);
					}); 
			  }
			   else if(plan==7)
			  {
				  $.post('FetchRepairListsPeriodic',{
					model_id:model_id,
					pkid:7,
						
					},
					function(data)
					{
						//alert(data);
						 datas=data.split('**');
						 $("#periodic_list4").html(datas[0]);
						 $("#estamt").html(datas[1]);
						 $("#amount").val(datas[1]);
						 $("#esthour").html(datas[2]);
						 $("#pktot").html(datas[1]+'/-');
						 $("#usertot").html('Total: <i></i> '+datas[4]+'/-');
						 $("#usertot i").addClass('fa fa-inr');
					     $("#package").val('7'); 
							//$("#amttxt").val(datas[4]);
						 $("#amtpackage").val(datas[1]);
					}); 
			  }
			  else if(plan==8)
			  {
				  $.post('FetchRepairListsPeriodic',{
					model_id:model_id,
						pkid:8,
						
					},
					function(data)
					{
						//alert(data);
						datas=data.split('**');
						 $("#periodic_list5").html(datas[0]);
						 $("#estamt").html(datas[1]);
						 $("#amount").val(datas[1]);
						 $("#esthour").html(datas[2]);
						 $("#pktot").html(datas[1]+'/-');
						 $("#usertot").html('Total: <i></i> '+datas[4]+'/-');
						 $("#usertot i").addClass('fa fa-inr');
					     $("#package").val('8'); 
							//$("#amttxt").val(datas[4]);
						 $("#amtpackage").val(datas[1]);
					}); 
			  }
			   else if(plan==9)
			  {
				  $.post('FetchRepairListsPeriodic',{
					model_id:model_id,
						pkid:9,
						
					},
					function(data)
					{
						//alert(data);
						datas=data.split('**');
						 $("#periodic_list6").html(datas[0]);
						 $("#estamt").html(datas[1]);
						 $("#amount").val(datas[1]);
						 $("#esthour").html(datas[2]);
						 $("#pktot").html(datas[1]+'/-');
					 $("#usertot").html('Total: <i></i> '+datas[4]+'/-');
						 $("#usertot i").addClass('fa fa-inr');
					     $("#package").val('9'); 
							//$("#amttxt").val(datas[4]);
						 $("#amtpackage").val(datas[1]);
						 
					}); 
			  }
			  
		  }
</script>
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
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dropdownscript.js"></script>
