
                               
                                    <div class="tab-content">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li ><a href="../site/userRegister">Create User</a></li>
										<li class="active"><a href="../site/Managermechanicshop">Manage User</a></li>
                                    </ul>
                                    </div>
                                   <div class="tab-content">
                                        <ul class="nav nav-tabs">
                                            <li class=""><a href="<?php echo Yii::app()->baseUrl; ?>/index.php/mPSUserRegistration/Managermechanicshop">Mechanic Shop</a></li>
                                           
                                            <li><a href="<?php echo Yii::app()->baseUrl; ?>/index.php/MPSSELFDRIVEAGENCY/FetchSelfDrivedata">Self Drive Agent</a></li>                                           
                                            <li><a href="<?php echo Yii::app()->baseUrl; ?>/index.php/HIREAMECHANIC/FetchHireData">Hire a Mechanic</a></li>
											 <li class="active"><a href="<?php echo Yii::app()->baseUrl; ?>/index.php/site/ManageUser">Customers</a></li>
                                              <li><a href="<?php echo $this->createUrl('Modificationshop/ModificationSave');?>">Modification Shop</a></li>
                                        </ul>
                                    </div>
                                    <div class="table-responsive">
									<?php
									//'shop_nm','shop_id','shopowner_nm','address','city','sector','zipcode','created_date'
                                    $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'schedule-grid',
                'dataProvider'=>$dataProvider,
                //'filter'=>$model,
                'columns'=>array(
				        array(
                        'header'=>'Shop Name',
                        'name'=>'shop_nm',
                        'value'=>'strip_tags($data[\'shop_nm\'])',
                        ),
						 array(
                        'header'=>'Shop Id',
                        'name'=>'shop_id',
                        'value'=>'strip_tags($data[\'shop_id\'])',
                        ),
						 array(
                        'header'=>'Shop Owner name',
                        'name'=>'shopowner_nm',
                        'value'=>'strip_tags($data[\'shopowner_nm\'])',
                        ),
						 array(
                        'header'=>'Address',
                        'name'=>'address',
                        'value'=>'strip_tags($data[\'address\'])',
                        ),
						 array(
                        'header'=>'Contact Number',
                        'name'=>'contact_num',
                        'value'=>'strip_tags($data[\'contact_num\'])',
                        ),
						 array(
                        'header'=>'City',
                        'name'=>'city',
                        'value'=>'strip_tags($data[\'city\'])',
                        ),
						 array(
                        'header'=>'Sector',
                        'name'=>'sector',
                        'value'=>'strip_tags($data[\'sector\'])',
                        ),
						array(
                        'header'=>'Zipcode',
                        'name'=>'zipcode',
                        'value'=>'strip_tags($data[\'zipcode\'])',
                        ),
						array(
                        'header'=>'Created_Date',
                        'name'=>'created_date',
                        'value'=>'"".CHtml::encode(date("m-d-Y", strtotime($data["created_date"]))).""',
                        ),
                       ),
        
    ));
	?>
                                    </div>
                             
       