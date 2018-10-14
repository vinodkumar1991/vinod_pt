    <form class="form-horizontal lcns 5 userreg-form"  id="HireForm" action="#" enctype="multipart/form-data">
        <div class="row">
            <h3 class="col-sm-12">Create Mechanic</h3>
            <span id="hiremessage"></span>
        </div>
        <div class="row">
            <input type="hidden" id="hroletype" name="hroletype" value="5">
          
        </div>
        <div class="row">
            <div class="col-md-6">
                     <label class="col-md-6 control-label">Choose Vehicle</label>
                <div class="col-md-6">
                   <select name="vehicle_types_id" id="vehicle_types_id" required>
                        <?php                        
                        if(isset($vehicleTypes))
                        {
                                        foreach ($vehicleTypes as $vehicleType)
                                        {
                        ?>     
                                    <option value="<?php echo $vehicleType['id']; ?>"><?php  echo $vehicleType['name']; ?></option> 
                        <?php           }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="col-md-6 control-label">Enter Profesionality</label>
                <div class="col-md-6">
                    <select multiple="multiple" id="vehicle_brands_id" name="vehicle_brands_id[]" required>
                            <?php                        
                        if(isset($vehicleBrands))
                        {
                                        foreach ($vehicleBrands as $vehicleBrand)
                                        {
                        ?>     
                                    <option value="<?php echo $vehicleBrand['id']; ?>"><?php  echo $vehicleBrand['name']; ?></option> 
                        <?php           }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="col-md-6 control-label">Location</label>
                <div class="col-md-6">
                    <input type="text" class="form-control geocomplete" id="location" name="name" required />
                    <input type="hidden" class="form-control" id="latlang" name="location" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="col-md-6 control-label">Booking Charge</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="cost" name="cost" required/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="col-md-6 control-label">Mechanic Description</label>
                <div class="col-md-6">
                     <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
            </div>
        </div>
										
        <div class="row">
            <h3 class="col-sm-12">Enter Personal Details</h3>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="col-md-6 control-label">Name</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="mechanic_name" name="mname" required>
                </div>
            </div>
            <div class="col-md-6">
                <label class="col-md-6 control-label">Enter Company Name</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="company_name" name="company_name" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="col-md-6 control-label">Mobile No.</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                  <span class="mobileerror"></span>
            </div>
            <div class="col-md-6">
                <label class="col-md-6 control-label">Years of Experience</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="experience" name="experience" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="col-md-6 control-label">Email </label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <span class="emailerror"></span>
            </div>
            <div class="col-md-6">
                <label class="col-md-6 control-label">Upload Work Exp Ceritificate</label>
                <div class="col-md-6">
                    <input type="file" class="form-control" name="certificate" accept="image/*" capture >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="col-md-6 control-label">Address </label>
                <div class="col-md-6">
                    <textarea class="form-control" id="address" name="address"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <label class="col-md-6 control-label">Upload any Identity Proof (Licence, Aaadhar)</label>
                <div class="col-md-6">
                    <input type="file" class="form-control" name="license" accept="image/*" capture >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="col-md-6 control-label">Upload Photo </label>
                <div class="col-md-6">
                    <input type="file" class="form-control" name="photo" accept="image/*" capture >
                </div>
            </div>
        </div>
                                     
        <div class="form-group">
            <div class="col-sm-offset-6 col-sm-6">
                <button type="button" id="mechanicForm" class="btn btn-warning" name="submit" value="add">Add Mechanic</button>
            </div>
        </div>
    </form>
<!-- Form Validations -->

<script type="text/javascript">
 jQuery(document).ready(function ()
{
   jQuery('.numeric').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
});
    $('#mechanicForm').click(function ()
    {
  
          
         var intMechanic= '';
        var intValidation = '';
        var objMechanic= {};
        var vehicle_types_id = $("#vehicle_types_id").val();
        var vehicle_brands_id = $("#vehicle_brands_id").val();
        var location = $("#location").val();
         var email = $("#email").val();
        var cost = $("#cost").val();
        var description = $("#description").val();
        var company_name = $("#company_name").val();
        var experiance = $("#experiance").val();
        var phone = $("#phone").val();
      
       
       
        objMechanic= {
                     
                        role_type: $("#hroletype").val(),
                        vehicle_types_id: $("#vehicle_types_id").val(),
                        vehicle_brands_id: $("#vehicle_brands_id").val().toString(),
                        location: $("#location").val(),
                        email: $("#email").val(),
                        name: $("#mechanic_name").val(),
                        cost: $("#cost").val(),
                        description: $("#description").val(),
                        address: $("#address").val(),
                        company_name: $("#company_name").val(),
                        experience: $("#experience").val(),
                        phone: $("#phone").val(),
                        photo: 'fasd',
                        certificate: 'asdf',
                        license: 'sf',
            
                    };           
       //intValidation = registerValidations(objMechanic);
       intValidation=1;
        if (1 == intValidation)
        {
            strMechanic= makeString(objMechanic);
            if ('' != strMechanic) 
            {
               saveMechanic(objMechanic);
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
     * @param object objMechanic
     * @returns integer It will return an integer response
     */
    function saveMechanic(objMechanic)
    {
        alert("Ssf");
        $.post('<?php echo $this->createUrl("/User/User/Create"); ?>', objMechanic, function (response) 
        {
           $('.emailerror').html(response['data']['email']);
           $('.mobileerror').html(response['data']['phone']);
           if(response['type']=='success')
           {
              
              document.getElementById("HireForm").reset();
               
               setTimeout(function(){
                                        $("#hiremessage").html(response['type']);
                    }, 1000);
           }else
           {
               $("#hiremessage").html(response['type']);
            return false;
             }
        });
       
    }

    /**
     * @author Ctel
     * @param object objMechanic
     * @returns integer It will return an integer response
     */
    function registerValidations(objMechanic) 
    {
        var intResponse = 0;
   
        if ('' == objMechanic.first_name || '' == objMechanic.mobile || '' == objMechanic.email|| '' == objMechanic.vendor_types_id )
        {
           // alert(objMechanic.first_name);       
               if ('' == objMechanic.first_name)       
                {
                      $( "#vendorName" ).addClass( "boxerror" );
                      $( "#vendorName" ).focus();
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