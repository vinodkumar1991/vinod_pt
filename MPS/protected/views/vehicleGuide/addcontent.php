 <div class="tab-content">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="active"><a href="<?php echo $this->createUrl('VehicleGuide/vehicleCategory');?>">Add Vehicle Guide Category</a></li>
                                        <li><a href="<?php echo $this->createUrl('VehicleGuide/vehicleGuidecontent');?>">Add Category Post</a></li>
                                      <li><a href="<?php echo $this->createUrl('VehicleGuide/allcategories');?>">All Posts</a></li>
                                    </ul>
                                    </div>
									<?php if(isset($message))
									{
										echo $message;
										}
										?>
									<div class="tab-content">
                                    <form method="POST" action="vehicleCategory">
									
                                       
									  <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-offset-3 col-md-3 control-label">Category Name</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="shop_nm" name="cat_name" required>
                                            </div>
                                        </div>
									</div>
									   
									  <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-6 control-label"></label>
                                            <div class="col-md-offset-1 col-md-2">
                                                <button type="submit" class="btn btn-warning form-control" id="shop_nm" name="save1" value="" required>Add</button>
                                            </div>
                                        </div>
									</div>
									
									</form>
									