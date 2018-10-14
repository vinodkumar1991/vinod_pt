<?php
 /* foreach($carimges as $carim=>$value)
						{
							print_r($value['models_name']);
							if(is_null($value) || $value == '')
        unset($carimges[$carim]);
						}
						//print_r($carimges);
exit; */ 
?>
        <!-- BREADCRUMBS -->
        <section class="bookservice-main page-section breadcrumbs">
            <div class="container">
                <div class="col-md-12">
				 <div class="page-header text-center">
				<font color="white"><?php if(isset($message) && Yii::app()->controller->action->id=='Booking')
				{
					echo $message;
				}
					
				
				
				?></font>
				</div>
                    <div class="page-header text-right">
                        <h1>Your Vehicles</h1>
                    </div>
                    <ul class="breadcrumb text-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Pages</a></li>
                        <li class="active">Booking &amp; Payment</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- /BREADCRUMBS -->
        <!-- PAGE WITH SIDEBAR -->
		<?PHP
?> 
        <section class="page-section with-sidebar sub-page ownedadd-vhlc-listed">
            <div class="container">
                <div class="row">
                    <!-- CONTENT -->
                    <div class="col-md-9 content car-listing" id="content">
 
                        <!-- Car Listing -->
						<?php
						if(!empty($carimges))
						{
						foreach($carimges as $carim=>$value)
						{
							 if($value['makes_name'] != '')
							 {
							
                     echo '<div class="thumbnail no-border no-padding thumbnail-car-card clearfix">
                            <div class="media">
                                <a class="media-link" data-gal="prettyPhoto" href="http://metrepersecond.com/MPS'.$value['imgpath'].'">
                                    <img src="http://metrepersecond.com/MPS'.$value['imgpath'].'" alt="" />
                                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                </a>
                            </div>
                            <div class="caption">
                                <h4 class="caption-title"><a href="#">'.$value['makes_name'].'</a></h4>
                                <h5 class="caption-title-sub">'.$value['models_name'].'</h5>
                                <div class="caption-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                <table class="table">
                                    <tr>
                                        <td><i class="fa fa-car"></i> 2013</td>
                                        <td><i class="fa fa-dashboard"></i> Diesel</td>
                                        <td><i class="fa fa-cog"></i> Auto</td>
                                        <td><i class="fa fa-road"></i> 25000</td>
                                        <td class="buttons"><a class="btn btn-theme" href="'.$this->createUrl('mPSVEHICLES_DETAILS/Booking').'">Book Now</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>';
							 }
						}
						}
						?>
                       
                    </div>
                    <!-- /CONTENT -->
                    <!-- SIDEBAR -->
                    <aside class="col-md-3 sidebar" id="sidebar">
                        <!-- widget helping center -->
                        <div class="widget shadow widget-helping-center">
                            <h4 class="widget-title">HELP &amp; SUPPORT</h4>
                            <div class="widget-content">
                                <p>Call us for all your car and bike needs.</p>
                                <h5 class="widget-title-sub">+91 801 944 80 35</h5>
                                <p><a href="mailto:support@supportcenter.com">support@metrepersecond.com</a></p>
                            </div>
                            <div style="margin: 20px 0px 20px 25px; display: inline-block;"><a href="<?php echo $this->createUrl('mPSVEHICLES_DETAILS/FetchMoreVehicles');?>" class="btn ripple-effect btn-theme"><i class="fa fa-plus" aria-hidden="true"></i> Add more Vehicle</a> </div>
                        </div>
                        <!-- /widget helping center -->
                    </aside>
                    <!-- /SIDEBAR -->
                </div>
            </div>
        </section>
  