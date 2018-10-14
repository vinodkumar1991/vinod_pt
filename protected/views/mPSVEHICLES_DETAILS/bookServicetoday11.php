<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/datetimepicker/js/moment-with-locales.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/datetimepicker/js/bootstrap-datetimepicker.js"></script>
	<script>

	//repair job
		  function empty() {
    var x;
	var rp = document.getElementById("carservices_sel").value;
	var tt = document.getElementById("ttotal").value;
	var adrs = $('#adrs').val();
	var picdate = $('#picdate').val();
	var pickhr = $('#pickhr').val();
	$('#hidadrs').val(adrs);
	$('#hidpicdate').val(picdate);
	$('#hidpickhr').val(pickhr);
	

	if(tt=='0' || tt=='')
	{

        alert("Please Check one of the Service");
        return false;
    
	}
}
		function checkrepair(id,pkd)
		{
			name='chk1'+id+''+pkd;
								
								var brandid=document.getElementById('makes_id').value;
								var modelid=document.getElementById('model_id').value;			
								 
								
								if(document.getElementById(name).checked == true)
									{
										
												 $.post('UpdatecarRepairjobamounts',{
														  
														  id:id,
														  brandid:brandid,
														  modelid:modelid

												 },
													 function(data)
													 {  
												var init=data;
												var s= document.getElementById('ttotal');
												var totalamount=s.value;
												//document.getElementById('modelid').value=modelid;					
												document.getElementById('services1').value+=id+',';
												
												//document.getElementById('bamount').value=+init+ +totalamount;
												s.value =+init+ +totalamount; 
											}); 
													
									}
									else if(document.getElementById(name).checked == false)
									{
													//alert("uncheck");
											$.post('UpdatecarRepairjobamounts',{
														  
														  id:id,
														  brandid:brandid,
														  modelid:modelid 

												 },
													 function(data)
													 {  
													  var init=data;
												var s= document.getElementById('ttotal');
												var totalamount=s.value;
												//document.getElementById('modelid').value=modelid;
												var v=document.getElementById('services1').value;
												var vr=id+',';
												var vrg=new RegExp(vr,"g");
												var newstr=v.replace(vr,'');					
												document.getElementById('services1').value=newstr;
												//alert(totalamount);
											//var amount=totalamount-init;
											//alert(amount); parseInt(init)-0 - parseInt(totalamount)-0; 
											//document.getElementById('bamount').value=+init+ +totalamount;
											s.value =-init+ +totalamount; 
											}); 
									}			  
		}
							
						
			$(document).ready(function()
			{
				
				$("#adrs").keypress(function(){
					
					//alert($("#adrs").val());
				});
				
				$("#cancel").hide();
				$("#next").hide();
				
				$("#click2").click(function(){
					var model_id= $("#model_id").val();
					
					$.post('BookingDetails',{
								
								  
								   model_id:model_id,
								  
								 
								  
								 
								},
							function(data)
							{
							
							}); 
				});
				$("#usertot").hide();
				$("#regemail").change(function(){
							
							var emailid = $('#regemail').val();
							$.post('emailValidation',{
								emailid:emailid,
					
								beforeSend : function(){}
				},
					function(data)
					{ 
						
						 if(data>0){
							
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
					var adrs= $("#adrs").val();
					var location= $("#location").val();
					var picdate= $("#picdate").val();
					var pickhr= $("#pickhr").val();
					var amount= $("#amount").val(); 
					var packageid= $("#package").val();  
					var makes_id= $("#makes_id").val();
					var model_id= $("#model_id").val();
					var upwd= $("#regupwd").val();
					var mobNo= $("#regmobNo").val();
					var uname= $("#reguname").val();
				
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
						
					 }
				
				
				});
			
			 
				/* $('#btnsub2').click(function()
				{
					carservices_sel=$('#carservices_sel').val();
					if(carservices_sel=='periodic_serv')
					{
						pkid=$('#package').val();
						model_id=$('#model_id').val();
						usertot=$('#amttxt').val();
						value=$('#val'+pkid).val();
						
						$.post('Updateuserpackage',{
								
								   value:value,
								   model_id:model_id,
								   pkid:pkid
								 
								  
								 
								},
							function(data)
							{
							
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
									
						
				}); */
				/*$('#btnsub').click(function()
				{
					
					carservices_sel=$('#carservices_sel').val();
				
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
					
							 
					}
				});*/
			
				$('#basic').click(function()
				{
					
							$("#usertot").show();
							model_id=$("#model_id").val();
							
							$.post('FetchRepairLists',{
								
								model_id:model_id,
								},
								function(data)
								{
											datas=data.split('**');
											$("#basicdata").html(datas[0]);
											$("#ttotal").val(datas[1]);
											$("#amount").val(datas[1]);
											$("#package").val('1'); 
											$("#esthour").html(datas[2]);
											$("#typeservice").html('<b>General Service</b><br/><b>Basic</b>'); 
											$("#usertot").html('Total:'+datas[1]+'/-');
											$('#sernm').val('General Services');
											$('#plannm').val('Basic');
											$('#planid').val('1');
											$('#serviceid').val('1');
											$("#payamount").val(datas[1]);
											
								}); 
				});
				$('#elite').click(function()
				{
					
											
							$("#usertot").show();
							model_id=$("#model_id").val();
										  
							$.post('FetchRepairListsElite',{
														
									model_id:model_id
														
									},
									function(data)
									{
											datas=data.split('**');
											$("#elitedata").html(datas[0]);
											$("#ttotal").val(datas[1]);
											$("#amount").val(datas[1]);
											$("#package").val('2'); 
											$("#esthour").html(datas[2]);
											$("#usertot").html('Total:'+datas[1]+'/-');
											$("#usertot").html('Total:'+datas[1]);
											$("#typeservice").html('<b>General Service</b><br/><b>Elite</b>'); 
											$('#sernm').val('General Services');
											$('#plannm').val('Elite');
											$('#planid').val('2');
											$('#serviceid').val('1');
											$("#payamount").val(datas[1]);
											
								   }); 
				});
			  
			  
				$('#advance').click(function()
				{
					$('#sernm').val('General Services');
											$('#plannm').val('Advanced');
											$('#planid').val('3');
											$('#serviceid').val('1');
							$("#usertot").show();
							model_id=$("#model_id").val();
							
							$.post('FetchRepairListsAdvance',{
									model_id:model_id
								},
								function(data)
								{
									datas=data.split('**');
									$("#advancedata").html(datas[0]);
									$("#ttotal").val(datas[1]);
									$("#amount").val(datas[1]);
									$("#package").val('3'); 
									$("#esthour").html(datas[2]);
									
									$("#payamount").val(datas[1]);
									$("#typeservice").html('<b>General Service</b><br/><b>Advanced</b>'); 
									$("#usertot").html('Total:'+datas[1]+'/-');
									$('#sernm').val('General Services');
											$('#plannm').val('Elite');
											$('#planid').val('2');
											$('#serviceid').val('1');
										
								}); 
				});
			
				$('.services').change(function() {
						services=$('.services').val();
						$("#servnm").val(services);
				});
				$('#carlist li').click(function() 
						{
							
							$('#ttotal').val('0');
									var vmakeid = $(this).attr('id');
									$('#makes_id').val(vmakeid);
									$('#other_makes_id').val(vmakeid);
									$('#makes_idd').val(vmakeid);
									  $('#post_brand_id').val(vmakeid);
							
									$.post('Getvmodel',{
											Maker:vmakeid,
										},
										function(data)
										{
											$("#modellist").html(data);
										});
								
						});
				$("#modellist").on('click','li',function ()
				{
					
						var modelid = $(this).attr('id');
						$('#model_id').val(modelid);						
						$('#ttotal').val('0');
						$('#other_model_id').val(modelid);
						$('#model_idd').val(modelid);
						text1=$(this).text();
						$('#span1').text(text1);
						vmakeid =  $('#makes_id').val();
						modelid=$('#model_id').val();
					    $('#post_mod_id').val(modelid);
					    $('#post_make_id').val(vmakeid);
						$.post('FetchmodelImage',{
									makeid:vmakeid,
									modelid:modelid
								},
								function(data)
								{
									
										 datas=data.split('**');
										 $('#carimg').html("<img src=http://metrepersecond.com/MPS"+datas[0]+" name='carimg' id='carimg' height='100%' width='100%'>");
										 $('#brand').html('<b>'+datas[1]+'</b>');
										 $('#model').html('<b>'+datas[2]+'</b>');
										 $('#post_brand_nm').val(datas[1]);
										 $('#post_mod_nm').val(datas[2]);
										 
										
										 
										 $('#mod_path').val("http://metrepersecond.com/MPS"+datas[0]);
									
								});
								fetchPeriodicdata(model_id,4);
								 fetchRepairjob(model_id,3);
						
				
				});
   
   
			});
	
							function check1(id,pkd)
							{
								name='chk1'+id+''+pkd;
								
								var brandid=document.getElementById('makes_id').value;
								var modelid=document.getElementById('model_id').value;			
								 
								
								if(document.getElementById(name).checked == true)
									{
												 var planid=document.getElementById('planid').value;
												 $.post('Updatecaramounts',
												 {														  
														  id:id,
														  pkd:pkd,
														  brandid:brandid,
														  modelid:modelid,
														  planid:planid

												 },
													 function(data)
													 {  
														var init=data;
														var s= document.getElementById('ttotal');
														var totalamount=s.value;
														//document.getElementById('modelid').value=modelid;					
														document.getElementById('services1').value+=id+',';
														
														//document.getElementById('bamount').value=+init+ +totalamount;
														s.value =+init+ +totalamount; 
											}); 
													
									}
									else if(document.getElementById(name).checked == false)
									{
													 var planid=document.getElementById('planid').value;
											$.post('Updatecaramounts',{
														  
														    id:id,
														  pkd:pkd,
														  brandid:brandid,
														  modelid:modelid,
														  planid:planid

												 },
													 function(data)
													 {  
													  var init=data;
												var s= document.getElementById('ttotal');
												var totalamount=s.value;
												//document.getElementById('modelid').value=modelid;
												var v=document.getElementById('services1').value;
												var vr=id+',';
												var vrg=new RegExp(vr,"g");
												var newstr=v.replace(vr,'');					
												document.getElementById('services1').value=newstr;
												//alert(totalamount);
											//var amount=totalamount-init;
											//alert(amount); parseInt(init)-0 - parseInt(totalamount)-0; 
											//document.getElementById('bamount').value=+init+ +totalamount;
											s.value =-init+ +totalamount; 
											}); 
									}			  
							}  
						  


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

<input type="hidden" name="amount" id="amount"/>
<input type="hidden" name="package" id="package"/>

<!-- BREADCRUMBS -->
	<form method="post" action="Bookingsevicedetails" enctype="multipart/form-data">
        <section class="bookservice-main page-section breadcrumbs">
            <div class="container">
            <div class="col-md-12 text-right">
                <div class="page-header">
                    <h1>Book a Service</h1>
                </div>
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Pages</a></li>
                    <li class="active">Booking &amp; Payment</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="headerbottom-search">
                    <div class="form-group has-icon col-sm-6">
                      <input class="form-control alt geocomplete" type="text" name="adrs" id="adrs" placeholder="picked customer location address" 
					  value="<?php echo Yii::app()->session['bookloc'];?>" required>
                      <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>  
                    </div>
                    <div class="form-group has-icon col-sm-3">
                        <input type="text" class="picupdate form-control" id="picdate" name="picdate" placeholder="Picking Up Date" value="<?php if(empty(Yii::app()->session['picdate'])){  $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
								
								if(isset($fromdates))
								{
									echo $fromdates;
								}
								else
								 {
									 echo $date->format('d-m-Y'); 
								  }  }else { echo Yii::app()->session['picdate']; } ?>" required>
                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                    </div>
                    <div class="form-group has-icon col-sm-3">
                        <input type="text" class="pictimer form-control" id="pickhr" name="pickhr" placeholder="Picking Up Hour" value="<?php if(empty(Yii::app()->session['bookhour'])){  $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
								
								if(isset($fromdates))
								{
									echo $fromdates;
								}
								else
								 {
									 echo $date->format('h:i'); 
								  }  }else { echo Yii::app()->session['bookhour']; } ?>" required>
                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                    </div>
            	</div>
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
							<div class="vehiclestype">
								<div class="col-sm-6 text-center">
									<a href="<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/Booking');?>" class="active"><i aria-hidden="true" class="fa fa-car"></i>
									<h2>Car</h2></a>
								</div>
								<div class="col-sm-6 text-center">
									<a href="<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/BikeDetails');?>"><i aria-hidden="true" class="fa fa-motorcycle"></i>
									<h2>Bike</h2></a>
								</div>
							</div>
						</div>
                    <!-- Vehicle Category Car -->
					<div id="addcar" class="vehicles">
					<div class="row">
						<div class="col-sm-4">
                            <div class="form-group has-icon has-label booksel">
                            	<label for="formSearchOffLocation3">Select Brand</label>
	                            <div id="carsbrand" class="wrapper-dropdown-3" tabindex="1">
								<span>Select The Car Brands</span>
								<ul class="dropdown scrollable-menu" id="carlist" require>
									<?php
										foreach($vmakelist as $vmake) {
										//echo $vmake['makes_name'];
										if(!empty($vmake['makes_name']))
										{
										echo '<li id="'.$vmake['makes_id'].'" class="cl">
										<a href="#">'.$vmake['makes_name'].'
										<img src="http://metrepersecond.com/MPS'.$vmake['logo_img'].'"></a></li>';
										}

										}  
									?>
																		
								</ul>
								<div class="form-control-icon">
									<i class="fa fa-sort-desc" aria-hidden="true"></i>
								</div>
	                            </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group has-icon has-label booksel">
                                <label for="formSearchOffLocation3">Select Model</label>
                                <div id="carsmodel" class="wrapper-dropdown-3" tabindex="1">
								<span id="span1">Select The Model</span>
								<ul class="dropdown scrollable-menu" id="modellist"></ul>
								<div class="form-control-icon">
									<i class="fa fa-sort-desc" aria-hidden="true"></i>
								</div>
                                </div>
                            </div>
                        </div>
		
						<input type="hidden" name="amttxt" id="amttxt"/>
						<input type="hidden" name="amtpackage" id="amtpackage"/>

						<div class="col-sm-4 bookingvhlc">
							<div class="form-group booksel">
							 <label for="formSearchOffLocation3">Select Service</label>
								<select id="carservices_sel" class="form-control selectpicker">
									<option value="0">Select Services</option>
									<option value="general_serv">General</option>
									<option value="periodic_serv">Periodic</option>
									<option value="repair_serv">Repair Job</option>
									<option value="other_serv">Others</option>
									<option value="notsoure_serv">Exclusive Service</option>         
								</select> 
							</div>
						</div>
					</div>
                            
					<div class="row">
                            <div id="general_serv" class="servicelist col-md-12" style="display:none;">
									<div id="general_servtab"> 
										<ul class="nav nav-pills">
											<li class="active"><a  href="#general_basic_plns" name="basic" id="basic" data-toggle="tab" value='1'>Basic</a></li>
											<li><a href="#general_elite_plns" data-toggle="tab" name="elite" id="elite" value='2'>Elite</a></li>
											<li><a href="#general_advanced_plns" data-toggle="tab" name="advance" id="advance" value='3'>Advanced</a></li>
										</ul>
										
										<div class="tab-content clearfix">
									
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
									 
								
									</div>
                            </div>
                            <!-- Periodic Service Code -->
                        <div id="periodic_serv" class="servicelist col-md-12" style="display:none;">
                            <div id="periodic_servtab"> 
									<!-- <div id="pktot" class="pull-left bks-pkg">Package: <i class="fa fa-inr"></i></div> -->
									
										<ul class="nav nav-pills">
										   <li class="active"><a href="#periodic_list8" id="onet" name="onet"data-toggle="tab">1000</a></li>
										    <li class="active"><a href="#periodic_list9" id="five" name="five"data-toggle="tab">5000</a></li>
											<li class="active"><a href="#periodic_list1" id="ten" name="ten "data-toggle="tab">10000</a></li>
											<li><a href="#periodic_list2" data-toggle="tab" id="twenty" name="twenty" >20000</a></li>
											<li><a href="#periodic_list3" data-toggle="tab" id="thirty" name="thirty">30000</a></li>
											<li><a href="#periodic_list4" data-toggle="tab" id="fourty" name="fourty">40000</a></li>
											<li><a href="#periodic_list5" data-toggle="tab" id="fifty" name="fifty">50000</a></li>
											<li><a href="#periodic_list6" data-toggle="tab" id="sixty" name="sixty">60000</a></li>  
											<li><a href="#periodic_list7" data-toggle="tab" id="msixty" name="msixty">60000 + </a></li>  
											
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
												<div class="tab-pane" id="periodic_list7">
																   
												</div>   
												<div class="tab-pane" id="periodic_list8">
																   
												</div>   
												<div class="tab-pane" id="periodic_list9">
																   
												</div>   												
												
										</div>
								 
                            <!-- End Plans list tabs strat -->
                            </div>  
                        </div>
                            <!-- Repair Job Service Code -->
							
                        <div id="repair_serv" class="servicelist" style="display:none;">
                                <!--<div id="pktot1"></div> -->
							
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
									
									<input type="submit" name="othersub" id="othersub" class="form-control" data-target = "#signup-model">
							</form>
                        </div>   
							
					</div>
					  </form>
					  <!-- book a service features -->
					<div class="bkser-features">
					<div class="row">
						<div class="col-md-4 text-center">
							<div class="media">
								<div class="media-left">
									<img src="<?php echo Yii::app()->baseUrl; ?>/images/choose-icon.png">
								</div>
								<div class="media-body">
									<h3>Choose your service</h3>
									<p>Please choose the type of the service and we will initiate the service process.</p>
								</div>
							</div>
						</div>
						<div class="col-md-4 text-center">
							<div class="media">
								<div class="media-left">
									<img src="<?php echo Yii::app()->baseUrl; ?>/images/collect-your-vehicle.png">
								</div>
								<div class="media-body">
									<h3>We collect your vehicle</h3>
									<p>Our vehicle collection personnel collects your vehicle from the location specified and ensures that it is assigned to the work shop or the service centre.    </p>
								</div>
							</div>
						</div>
						<div class="col-md-4 text-center">
							<div class="media">
								<div class="media-left">
									<img src="<?php echo Yii::app()->baseUrl; ?>/images/start-working.png">
								</div>
								<div class="media-body">
									<h3>Start working </h3>
									<p>After the work progresses the owners of the vehicles are kept informed of the same through the application.  </p>
								</div>
							</div>
						</div>
						</div>
						<div class="row">			
						<div class="col-md-4 text-center">
							<div class="media">
								<div class="media-left">
									<img src="<?php echo Yii::app()->baseUrl; ?>/images/track-your-service.png">
								</div>
								<div class="media-body">
									<h3>Track your service</h3>
									<p>The service status is tracked through the various stages and the client or the customer is notified of the same.</p>
								</div>
							</div>
						</div>							
						<div class="col-md-4 text-center">
							<div class="media">
								<div class="media-left">
									<img src="<?php echo Yii::app()->baseUrl; ?>/images/payment-through the-app.png">
								</div>
								<div class="media-body">
									<h3>Payment through the app</h3>
									<p>Enable payments through various payment gate ways after the service is complete.</p>
								</div>
							</div>
						</div>
						<div class="col-md-4 text-center">
							<div class="media">
								<div class="media-left">
									<img src="<?php echo Yii::app()->baseUrl; ?>/images/delivery-at-your door-steps.png">
								</div>
								<div class="media-body">
									<h3>Delivery at your door steps</h3>
									<p>After service and with the bill paid the vehicle is delivered to the customer’s location which is specified.</p>
								</div>
							</div>
						</div>
					</div>
					</div>
					<!-- /-end book a service features -->
					<div class="bottomservice-btn overflowed reservation-now"> 
                            <!--<input type="submit" name="books" id="books" value="Book a Service" data-target = "#signup-model" class="btn btn-theme pull-right">-->							
                           <!--<a class = "btn btn-theme pull-right" id="btnsub1" data-toggle = "modal" data-target = "#signup-model">Next</a>-->                  
                    </div> 
                </div>
                </div>
                  
                    <aside class="col-md-3 sidebar" id="sidebar">
                    <!-- widget Vehicle Servicing Details -->
                        <div class="widget shadow widget-helping-center estimate-widget">
                            <h4 class="widget-title">Service Details</h4>
                            <div class="widget-content">
								<div class="aside-vhls-dtls">                            
										<div id="carimg"></div>
										<span class="brnd-name" id="brand"></span><br>
										<span class="mdl-name" id="model"></span>
								</div>
							
								<div class="service_content">
									<h5>Type of Service</h5>
									<div id="typeservice"></div>

									<h5>Package Type</h5>

									<!--<h5>Estimated Hour</h5>
									<div id="esthour" class="est-hour">
										<i class="fa fa-clock-o"></i> <?php echo Yii::app()->session['bookhour'];?>
									</div> -->

									<h5>Estimated Amount</h5>
									<!-- <div id="estamt"></div>	 -->									
									<div id="total"></div>	
								</div>
										<!-- <div id="usertot" class="pull-left totalcost">Total: <i class="fa fa-inr"></i></div> -->
								<form action="CarDetails" method="post">
									<input type="hidden" name="post_brand_nm" id="post_brand_nm">
									<input type="hidden" name="post_mod_nm" id="post_mod_nm">
									
									<input type="hidden" name="post_brand_id" id="post_brand_id">
									<input type="hidden" name="post_mod_id" id="post_mod_id">
									
									<!-- <input type="text" name="payamount" id="payamount"> -->
									<input type="hidden" name="payamount1" id="payamount">
									<input type="hidden" name="serviceid" id="serviceid">	
									<input type="hidden" name="services1" id="services1">	
									
									<input type="hidden" name="service_job" id="service_job" />
									<input type="hidden" name="div1" id="div1">
									<input type="hidden" name="sernm" id="sernm">
									<input type="hidden" name="plannm" id="plannm">
									<input type="hidden" name="pkid" id="pkid">
									<input type="hidden" name="planid" id="planid">
									
									<input type="hidden" name="hidadrs" id="hidadrs">
									<input type="hidden" name="hidpicdate" id="hidpicdate">
									<input type="hidden" name="hidpickhr" id="hidpickhr">
									
									<span class="aside-amt-dtls">
										<i class="fa fa-inr" aria-hidden="true"></i>
										<input type="text" id="ttotal" name="payamount" class="est-amount" readonly>
									</span>
									<input type="hidden" name="mod_path" id="mod_path">
									<input type="hidden" name="hidval" id="hidval">
									<div class="form-group text-center">
										<!-- <input type="submit" name="cancel" id="cancel" value="Cancel" class = "btn btn-theme btn-theme-dark"> -->
										<input type="submit" name="next" id="next" value="Next" onClick="return empty()" class = "btn ripple-effect btn-theme nextbtn">
									</div>
								</form>
									
                            </div>
                        </div>
                        
                        <!-- widget helping center -->
                        <div class="widget shadow widget-helping-center">
								<h4 class="widget-title">Helping Center</h4>
								<div class="widget-content">
									<p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.</p>
									<h5 class="widget-title-sub">+91 99 22 33 44 55</h5>
									<p><a href="mailto:info@metrepersecond.com">support@supportcenter.com</a></p>
								</div>
                        </div>
                        <!-- /widget helping center -->
                    </aside>
                    <!-- /SIDEBAR -->

                </div>
		</section>
	</form>
        <!-- /PAGE WITH SIDEBAR -->
			
