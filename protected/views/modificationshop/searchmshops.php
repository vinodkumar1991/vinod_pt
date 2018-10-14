<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/dist/locationpicker.jquery.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/jquery.geocomplete.js"></script>

<script>
    $(function () {
        $(".geocomplete").geocomplete({
            details: "form",
            types: ["geocode", "establishment"],
        });       
    });
    
    $(document).ready(function(){
         $("#carbrands").hide();
         $("#bikebrands").hide();
        // $("#bikelist").hide();
         $("#models").hide();
         //$("#modifylist").hide();
         //GetBrands
	 $('#cat').change(function() {            
            intVehicleType = $(this).val();                       
            if(intVehicleType=='1'){                
                    $("#carbrands").show();                    
                    $("#bikebrands").hide();
             }
             if(intVehicleType=='2'){
                   $("#bikebrands").show();                   
                   $("#carbrands").hide();                   
              }
                                                                  
        });
        
        //GetModels
        $('.models').change(function() {            
            var objModel = {};
            intBrand = $(this).val();            
            objModel = {
                brandId: intBrand               
            };
            $.post('<?php echo Yii::app()->params['webURL'] . 'Modificationshop/GetVehicleBrandModels' ?>', objModel, function (response) {              
                if (response.length > 0) {
                    $("#models").show();
                    $("#modifylist").show();
                    $("#modellist").html("");
                    $("#modellist").html(response);
                    $("#brandid").val(objModel.brandId);
                    
                } else {
                    $("#modellist").html("");
                }
                return true;
            });
        });               
 });
                        
</script>

<!-- BREADCRUMBS -->
<section class="page-section breadcrumbs text-right">
    <div class="container">
        <div class="page-header">
            <h1 id="headerText"><?php if($vehicleType==1){echo 'Car';}else{echo 'Bike';}?>'s Modification Shops </h1>
        </div>       
    </div>
</section>
<!-- /BREADCRUMBS -->

