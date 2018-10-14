<?php
if($_POST){
    if(isset($message)){
        if($message['type']=='fail'){
           if(isset($message['data']['email'])){
               $emailError=$message['data']['email'][0];
           }
           if (isset($message['data']['mobile'])) {
               $mobileError=$message['data']['mobile'][0];
           } 
        }
        if($message['type']=='success'){
            $successMessage='Thank you, We will contact you soon.';
        }
    }
}
?>
<div class="partnership-page-wraper">
    <section class="page-section no-padding main-slider">
        <div class="item slide3 ver3">
            <div class="caption">
                <div class="caption-content">
                    <!-- Search form -->
                    <div class="form-search light">                            
                        <form action="<?php echo $this->createUrl("/Vendor/Vendor/CreateVendor"); ?>" method="POST">
                            <div class="form-title">
                                <i class="fa fa-globe"></i>
                                <h2>Join Us</h2>                            
                            </div>
                            <div class="row row-inputs">
                                <div class="container-fluid">                                                                        
                                    <span class='suc-msg-title col-md-12 text-center'><?php if(isset($successMessage)){echo $successMessage;}?></span>
                                    <div class="col-sm-12">
                                        <div class="form-group has-icon has-label">
                                            <label>Name</label>
                                            <input id="vendorName" class="form-control" type="text" name="first_name" value="<?php if(isset($message['post']['first_name'])) echo $message['post']['first_name'];  ?>">                                            
                                            <span id="nameError" style="color:red"></span>
                                        </div>
                                        
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group has-icon has-label">
                                            <label>Email ID</label>
                                            <input id="vendorEmail" class="form-control" type="email" name="email" value="<?php if(isset($message['post']['email'])) echo $message['post']['email'];  ?>">
                                            <span id="emailError" style="color:red">
                                                <?php if(isset($emailError)){echo $emailError;}?>
                                            </span>
                                        </div>
                                        
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group has-icon has-label">
                                            <label>Mobile No.</label>
                                            <input id="vendorMobileno" class="numeric form-control" type="text" name="mobile" value="<?php if(isset($message['post']['mobile'])) echo $message['post']['mobile'];  ?>" maxlength="10">
                                            <span id="mobileError" style="color:red"><?php if(isset($mobileError)){echo $mobileError;}?></span>
                                        </div>                                        
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group has-icon has-label">
                                            <label for="formSearchUpLocation2">Select Mechanic Type</label>
                                            <select class="form-control" id="vendorType" name="vendor_types_id">
                                                <option value="">Select Mechanic Type </option>
                                                    <?php 
                                                        if(isset($vendorTypes)) 
                                                            { 
                                                                foreach ($vendorTypes as $vehicleType)
                                                                {
                                                    ?>
                                                                    <option value="<?php echo $vehicleType['id']; ?>" <?php
                                                                                                                            if(isset($message['post']['vendor_types_id'])) { if( $message['post']['vendor_types_id']==$vehicleType['id']) { echo "selected"; }  }  
                                                                                                                            ?>> <?php echo $vehicleType['name']; ?></option>
                                                                                                                                <?php 
                                                                }
                                                            }
                                                    ?>
                                               
                                                
                                            </select>
                                         <span id="vendorTypeError" style="color:red"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-submit">
                                <div class="container-fluid">
                                    <div class="inner">
                                        <button type="submit" id="vendorForm" class="btn btn-submit btn-theme pull-right">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /Search form -->
                </div>
            </div>
    </section>
    <section class="page-section">
        <div class="container">
            <h2 class="text-center">What we offer our partners-Value Addition.</h2>
            <div class="row">
                <div class="col-md-6">Image</div>
                <div class="col-md-6">
                    <h3>Growth in business</h3>
                    <p>Mechanics who partner with us can improve the prospects of business and earn money better owing to increase in customer base and value.</p>

                    <h3>Visibility</h3>
                    <p>More visibility and transparency in terms of the services offered. Easy access by customers, friendly service and support by service centers and technicians in turn boosts their prospects of being more noticeable owing to the service network platform.</p> 

                    <h3>Work and staff Monitor</h3>
                    <p>Monitoring staff and work can never be so easy. Metre per second helps monitor the staff through automated process and work flows.</p>  

                    <h3>Service tracking</h3>
                    <p>The services and processes are tracked from time to time facilitating a real time record and integration.</p> 

                    <h3>Customer care and satisfaction</h3> 
                    <p>An effective way to serve your customers better using Metre per second. Customer satisfaction is more by serving from metre per second.</p>
                </div>
            </div>
        </div>
    </section>

