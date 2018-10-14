<?php
//ECHO $path= Yii::app()->request->baseUrl;
   //echo $_SERVER['DOCUMENT_ROOT'];

?>
<script>
function getState(countryId)
{
	
	$.post('<?php echo  $this->createUrl('site/Getstate');?>',{
		Country:countryId,
	},
	function(data)
	{ 
		//alert(data);
		$("#statemps").html("");
		$("#statemps").append(data);
	});
}
function getCity(stateId) 
{
	
	$.post('<?php echo  $this->createUrl('site/Getcity');?>',{
		State:stateId,
	},
	function(data)
	{ 
		$("#citymps").html("");
		$("#citymps").append(data);
	});
}
function getArea(cityId)
{
	
	$.post('<?php echo  $this->createUrl('site/Getarea');?>',{
		City:cityId,
	},
	function(data)
	{ 
		$("#areamps").html("");
		$("#areamps").append(data);

	});
}
function locsubmit()
{
	
	var country = $('#scountry').val();
	var state = $('#statemps').val();
	var city = $('#citymps').val();
	var area = $('#areamps').val();
	var amps = $('#amps').val();
	var zmps = $('#zmps').val();
	if(country == ''){
		$('#countryerr').show();
		return false;
	}
	else{
		$('#countryerr').hide();
	}
	if(state == ''){
		$('#stateerr').show();
		return false;
	}
	else{
		$('#stateerr').hide();
	}
	if(city == ''){
		$('#cityerr').show();
		return false;
	}
	else{
		$('#cityerr').hide();
	}
	if(area == ''){
		$('#areaerr').show();
		return false;
	}
	else{
		$('#areaerr').hide();
	}
	if(amps == '' && area == '0'){
		$('#ampserr').show();
		return false;
	}
	else{
		$('#ampserr').hide();
	}
	if(zmps == ''){
		$('#zmpserr').show();
		return false;
	}
	else{
		$('#zmpserr').hide();
	}
	var areaname = $("#areamps option:selected").text();
	if(areaname != 'Others'){
		var areatext = areaname;    
	}
	else{
		var areatext = amps;
	}
	$.post('../site/Save',{
		country:country,
		state:state,
		city:city,
		area:area,
		areatext:areatext,
		zmps:zmps,
		beforeSend : function(){ $("#loading").show();	}
	},
	function(data)
	{ 
		$("#loading").hide();
		alert("Location added successfully!");
		
		window.location.href = '<?php echo  $this->createUrl('site/dashboard');?>';
	});
	


	
}
function enterArea(id){
	var val = id;
	if(val==1){
		$("#armps").show();
	}
	else{
		$("#amps").val('');
		$("#armps").hide();
	}
}
jQuery(document).ready(function ()
{
    jQuery('.numeric').keyup(function () { 
		this.value = this.value.replace(/[^0-9\.]/g,'');
	});
});
</script>
<body>
<div class="card-body">

                                <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/dashboard">Create Location</a></li>
                                        <li><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/locationslist">Locations List</a></li>
                                    </ul>
                                <!-- Tab panes -->
                                    <div class="tab-content">
                                        <form class="form-horizontal lcns">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Country</label>
                                            <div class="col-sm-3">
                                                <select onChange="getState(this.value)" name="scountry" id="scountry">
                                                <option value="">Select Country</option>
                            
                    <?php
                    foreach ($countrylist as $country) {
                    	echo "<option value='".$country['id']."'>".$country['name']."</option>";
                    }
                    ?>                                                   
                                                </select>
                                                <span id="countryerr" style="color:red;display: none;">Please select Country</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">State</label>
                                            <div class="col-sm-3">
                                                <select id="statemps"  onChange="getCity(this.value)">
                                                    <option value="">Select State</option>

                                                </select>
                                                <span id="stateerr" style="color:red;display: none;">Please select State</span>
                                            </div>
                                        </div>
                                          <div class="form-group">
                                            <label class="col-sm-2 control-label">City</label>
                                            <div class="col-sm-3">
                                                <select id="citymps"  onChange="getArea(this.value)">
                                                    <option value="">Select City</option>
                                                    
                                                </select>
                                                <span id="cityerr" style="color:red;display: none;">Please select City</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Area</label>
                                            <div class="col-sm-3">
                                                <select id="areamps"  onChange="enterArea(this.value)" >
                                                    <option value="">Select Area</option>
                                                </select>
                                                <span id="areaerr" style="color:red;display: none;">Please select Area</span>
                                            </div>
                                        </div>
                                        <div class="form-group" id="armps" style="display: none;">
                                        <label class="col-sm-2 control-label" >Enter Area</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="amps" placeholder="Please enter the Area" >
                                            <span id="ampserr" style="color:red;display: none;">Please enter Area</span>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Zipcode</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control numeric" id="zmps" placeholder="Enter Zipcode" maxlength="6">
                                            <span id="zmpserr" style="color:red;display: none;">Please enter Zipcode</span>
                                        </div>
                                    </div>
                                    <!--<div class="form-group">
                                        <label class="col-sm-2 control-label">Location</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="" placeholder="Enter Location">
                                        </div>
                                    </div>-->
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="button" class="btn btn-warning" onClick="locsubmit();">Submit</button>
                                            </div>
                                            <!--<div id="loading" style="display:none;" align="center">
                                                <img src="<?php //echo Yii::app()->params['imgURL'].'ajax-loader.gif' ?>">
                                            </div>-->
                                            <!-- <span id="loading" style="display:none; align:center"><img src="<?php //echo Yii::app()->baseUrl?>/images/load.gif" width="100px" height="100px"></span>-->
                                        </div>
                                        </form>
                                </div>
                            </div>