<!-- PAGE WITH SIDEBAR -->
<section class="page-section with-sidebar sub-page">
    <div class="container">
        <div class="row">
            <!-- CONTENT -->
            <div class="col-md-9 content car-listing ajaxResponse" id="content">

                <!-- Car Listing -->
                <?php
                if (isset($serchlist) && !empty($serchlist)) {
                    foreach ($serchlist as $list) {
                        ?>	
                        <div class="thumbnail no-border no-padding thumbnail-car-card clearfix">
                            <div class="media col-md-5">                                
                                <img src="<?php
                                if (empty($list['shop_image'])) {
                                    echo Yii::app()->params['imgURL'] . "/modification-default-img.jpg";
                                } else {
                                    echo Yii::app()->params['adminImgURL'] . $modificationShopImagePath . $list['shop_image'];
                                }
                                ?>" alt=""/>
                            </div>
                            <div class="caption">
                                <div class="rating">
                                    <span class="star"></span><!--
                                    --><span class="star active"></span><!--
                                    --><span class="star active"></span><!--
                                    --><span class="star active"></span><!--
                                    --><span class="star active"></span>
                                </div>
                                <h4 class="caption-title"><a href="#"><?php echo $list['name']; ?></a></h4>
                                <div class="caption-text"><?php echo $list['description']; ?></div>
                                <table class="table">
                                    <tr>
                                        <td><i class="fa fa-mobile" aria-hidden="true" title="Call Us"></i> <?php echo $list['phone']; ?></td>
                                        <td><i class="fa fa-envelope-o" aria-hidden="true" title="Mail Us"></i> <?php echo $list['email']; ?></td>
                                        <td><?php if ($list['vehicle_type'] == '1') { ?> <i class="fa fa-car" aria-hidden="true" title="Vehicle Type Car"></i> <?php } else { ?> <i class="fa fa-motorcycle" aria-hidden="true"></i><?php } ?></td>
                                    </tr>
                                </table>
                                <?php if(!empty(Yii::app()->session['customerID'])){?>
                                <a class="btn btn-theme pull-right" style="margin-top:10px;" id="btnsub1"  data-toggle = "modal" onclick="sendRequestEmailtoShop(<?php echo $list['id'];?>);">Send Request</a>
                                <?php }else{?>
                                    <a class="btn btn-theme pull-right" id="btnsub1"  data-toggle = "modal" data-target = "#signup-model">Send Request</a>
                                <?php }?>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "No Modification shops in this type";
                }
                ?>               
                <!-- /Car Listing -->
            </div>
            <!-- /CONTENT -->

            <!-- SIDEBAR -->
            <aside class="col-md-3 sidebar" id="sidebar">
                <!-- widget -->
                <div class="widget shadow widget-find-car">
                    <h4 class="widget-title">Find Modification Shop</h4>
                    <div class="widget-content">
                        <!-- Search form -->
                        <div class="form-search light">
                            <form action="FindModificationShops" method="POST" name="findMod" id="findMod">
                                <input type="hidden" name="modlist" id="modlist"  value="<?php echo $modlist;?>"><!-- Service TYpe ID from URL-->
                                <input type="hidden" name="makes_id" id="makes_id"  value="<?php echo $makes_id;?>"><!-- Brand ID from URL-->
                                <input type="hidden" name="vtype" id="vtype"  value="<?php echo $vehicleType;?>"><!-- Vehicle Type ID from URL-->                                
                                <div class="form-group has-icon has-label">
                                    <label for="formSearchUpLocation3">Change Location</label>
                                    <input type="text" name="mlocation" class="geocomplete form-control" value="<?php if (isset($location)) echo $location; ?>" id="mlocation" placeholder="Type Location">
                                    <input type="hidden" class="form-control" name="location" id="location" />
                                    <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                </div>
                                <div class="form-group selectpicker-wrapper">
                                    <label>Select Category</label>
                                    <select
                                        id="cat" name="vehicle_type" class="selectpicker input-price" data-live-search="true" data-width="100%"
                                        data-toggle="tooltip" title="Select">
                                        <option value="">--Select Vehicle Type--</option>
                                        <option value="1">Car</option>
                                        <option value="2">Bike</option>
                                    </select>
                                </div>
                                <div id="carbrands" class="form-group selectpicker-wrapper">
                                    <label>Select Brand</label>
                                    <select id="carlist" name="carlist" class="selectpicker input-price models" data-live-search="true" data-width="100%"
                                    data-toggle="tooltip" title="--Select Brand--">
                                        <option value="">--Select Brand--</option>
                                      <?php
                                      if(isset($vmakelist) && !empty($vmakelist)){
                                          foreach($vmakelist as $arrCar){
                                              echo '<option value='.$arrCar['id'].'>'.$arrCar['name'].'</option>';                                              
                                          }                                          
                                      }
                                      ?>
                                     </select>
                                </div>
                                <div id="bikebrands" class="form-group selectpicker-wrapper">
                                    <label>Select Brand</label>
                                    <select id="bikelist" name="bikelist" class="selectpicker input-price models" data-live-search="true" data-width="100%"
                                    data-toggle="tooltip" title="--Select Brand--">
                                        <option value="">--Select Brand--</option>
                                      <?php
                                      if(isset($brand) && !empty($brand)){
                                          foreach($brand as $arrBike){
                                              echo '<option value='.$arrBike['id'].'>'.$arrBike['name'].'</option>';                                              
                                          }                                          
                                      }
                                      ?>
                                     </select>
                                </div>    
                                <input type="hidden"  name="brandid" id="brandid" value="">
                              <div id="models" class="form-group selectpicker-wrapper">
                                  <label>Select Model</label>
                                  <select id="modellist" name="modellist" style="height:40px;width:100%">
                                      <option value="">--Select Model--</option>
                                  </select>
                              </div>
                              
                              <div id="modifylist" class="form-group selectpicker-wrapper">
                                  <label>Type of Modification</label>
                                  <select id="services_list" name="services_list" class="selectpicker input-price" data-live-search="true" data-width="100%"
                                    data-toggle="tooltip" title="Select">
                                      <option value="">--Select Modification--</option>
                                      <?php 
                                      if(isset($types) && !empty($types)){
                                          foreach($types as $arrServices){
                                              echo '<option value='.$arrServices['id'].'>'.$arrServices['name'].'</option>';                                              
                                          }                                          
                                      }
                                      ?>
                                  </select>
                              </div>
                              <button type="button" name="search" value="find" id="formSearchSubmit3" class="btn btn-theme ripple-effect" onclick="getFindModificationShops();">Find Modification Shop</button>
                            </form>
                        </div>
                        <!-- /Search form -->
                    </div>
                </div>
                <!-- /widget -->
            </aside>
            <!-- /SIDEBAR -->

        </div>
    </div>
</section>
<!-- /PAGE WITH SIDEBAR -->
<!-- login model -->
<div class = "customer-signup modal fade" id = "signup-model" tabindex = "-1" role = "dialog" 
     aria-labelledby = "myModalLabel" aria-hidden = "true">

    <div class = "modal-dialog">
        <div class = "modal-content pull-left">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;</button>       
            <div class = "modal-body pull-left">			
                <div id="form2">
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
                            <div class="aside-signup col-md-5">
                                <h3 class="block-title">Signup Today and You will be able to</h3>
                                <ul class="list-check">
                                    <li>Online Order Status</li>
                                    <li>See Ready Hot Deals</li>
                                    <li>Love List</li>
                                    <li>Sign up to receive exclusive news and private sales</li>
                                    <li>Quick Buy Stuffs</li>
                                </ul>
                            </div>
                            <div id="MerrMessage" align="center" style="color:red;"></div>
                            <div class="col-md-7">                        
                                <input type="hidden" name="makes_idd" id="makes_idd">
                                <input type="hidden" name="model_idd" id="model_idd">
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control" type="text" name="user_name" id="user_name" placeholder="User name or email">
                                    <div id="MusernameErr" style="color:red;padding-left:20px;"></div>                                    
                                    </div>
                                </div>                               
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control" type="password" name="user_password" id="user_password" placeholder="Enter Password">
                                    <div id="MpasswordErr" style="color:red;padding-left:20px;"></div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="checkbox pull-left">
                                        <input type="checkbox" name="remember" id="checkboxa1">
                                        <label for="checkboxa1">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="#" class="forgot-password">forgot password?</a>
                                </div>
                                <div class="col-md-12 text-center mrg-top-20">								
                                    <div id="loginerror_login"></div>
                                    <input type="button" value="Login" id="btnsub_login" name="btnsub_login" class="btn btn-theme btn-theme-dark"/> 
                                    <a href = "#" onClick = "doLogin()" class="btn btn-fbook"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
                                </div>

                            </div>
                        </div>

                        <!--Sign UP Process :: START-->
                        <div class = "tab-pane fade" id = "signuptab">
                            <div class="aside-signup col-md-5">
                                <h3 class="block-title">Signup Today and You will be able to</h3>
                                <ul class="list-check">
                                    <li>Online Order Status</li>
                                    <li>See Ready Hot Deals</li>
                                    <li>Love List</li>
                                    <li>Sign up to receive exclusive news and private sales</li>
                                    <li>Quick Buy Stuffs</li>
                                </ul>
                            </div>
                            <div class="col-md-7">
                                <!--Name :: START-->
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control alt" type="text" name="first_name" id="first_name" placeholder="Name" required>
                                        <div id="nameErr" style="color:red;padding-left: 20px;"></div>
                                    </div>
                                </div>
                                <!--Name :: END-->

                                <!--Email Address :: START-->
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control alt" type="text" name="username" id="username"  placeholder="Enter Email" required>
                                        <div id="emailErr" style="color:red;padding-left: 20px;"></div>                                            
                                    </div>
                                </div>                    
                                <!--Email Address :: END-->

                                <!--Mobile :: START-->
                                <div class="col-md-12">
                                    <div class="form-group has-icon has-label">
                                        <input type="text" class="form-control alt numeric" id="mobile" name="mobile" placeholder="Enter Mobile Number" maxlength="10" required>
                                        <div id="mobileErr" style="color:red;padding-left: 20px;"></div>                                            
                                    </div>
                                </div>
                                <!--Mobile :: END-->

                                <!--Password :: START-->
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control alt" type="password" name="password" id="password" placeholder="Enter Password" required>
                                    <div id="newpasswordErr" style="color:red;padding-left: 20px;"></div>                                            
                                    </div>
                                </div>
                                <!--Password :: END-->

                                <!--Button :: START-->
                                <div class="col-md-12 text-center mrg-top-20">
                                    <div id="emailerror1"></div>
                                    <input type="button" value="Create Account" id="book_register" name="book_register" class="btn btn-theme btn-theme-dark">
                                </div>
                                <!--Button :: END-->

                            </div>
                        </div>	
                        <!--Sign UP Process :: END-->
                    </div>			
                </div>         
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->

    </div><!-- /.Registration Sign up Modal -->
</div>
<!-- End login model -->
<div id="mps-otp1" class="modal fade otp-popup" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="verifyform1">
                <div class="verification-model">
                    <div class="dwn-app text-center">
                        <i class="fa fa-mobile animated" aria-hidden="true"></i>
                        <h4>OTP Verification</h4>
                    </div>
                    <input class="form-control" type="hidden" name="hidvalue1" id="hidvalue1" placeholder="User name or email">

                    <div class="col-md-12 otp-inputtxt">
                        <div class="form-group"><input class="form-control alt text-center" type="text" name="bregemail" id="verifyidd"  placeholder="Enter Vericfication code*" required></div>
                    </div>

                    <div class="col-md-6 text-right">
                        <div id="emailerror1"></div>
                        <input type="button" value="Submit" id="averify" name="register" class="btn btn-theme submit-otp">
                    </div>

                    <div class="col-md-6 text-left">
                        <div id="emailerror"></div>
                        <div class="resend-icon">
                            <input type="button" value="ReSend" id="resendbtn1" name="resendbtn1" class="btn btn-theme btn-theme-dark submit-otp">
                        </div>
                    </div>
                    <span id="error"></span>
                </div>					
            </div>
        </div>
    </div>
</div>

<script>
    
    //FindModification
    function getFindModificationShops(){            
            var objSearch = {};
            intBrand = $("#brandid").val();
            intVehicleType=$("#cat").val();
            intServiceType=$("#services_list").val();
            strLatitudeLongitude=$("#location").val();
            strLocation=$("#mlocation").val();
            Model =$("#modellist").val();
            if(intVehicleType==''){
                alert('Please Select Vehicle Category Type !!!');
                return false;
            }else if(intBrand==''){
                alert('Please Select Brand Name !!!');
                return false;
            }else if(Model==''){
                alert('Please Select Brand Model !!!');
                return false;
            }else if(intServiceType==''){
                alert('Please Select Type of Modification !!!');
                return false;
            }else{
                          
                objSearch = {
                    brandId: intBrand,
                    vehicleTypeID:intVehicleType,
                    serviceTypeID:intServiceType,
                    locationLatitudeLongitude:strLatitudeLongitude,
                    locationStr:strLocation,                                
                };
                if(objSearch.vehicleTypeID == 1){
                    textContent='Car Modification Shops';
                }else{
                    textContent='Bike Modification Shops';
                }
                $.post('<?php echo Yii::app()->params['webURL'] . 'Modificationshop/FindModificationShops' ?>', objSearch, function (response) {                    
                  
                    $(".ajaxResponse").html("");
                    $("#headerText").html("");
                    if (response.length > 0) {                   
                        $(".ajaxResponse").append(response);
                        $("#headerText").append(textContent);

                    } else {
                        $(".ajaxResponse").html("");
                        $("#headerText").html("");
                    }
                    return true;
                });
        }
        
    }   
</script>

<!-- Login/SignUp Functions-->
<script type="text/javascript">
    var intCustomer;
    var strMobileNumber;
    var strTokenAccess;
    var strName;
    var strSMSTokenAccess;
    jQuery(document).ready(function ()
    {
        //Allow only numbers
        jQuery('.numeric').keyup(function () {
          this.value = this.value.replace(/[^0-9\.]/g, '');
        });
        
        $('#book_register').click(function () {
            var objCustomer = {};
            var intValidation = 0;
            objCustomer = {
                first_name: $('#first_name').val(),
                username: $('#username').val(),
                mobile: $('#mobile').val(),
                password: $('#password').val(),
            };
            intValidation = validate_registration(objCustomer);
            if (1 == intValidation) {
                strCustomer = encodeData(objCustomer);
                if ('' != strCustomer) {
                    saveNewCustomer(objCustomer);
                } else {
                    //Need to think what we do
                    return false;
                }
            } else {
                return FALSE;
            }
        });

        function encodeData(objectData) {
            var strResponse = objSource = '';
            objSource = objectData;
            strResponse = JSON.stringify(objectData);
            return strResponse;
        }

        function validate_registration(objCustomer) {
            var intResponse = 0;
            intResponse = 1;
            return intResponse;
        }


        function saveNewCustomer(objCustomer) {
             $("#nameErr").text("");
             $("#emailErr").text("");
             $("#mobileErr").text("");
             $("#newpasswordErr").text("");
            $.post(webUrl + 'Login/Customer/create', objCustomer, function (response) {
                var intResponseLen = 0;
                intResponseLen = getLengthOfObject(response);
                if (intResponseLen > 0 && response.data.customerId > 0) {
                    clearRegistrationInputs();
                    strMobileNumber = response.data.mobile;
                    strTokenAccess = response.data.verifyToken;
                    intCustomer = response.data.customerId;
                    strName = response.data.first_name;
                    strSMSTokenAccess = response.data.smsToken;
                    $('#signup-model').modal('hide');
                    $('#mps-otp1').modal('show');
                } else {                    
                    $("#nameErr").text(response.data.first_name);
                    $("#emailErr").text(response.data.username);
                    $("#mobileErr").text(response.data.mobile);
                    $("#newpasswordErr").text(response.data.password);
                    $('#mps-otp1').modal('hide');
                }

            });
        }

        function getLengthOfObject(objData) {
            var intLength = 0;
            if ('' != objData) {
                intLength = Object.keys(objData).length;
            }
            return intLength;
        }

        function clearRegistrationInputs() {
            $('#first_name').val();
            $('#username').val();
            $('#mobile').val();
            $('#password').val();
            return 1;
        }
        ;


        $('#averify').click(function ()
        {
            var objVerifcationDet = {};
            objVerifcationDet = {
                mobile: strMobileNumber,
                otp: strTokenAccess,
                customerId: intCustomer,
                first_name: strName,
                smsToken: strSMSTokenAccess,
            }
            verfiyAccessToken(objVerifcationDet);
        });


        function verfiyAccessToken(objVerifcationDet) {
            $.post(webUrl + 'Login/Customer/verifyToken', objVerifcationDet, function (response) {
                var objVerifyResponse = 0;
                objVerifyResponse = getLengthOfObject(response);
                if (objVerifyResponse > 0) {
                    $('#mps-otp1').modal('hide');
                    return true;
                } else {
                    return false;
                }
            });
        }


        $('#resendbtn1').click(function ()
        {
            var objResendToken = {};
            objResendToken = {
                mobile: strMobileNumber,
                customerId: intCustomer,
            };
            $.post(webUrl + 'Login/Customer/resendToken', objResendToken, function (response) {
                var objResendResponse = 0;
                objResendResponse = getLengthOfObject(response);
                if (objResendResponse > 0 && '' != response.data.smsToken) {
                    strSMSToken = response.data.smsToken;
                    strToken = response.data.verifyToken;
                    return 1;
                } else {
                    return false;
                }
            });
        });

        $('#btnsub_login').click(function ()
        {
            $("#MerrMessage").html("");            
            $("#MusernameErr").text("");
            $("#MpasswordErr").text("");
            var objLogin = {};
            objLogin = {
                username: $('#user_name').val(),
                password: $('#user_password').val()
            }
            $.post(webUrl + 'Login/Customer/SignIN', objLogin, function (response) {                
                if (1 == response.data) {
                    location.reload(true);//Need To Change
                    return true;
                } else {                    
                    $("#MusernameErr").text(response.data.username);                                                      
                    $("#MpasswordErr").text(response.data.password);
                if(!response.data.username && !response.data.username){
                    $("#MerrMessage").html(response.message);                    
                }
                    return false;
                }

            });
        });
        
        
    });

//Send Request Email
function sendRequestEmailtoShop(intshopID){                        
            var objShop={};
            
            strLatitudeLongitude=$("#location").val();
            strLocation=$("#mlocation").val();
            
            if($("#cat").val() !=''){
                var intVehicleType=$("#cat").val() 
            }else{
                var intVehicleType=$("#vtype").val();
            }
            if($("#brandid").val()!=''){
                var intBrand = $("#brandid").val();           
            }else{
                var intBrand = $("#makes_id").val();           
            }
            if($("#services_list").val()!=''){
                var intServiceType = $("#services_list").val();           
            }else{
                var intServiceType = $("#modlist").val();           
            }
            objShop={
                shopID:intshopID,
                VehicleType:intVehicleType,
                serviceTypeID:intServiceType,
                locationLatitudeLongitude:strLatitudeLongitude,
                locationStr:strLocation,
                brandID:intBrand,
                    },
            $.post(webUrl + '/Modificationshop/SendRequestEmail',objShop,function(response){                 
                var responseData=$.parseJSON(response);
                alert(responseData.Error);
                return false;
            });
        }
</script>