</div>
<script type="text/javascript">
jQuery(document).ready(function ()
{
   jQuery('.numeric').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
});
    $('#vendorForm').click(function ()
    {
        var intVendor = '';
        var intValidation = '';
        var objVendor = {};
        var vendorName = $("#vendorName").val();
        var vendorEmail = $("#vendorEmail").val();
        var vendorMobileno = $("#vendorMobileno").val();
        var vendorType = $("#vendorType").val();
        objVendor = {
                        first_name: $("#vendorName").val(),
                        email: $("#vendorEmail").val(),
                        mobile: $("#vendorMobileno").val(),
                        vendor_types_id: $("#vendorType").val(),
            
                    };           
        intValidation = registerValidations(objVendor);
        if (1 == intValidation)
        {
            strVendor = makeString(objVendor);
            if ('' != strVendor) 
            {
               saveVendor(objVendor);
            } 
            else 
            {
               //Need to think what we do
               return false;
            }
        } 
        else 
        {
            return false;
        }



    });

    /**
     * @author Ctel
     * @param object objVendor
     * @returns integer It will return an integer response
     */
    function saveVendor(objVendor)
    {
        $.post('<?php echo $this->createUrl("/Vendor/Vendor/CreateVendor"); ?>', objVendor, function (response) 
        {
            return false;
        });
        
    }

    /**
     * @author Ctel
     * @param object objVendor
     * @returns integer It will return an integer response
     */
    function registerValidations(objVendor) 
    {
        var intResponse = 0;
   
        if ('' == objVendor.first_name || '' == objVendor.mobile || '' == objVendor.email|| '' == objVendor.vendor_types_id )
        {
           // alert(objVendor.first_name);       
               if ('' == objVendor.first_name)       
                {
                      $( "#vendorName" ).addClass( "boxerror" );
                      $("#nameError").text('Name cannot be blank');
                      $( "#vendorName" ).focus();
                } 
                else if ('' == objVendor.email)
                {
                     $( "#vendorName" ).removeClass( "boxerror" );
                     $("#nameError").text('');
                     $( "#vendorEmail" ).addClass( "boxerror" );
                     $("#emailError").text('Email ID cannot be blank');
                     $( "#vendorEmail" ).focus();               
                } 
                else if ('' == objVendor.mobile)
                {
                    $( "#vendorName" ).removeClass( "boxerror" );
                    $("#nameError").text('');
                    $( "#vendorEmail" ).removeClass( "boxerror" );
                    $("#emailError").text('');
                    $("#vendorMobileno" ).addClass( "boxerror" );
                    $("#mobileError").text('Mobile cannot be blank');
                    $( "#vendorMobileno" ).focus();
           
           
                }else if ('' == objVendor.vendor_types_id)
                {
                    $( "#vendorName" ).removeClass( "boxerror" );
                    $("#nameError").text('');
                    $( "#vendorEmail" ).removeClass( "boxerror" );
                    $("#emailError").text('');
                    $("#vendorMobileno" ).removeClass( "boxerror" )
                    $("#mobileError").text('');
                    $( "#vendorType" ).addClass( "boxerror" );
                    $("#vendorTypeError").text('Vendor Type cannot be blank');
                    $( "#vendorType" ).focus();
             
                }
        
        
        } 
        else 
        {
            intResponse = 1;
        }
        return intResponse;
    }

    /**
     * @author Ctel
     * @param object objectData
     * @returns string It will return a string
     */
    function makeString(objectData) 
    {
        var strResponse = objSource = '';
        objSource = objectData;
        strResponse = JSON.stringify(objectData);
        return strResponse;
    }


});
</script>