<script type="text/javascript">
//vehicle category code
    carservices=$('#carservices_sel').val();
		if(carservices=='0')
		{
			$(".service_content").hide();
			$(".aside-amt-dtls").hide();
			
		}
    $('#next').click(function(){
		if(totalamount=='')
		{
			alert('Package contains 0 amount');
			return false;
		}
		else
		{
			return true;
		}
	});
    // services selct options
    $('#carservices_sel').change(function(){
			$("#cancel").show();
			$(".service_content").show();
			$(".aside-amt-dtls").show();
				$("#next").show();
		carservices_sel=$('#carservices_sel').val();
		
		model_id=$("#model_id").val();
	if(carservices_sel=='general_serv')
	{
		$('#ttotal').val('0');
		$("#service_job").val(carservices_sel);
		 $('#sernm').val('General Services');
		$('#plannm').val('Basic');
			$("#typeservice").html('<b>General Service</b><br/><b>Basic</b>'); 	
		$('#planid').val('1');
		$('#serviceid').val('1');
		
		 model_id=$("#model_id").val();
		 
		  $.post('FetchRepairLists',{
						
						model_id:model_id,
						
					},
					function(data)
					{
						//alert(data);
						datas=data.split('**');
						$("#basicdata").html(datas[0]);
						$("#ttotal").val(datas[1]);
						 $("#payamount1").value(datas[1]);
						$("#amount").val(datas[1]);
						$("#esthour").html(datas[2]);
					    $("#package").val('1'); 
						$("#typeservice").html('<b>General Service</b><br/><b>Basic</b>'); 						
						
						$("#usertot").html('Total:'+datas[1]+'/-');
						
						
							
					}); 
	}
	else if(carservices_sel=='other_serv')
	{
		$('#ttotal').val('0');
		$("#service_job").val(carservices_sel);
		   $('#btnsub').prop("disabled","disabled");
		   $('#btnsub2').prop("disabled","disabled");
	}
	else if(carservices_sel=='periodic_serv')
	{   
	
	
	$("#service_job").val(carservices_sel);
		$('#sernm').val('Periodic Services');
		$('#plannm').val('10,0000');
		$('#pkid').val('1');
		$('#planid').val('4');
		$('#serviceid').val('2');
		 $.post('UpdateRecomendedamounts',{
						
						model_id:model_id,
						planid:6
						
					},
					function(data)
					{
						$('#ttotal').val(data);
					});
		$('#onet').click(function()
		{
			 $.post('UpdateRecomendedamounts',{
						
						model_id:model_id,
						planid:4
						
					},
					function(data)
					{
						$('#ttotal').val(data);
					});
			$('#typeservice').html("<b>Periodic Service</b><br/><b>1,000 KM</b>");
			plan=4;
			$('#plannm').val('10,000');
			$('#pkid').val('1');
			$('#planid').val('4');
			$('#serviceid').val('2');
			fetchPeriodicdata(model_id,plan);
		}); 
		$('#five').click(function()
		{
			 $.post('UpdateRecomendedamounts',{
						
						model_id:model_id,
						planid:5
						
					},
					function(data)
					{
						$('#ttotal').val(data);
					});
			$('#typeservice').html("<b>Periodic Service</b><br/><b>5,000 KM</b>");
			plan=5;
			$('#plannm').val('5,000');
			$('#pkid').val('1');
			$('#planid').val('5');
			$('#serviceid').val('2');
			fetchPeriodicdata(model_id,plan);
		}); 
		//fetchPeriodicdata(model_id,6)
		//$('#typeservice').html("<b>Periodic Service</b><br/><b>10,000 KM</b>");
		$('#ten').click(function()
		{
			 $.post('UpdateRecomendedamounts',{
						
						model_id:model_id,
						planid:6
						
					},
					function(data)
					{
						$('#ttotal').val(data);
					});
			$('#typeservice').html("<b>Periodic Service</b><br/><b>10,000 KM</b>");
			plan=6;
			$('#plannm').val('10,000');
			$('#pkid').val('1');
			$('#planid').val('6');
			$('#serviceid').val('2');
			fetchPeriodicdata(model_id,plan);
		}); 
		$('#twenty').click(function()
		{
			$.post('UpdateRecomendedamounts',{
						
						model_id:model_id,
						planid:7
						
					},
					function(data)
					{
						$('#ttotal').val(data);
					});
			
			$('#typeservice').html("<b>Periodic Service</b><br/><b>20,000 KM</b>");
			plan=7;
			$('#plannm').val('20,000');
			$('#pkid').val('2');
			$('#planid').val('7');
			$('#serviceid').val('2');
			fetchPeriodicdata(model_id,plan);
		}); 
	   $('#thirty').click(function()
		{
			$.post('UpdateRecomendedamounts',{
						
						model_id:model_id,
						planid:8
						
					},
					function(data)
					{
						$('#ttotal').val(data);
					});
					
			$('#typeservice').html("<b>Periodic Service</b><br/><b>30,000 KM</b>");
			plan=8;
			$('#plannm').val('30,0000');
			$('#pkid').val('3');
			$('#planid').val('8');
			$('#serviceid').val('2');
			fetchPeriodicdata(model_id,plan);
		}); 
	   $('#fourty').click(function()
		{
			$.post('UpdateRecomendedamounts',{
						
						model_id:model_id,
						planid:9
						
					},
					function(data)
					{
						$('#ttotal').val(data);
					});
			$('#typeservice').html("<b>Periodic Service</b><br/><b>40,000 KM</b>");
			plan=9;
			$('#plannm').val('40,000');
			$('#pkid').val('4');
			$('#planid').val('9');
			$('#serviceid').val('2');
			fetchPeriodicdata(model_id,plan);
		});
		$('#fifty').click(function()
		{
			$.post('UpdateRecomendedamounts',{
						
						model_id:model_id,
						planid:10
						
					},
					function(data)
					{
						$('#ttotal').val(data);
					});
			$('#typeservice').html("<b>Periodic Service</b><br/><b>50,000 KM</b>");
			plan=10;
			$('#plannm').val('50,0000');
			$('#planid').val('10');
			$('#pkid').val('5');
			$('#serviceid').val('2');
			fetchPeriodicdata(model_id,plan);
		});
		$('#sixty').click(function()
		{
			$.post('UpdateRecomendedamounts',{
						
						model_id:model_id,
						planid:11
						
					},
					function(data)
					{
						$('#ttotal').val(data);
					});
			$('#typeservice').html("<b>Periodic Service</b><br/><b>60,000 KM</b>");
			plan=11;
			$('#plannm').val('60,0000');
			$('#pkid').val('6');
			$('#planid').val('11');
			$('#serviceid').val('2');
			fetchPeriodicdata(model_id,plan);
		});
		$('#msixty').click(function()
		{
			$.post('UpdateRecomendedamounts',{
						
						model_id:model_id,
						planid:12
						
					},
					function(data)
					{
						$('#ttotal').val(data);
					});
			$('#typeservice').html("<b>Periodic Service</b><br/><b>60,000 KM</b>");
			plan=12;
			$('#plannm').val('60,0000');
			$('#pkid').val('6');
			$('#planid').val('12');
			$('#serviceid').val('2');
			fetchPeriodicdata(model_id,plan);
		});
	}
	else if(carservices_sel=='repair_serv')
	{
		$('#ttotal').val('0');
		$("#service_job").val(carservices_sel);
		 model_id=$("#model_id").val();
		 fetchRepairjob(model_id,3);
		
		 
	}
	else if(carservices_sel=='other_serv')
	{
		$('#ttotal').val('0');
		$("#service_job").val(carservices_sel);
		 model_id=$("#model_id").val();
		 plan=3;
		 fetchRepairjob(model_id,plan);
	}		
		
            $('.servicelist').hide();
            $('#' + $(this).val()).show();
        });
		function fetchRepairjob(model_id,plan)
		{
				model_id=$("#model_id").val();
		
				$.post('FetchRepairListsRepairJob',{
						
						model_id:model_id,
						pkid:3,
					},
					function(data)
					{
						   //alert(data);
						   datas=data.split('**');
						 
						   $("#repjob").html(datas[0]);
						  
						  $("#repjob").html(datas[0]);
						  $("#estamt").html(datas[1]+'/-');
						   $("#payamount1").value(datas[1]);
					
						  $("#pktot1").html(datas[1]);
						  $("#usertot2").html("Total:"+datas[4]);
						  $("#package").val('3'); 
						 
						
						 // $('#div1').html(datas[6]);						  
					
							
					}); 
		}
		function fetchPeriodicdata(model_id,plan)
		  {
			  //alert(model_id);
			  if(plan==6)
			  {
				  $.post('FetchRepairListsPeriodic',{
						//makes_id:makes_id,
						model_id:model_id,
						pkid:6,
						
					},
					function(data)
					{
						
						 datas=data.split('**');
						 $("#periodic_list1").html(datas[0]);
						// $("#ttotal").val(datas[1]);
						  $("#payamount1").value(datas[1]);
						 $("#amount").val(datas[1]);
						 $("#esthour").html(datas[2]);
						 $("#pktot").html(datas[1]+'/-');
						
						 $("#usertot").html('Amount: <i></i> '+datas[4]+'/-');
						 $("#usertot i").addClass('fa fa-inr');
							
								
						 $("#amttxt").val(datas[4]);
						 $("#amtpackage").val(datas[1]);
					     $("#package").val('6'); 
						 $("#payamount").val(datas[1]);
						  $("#hidval").val(datas[6]);
						
							
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
						 $("#periodic_list2").html(datas[0]);
						// $("#ttotal").val(datas[1]);
						  $("#payamount1").value(datas[1]);
						 $("#amount").val(datas[1]);
						 $("#esthour").html(datas[2]);
					 	 $("#pktot").html(datas[1]+'/-');
						 $("#usertot").html('Total:'+datas[4]+'/-');
						 $("#usertot i").addClass('fa fa-inr');
						 $("#amttxt").val(datas[4]);
						 $("#amtpackage").val(datas[1]);
						  $("#hidval").val(datas[6]);
					     $("#package").val('7');
						 
							
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
						 $("#periodic_list3").html(datas[0]);
						// $("#ttotal").val(datas[1]);
						 $("#amount").val(datas[1]);
						 $("#esthour").html(datas[2]);
						 $("#pktot").html(datas[1]+'/-');
						 $("#usertot").html('Total: <i></i> '+datas[4]+'/-');
						 $("#usertot i").addClass('fa fa-inr');
					     $("#package").val('8'); 
						   $("#hidval").val(datas[6]);
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
						 $("#periodic_list4").html(datas[0]);
						// $("#ttotal").val(datas[1]);
						  $("#payamount1").value(datas[1]);
						 $("#amount").val(datas[1]);
						 $("#esthour").html(datas[2]);
						 $("#pktot").html(datas[1]+'/-');
						 $("#usertot").html('Total: <i></i> '+datas[4]+'/-');
						 $("#usertot i").addClass('fa fa-inr');
						   $("#hidval").val(datas[6]);
					     $("#package").val('9'); 
							//$("#amttxt").val(datas[4]);
						 $("#amtpackage").val(datas[1]);
					}); 
			  }
			  else if(plan==10)
			  {
					$.post('FetchRepairListsPeriodic',{
					model_id:model_id,
					pkid:10,
						
					},
					function(data)
					{
						//alert(data);
						datas=data.split('**');
						 $("#periodic_list5").html(datas[0]);
						// $("#ttotal").val(datas[1]);
						 $("#payamount1").value(datas[1]);
						 $("#amount").val(datas[1]);
						 $("#esthour").html(datas[2]);
						 $("#pktot").html(datas[1]+'/-');
						 $("#usertot").html('Total: <i></i> '+datas[4]+'/-');
						 $("#usertot i").addClass('fa fa-inr');
					     $("#package").val('10'); 
						   $("#hidval").val(datas[6]);
							//$("#amttxt").val(datas[4]);
						 $("#amtpackage").val(datas[1]);
					}); 
			  }
			   else if(plan==11)
			  {
				  $.post('FetchRepairListsPeriodic',{
					model_id:model_id,
						pkid:11,
						
					},
					function(data)
					{
						//alert(data);
						datas=data.split('**');
						 $("#periodic_list6").html(datas[0]);
						// $("#ttotal").val(datas[1]);
						 $("#amount").val(datas[1]);
						 $("#esthour").html(datas[2]);
						 $("#pktot").html(datas[1]+'/-');
					     $("#usertot").html('Total: <i></i> '+datas[4]+'/-');
						 $("#usertot i").addClass('fa fa-inr');
					     $("#package").val('11'); 
							//$("#amttxt").val(datas[4]);
						 $("#amtpackage").val(datas[1]);
						  $("#hidval").val(datas[6]);
						 
					}); 
			  }
			  else if(plan==12)
			  {
				  $.post('FetchRepairListsPeriodic',{
					model_id:model_id,
						pkid:12,
						
					},
					function(data)
					{
						//alert(data);
						datas=data.split('**');
						 $("#periodic_list6").html(datas[0]);
						// $("#ttotal").val(datas[1]);
						 $("#amount").val(datas[1]);
						 $("#esthour").html(datas[2]);
						 $("#pktot").html(datas[1]+'/-');
					     $("#usertot").html('Total: <i></i> '+datas[4]+'/-');
						 $("#usertot i").addClass('fa fa-inr');
					     $("#package").val('12'); 
							//$("#amttxt").val(datas[4]);
						 $("#amtpackage").val(datas[1]);
						  $("#hidval").val(datas[6]);
						 
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
        //date and time
		$('.picupdate').datetimepicker({
	    	format: 'DD-MM-YYYY'
		});
		$('.pictimer').datetimepicker({
	    	format: 'hh:mm'
		});
      //select
      $('.selectpicker').selectpicker();
      $( ".caret" ).wrap( "<div class='form-control-icon'></div>" );
      });
</script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dropdownscript.js"></script>
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
                        <form method="post" class="form-login" action="loginuser"><!-- FOR LOGIN USER-->
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
								<input type="submit" value="Login" id="btnsub" name="btnsub" class="col-md-12 btn btn-theme"></div>
                                <div class="col-md-6 mrg-top-20">
                                    <a href="#" class="btn btn-theme btn-block btn-icon-left facebook"><i class="fa fa-facebook"></i>Login with Facebook</a>
                                </div>
                                <div class="col-md-6 mrg-top-20">
                                    <a href="#" class="btn btn-theme btn-block btn-icon-left google"><i class="fa fa-google-plus" aria-hidden="true"></i>Login with Google</a>
                                </div>                                
                                
                        </form>
                    </div>
                   </div>                   
                   <div class = "tab-pane fade" id = "signuptab">
				 
                    <div class="col-md-12">
                        <div class="form-group"><input class="form-control alt" type="text" name="Usernmame" id="Usernmame"  placeholder="Enter Email*" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="text" name="uname" id="uname" placeholder="Name" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-icon has-label">
                            <input type="text" class="form-control alt" id="mobNo" name="mobNo" placeholder="Enter Mobile Number*" maxlength="10" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="password" name="upwd" id="upwd" placeholder="Enter Password*" required></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><input class="form-control alt" type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password*" required></div>
                        <div class="col-md-6">                    
                    </div>
                   </div>
                   <div class="col-md-12 text-center"><input type="button" value="Create Account" id="register" name="register" class="col-md-12 btn btn-theme"></div>
                   <div class="col-md-6 mrg-top-20">
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