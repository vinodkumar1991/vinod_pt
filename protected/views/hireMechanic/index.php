<script src="http://maps.google.com/maps/api/js?libraries=geometry&key=AIzaSyDiNV189wilYblkavEk0dNUdASR3GY3Qm8"></script> 
<script src="http://maplacejs.com/dist/maplace.min.js"></script>
<script>
	$(function ()
	{
		var $checkboxes = $("input[id^='type-']");
		$('input[type=checkbox]:checked').attr('checked', false);
		
		$checkboxes.change(function ()
		{
			var selector = '',
				count = $('input[type=checkbox]:checked').each(function () {
																				selector += '.' + this.value;
																			}).length,
					items = $('.portfolio-item');
				
				console.log(selector, count, items);
				if (count>0) {
					items.hide().filter(selector).show();
				} else {
					items.show();
				}
		});

	});
	 function toggleBounce() {
        if (marker.getAnimation() !== null) {
          marker.setAnimation(null);
        } else {
          marker.setAnimation(google.maps.Animation.BOUNCE);
        }
      }
</script>
<?php if (isset($_GET['id'])) { if($_GET['id']=='car')
	{ ?>
		<script>
			 $(function()
			 {
				 

			  var map;
				$.post('./HireMechanic/Maps',
				{
											
				},
				function(data)
				{ 
				   
					var LocsA=JSON.parse(data);
				
						 map = new Maplace({
							locations: LocsA,
							map_div: '#gmap',					
							controls_on_map: false,
				
							start: 0,
								map_options:{
																mapTypeId: google.maps.MapTypeId.ROADMAP,
																zoom: 12,
																scrollwheel:false
															},
							styles: {
																					'water': [
																				{
																					"featureType": "water",
																					"elementType": "geometry",
																					"stylers": [
																						{
																							"color": "#e9e9e9"
																						},
																						{
																							"lightness": 17
																						}
																					]
																				},
																				{
																					"featureType": "landscape",
																					"elementType": "geometry",
																					"stylers": [
																						{
																							"color": "#f5f5f5"
																						},
																						{
																							"lightness": 20
																						}
																					]
																				},
																				{
																					"featureType": "road.highway",
																					"elementType": "geometry.fill",
																					"stylers": [
																						{
																							"color": "#ffffff"
																						},
																						{
																							"lightness": 17
																						}
																					]
																				},
																				{
																					"featureType": "road.highway",
																					"elementType": "geometry.stroke",
																					"stylers": [
																						{
																							"color": "#ffffff"
																						},
																						{
																							"lightness": 29
																						},
																						{
																							"weight": 0.2
																						}
																					]
																				},
																				{
																					"featureType": "road.arterial",
																					"elementType": "geometry",
																					"stylers": [
																						{
																							"color": "#ffffff"
																						},
																						{
																							"lightness": 18
																						}
																					]
																				},
																				{
																					"featureType": "road.local",
																					"elementType": "geometry",
																					"stylers": [
																						{
																							"color": "#ffffff"
																						},
																						{
																							"lightness": 16
																						}
																					]
																				},
																				{
																					"featureType": "poi",
																					"elementType": "geometry",
																					"stylers": [
																						{
																							"color": "#f5f5f5"
																						},
																						{
																							"lightness": 21
																						}
																					]
																				},
																				{
																					"featureType": "poi.park",
																					"elementType": "geometry",
																					"stylers": [
																						{
																							"color": "#dedede"
																						},
																						{
																							"lightness": 21
																						}
																					]
																				},
																				{
																					"elementType": "labels.text.stroke",
																					"stylers": [
																						{
																							"visibility": "on"
																						},
																						{
																							"color": "#ffffff"
																						},
																						{
																							"lightness": 16
																						}
																					]
																				},
																				{
																					"elementType": "labels.text.fill",
																					"stylers": [
																						{
																							"saturation": 36
																						},
																						{
																							"color": "#333333"
																						},
																						{
																							"lightness": 40
																						}
																					]
																				},
																				{
																					"elementType": "labels.icon",
																					"stylers": [
																						{
																							"visibility": "off"
																						}
																					]
																				},
																				{
																					"featureType": "transit",
																					"elementType": "geometry",
																					"stylers": [
																						{
																							"color": "#f2f2f2"
																						},
																						{
																							"lightness": 19
																						}
																					]
																				},
																				{
																					"featureType": "administrative",
																					"elementType": "geometry.fill",
																					"stylers": [
																						{
																							"color": "#fefefe"
																						},
																						{
																							"lightness": 20
																						}
																					]
																				},
																				{
																					"featureType": "administrative",
																					"elementType": "geometry.stroke",
																					"stylers": [
																						{
																							"color": "#fefefe"
																						},
																						{
																							"lightness": 17
																						},
																						{
																							"weight": 1.2
																						}
																					]
																				}
																			]
																				   
																				}
						  }).Load();
				
					 $(".loc_link").hover(function(){
					  var loc = $(this).data('loc');
					  map.ViewOnMap(loc);  
					},function()
					{
						map.ViewOnMap(0);
					});

			  });
			  
			  
			  
			});
		</script>
<?php } } ?>
<?php if(isset($_GET['id'])) { if($_GET['id']=='bike')
	{ ?>
			<script>
			 $(function()
			 {
				 
					  var map;
						$.post('./HireMechanic/bikeMap',
						{
													
						},
							function(data)
							{ 
							   
							var LocsA=JSON.parse(data);
							 map = new Maplace({
													locations: LocsA,
													map_div: '#gmap',
													controls_on_map: false,
												
													start: 0,
														map_options:{
																mapTypeId: google.maps.MapTypeId.ROADMAP,
																zoom: 12,
																scrollwheel:false
															},
													styles: {
																					'water': [
																				{
																					"featureType": "water",
																					"elementType": "geometry",
																					"stylers": [
																						{
																							"color": "#e9e9e9"
																						},
																						{
																							"lightness": 17
																						}
																					]
																				},
																				{
																					"featureType": "landscape",
																					"elementType": "geometry",
																					"stylers": [
																						{
																							"color": "#f5f5f5"
																						},
																						{
																							"lightness": 20
																						}
																					]
																				},
																				{
																					"featureType": "road.highway",
																					"elementType": "geometry.fill",
																					"stylers": [
																						{
																							"color": "#ffffff"
																						},
																						{
																							"lightness": 17
																						}
																					]
																				},
																				{
																					"featureType": "road.highway",
																					"elementType": "geometry.stroke",
																					"stylers": [
																						{
																							"color": "#ffffff"
																						},
																						{
																							"lightness": 29
																						},
																						{
																							"weight": 0.2
																						}
																					]
																				},
																				{
																					"featureType": "road.arterial",
																					"elementType": "geometry",
																					"stylers": [
																						{
																							"color": "#ffffff"
																						},
																						{
																							"lightness": 18
																						}
																					]
																				},
																				{
																					"featureType": "road.local",
																					"elementType": "geometry",
																					"stylers": [
																						{
																							"color": "#ffffff"
																						},
																						{
																							"lightness": 16
																						}
																					]
																				},
																				{
																					"featureType": "poi",
																					"elementType": "geometry",
																					"stylers": [
																						{
																							"color": "#f5f5f5"
																						},
																						{
																							"lightness": 21
																						}
																					]
																				},
																				{
																					"featureType": "poi.park",
																					"elementType": "geometry",
																					"stylers": [
																						{
																							"color": "#dedede"
																						},
																						{
																							"lightness": 21
																						}
																					]
																				},
																				{
																					"elementType": "labels.text.stroke",
																					"stylers": [
																						{
																							"visibility": "on"
																						},
																						{
																							"color": "#ffffff"
																						},
																						{
																							"lightness": 16
																						}
																					]
																				},
																				{
																					"elementType": "labels.text.fill",
																					"stylers": [
																						{
																							"saturation": 36
																						},
																						{
																							"color": "#333333"
																						},
																						{
																							"lightness": 40
																						}
																					]
																				},
																				{
																					"elementType": "labels.icon",
																					"stylers": [
																						{
																							"visibility": "off"
																						}
																					]
																				},
																				{
																					"featureType": "transit",
																					"elementType": "geometry",
																					"stylers": [
																						{
																							"color": "#f2f2f2"
																						},
																						{
																							"lightness": 19
																						}
																					]
																				},
																				{
																					"featureType": "administrative",
																					"elementType": "geometry.fill",
																					"stylers": [
																						{
																							"color": "#fefefe"
																						},
																						{
																							"lightness": 20
																						}
																					]
																				},
																				{
																					"featureType": "administrative",
																					"elementType": "geometry.stroke",
																					"stylers": [
																						{
																							"color": "#fefefe"
																						},
																						{
																							"lightness": 17
																						},
																						{
																							"weight": 1.2
																						}
																					]
																				}
																			]
																				   
																				}
												  }).Load();
							$(".loc_link").hover(
							function(){
									var loc = $(this).data('loc');
									map.ViewOnMap(loc);  
							},function(){
											map.ViewOnMap(0);
										});

							});

					  
					  
				});
			</script>
<?php } } ?>
<?php if(isset($_GET['id'])) { if(!isset($_GET['id'])) 
		{ ?>
					<script>
						 $(function()
						 {
							 
							  var map;
								$.post('./HireMechanic/Maps',
								{
															
								},
								function(data)
								{ 
								   
											var LocsA=JSON.parse(data);

											map = new Maplace({
											locations: LocsA,
											map_div: '#gmap',
											controls_on_map: false,
																	
											start: 0,
											
										
										
											map_options:{
																mapTypeId: google.maps.MapTypeId.ROADMAP,
																zoom: 12,
																scrollwheel:false
															},
															
												listeners: {
   
},
												styles: {
																					'water': [
    {
        "featureType": "administrative.country",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#1c99ed"
            }
        ]
    },
    {
        "featureType": "administrative.country",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#1f79b5"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#6d6d6d"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative.locality",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#555555"
            }
        ]
    },
    {
        "featureType": "administrative.neighborhood",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#999999"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "color": "#f2f2f2"
            }
        ]
    },
    {
        "featureType": "landscape.natural",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape.natural.landcover",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.attraction",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.business",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.government",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.medical",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#e1eddd"
            }
        ]
    },
    {
        "featureType": "poi.place_of_worship",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.school",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.sports_complex",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "saturation": "-100"
            },
            {
                "lightness": "45"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ff9500"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "hue": "#009aff"
            },
            {
                "saturation": "100"
            },
            {
                "lightness": "5"
            }
        ]
    },
    {
        "featureType": "road.highway.controlled_access",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.highway.controlled_access",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ff9500"
            }
        ]
    },
    {
        "featureType": "road.highway.controlled_access",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.highway.controlled_access",
        "elementType": "labels.icon",
        "stylers": [
            {
                "lightness": "1"
            },
            {
                "saturation": "100"
            },
            {
                "hue": "#009aff"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#8a8a8a"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit.station.airport",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "transit.station.airport",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "lightness": "33"
            },
            {
                "saturation": "-100"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "transit.station.bus",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "transit.station.rail",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "color": "#46bcec"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#4db4f8"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    }
]
																				   
																				}
															
											}).Load();


											$(".loc_link").hover(function(){
											var loc = $(this).data('loc');
											map.ViewOnMap(loc);  
											},function(){
														map.ViewOnMap(0);
													});

								});
						});
					</script>
<?php } } ?>
<style>
body{
	overflow:hidden;
}
.page-section{
	overflow: inherit;
}
#gmap{
  width: 66%;
  height: 540px;
  margin: 0 auto;
  max-height: 100%;
  padding:0px !important;
}

#menu {
  margin: 15px auto;
  text-align:center;
}
#menu span.loc_link {
  background: #0f89cf;
  color: #fff;
  cursor: pointer;
  margin-right: 10px;
  display: inline-block;
  margin-bottom:10px;
  padding: 5px;
  border-radius: 3px;
}
#menu span#tool_tip {
  display: inline-block;
  margin-top: 10px;
}
.hired-mch-list{
    margin-top: 0 !important;
    max-height: 540px;
    overflow-y: scroll;
    padding: 0;
}
.categ-filter{
	margin:50px 0 0;
}
.categ-filter h4{
	color:#fff;
}
.categ-filter a{
	color:#fff;
}
.page-hiremch .page-section.sub-page{
	padding-top:0px;
}
.hired-mch-list a div.portfolio-item:hover{
	background:#f5f5f5;
	color:#000;
}
.hired-mch-list .price > strong {
    display: inline-block;
    font-size: 30px;
    margin: 5px 0 0;
}
.hired-mch-list .price > strong i{
    color: #329866;
    padding-right: 5px;
  }
.hired-mch-list .car-listing .thumbnail-car-card .rating {
    margin-left: 10px;
    margin-right: 0;
    margin-top: 3px;
}
.hired-mch-list .car-listing .thumbnail-car-card .exp,
.hired-mch-list .car-listing .thumbnail-car-card .vhls-type {
    display: inline-block;
    margin-right: 20px;
}
.hired-mch-list .thumbnail .price{
  margin-bottom: 0px;
}
.page-hiremch .section-title{
    color: #fff;
    display: inline-block;
    margin-bottom: 0;
    margin-top: 10px;
}
</style>

    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">

    <div class="content-area page-hiremch">

        <!-- BREADCRUMBS -->

        <section class="page-section breadcrumbs ">

            <div class="container">     <!-- vehicle guide helping center -->
	            <div class="col-md-6">
		            <div class="categ-filter">
		                <div class="filters">
	    					<ul class="list-inline">
	    						<li>    							
	    							<a href="http://metrepersecond.com/bookaservice/index.php/HireMechanic" class="<?php if(!isset($_GET['id'])){  echo 'active'; } ?>"><i class="fa fa-filter" aria-hidden="true"></i> ALL</a>
	    						</li>
	    						<li>    							
                                                                <a href="?id=car" class="<?php if(isset($_GET['id'])) { if($_GET['id']=='car'){  echo 'active'; } } ?>"><i class="fa fa-car" aria-hidden="true"></i> Car</a>
	    						</li>
	    						<li>    							
                                                                <a href="?id=bike" class="<?php if(isset($_GET['id'])) {  if($_GET['id']=='bike'){  echo 'active'; } } ?>"><i class="fa fa-motorcycle" aria-hidden="true"></i> Bike</a>
	    						</li>
	    					</ul>
    					</div>		
		            </div>
	            </div>
		        <div class="col-md-6 text-right">
		            <div class="page-header"><h1>Hire a Mechanic</h1></div>
		            <ul class="breadcrumb text-right">
		                <li><a href="<?php echo Yii::app()->homeUrl;?>">Home</a></li>
		                <li  class="active"><a href="#">HireMechanic</a></li>
		                <li><a href="#">Hire it &amp; Payment</a></li>
		            </ul>
			    </div>
            </div>

        </section>

        <!-- /BREADCRUMBS -->



        <!-- PAGE WITH SIDEBAR -->

        <section class="page-section with-sidebar sub-page">
          <div id="gmap" class="col-md-8"></div>
          <div class="col-md-4 hired-mch-list">
                    
          <div class="car-listing" id="hire_filter">
            <!-- Machanic Listing -->

     <?php 
    if(!empty($self_details))
    {
		$i=1;
     foreach( $self_details as $hire_detail) 
	 { ?>

         <a id="btnsub1" href="<?php echo $this->createUrl('HireMechanic/hireMechanicDetails/',array('id'=>$hire_detail['id'])); ?>">
		 <div data-loc="<?php echo $i; ?>" class="loc_link portfolio-item <?php 

            if($hire_detail['booking_charge']<=100)

            {

              echo "p1"." ";

            }else if($hire_detail['booking_charge']<=500)

            {

              echo "p2"." ";

            }else if($hire_detail['booking_charge']<=1000)

            {

              echo "p3"." ";

            }else if($hire_detail['booking_charge']<=1500)

            {

              echo "p4"." ";

            }else

            {

              echo "p5"." ";

            }

            ?>system thumbnail-car-card thumbnail clearfix" data-price="<?php echo $hire_detail['booking_charge'];?>">

                <div class="col-md-4 pull-left text-center">
					         <img src="http://www.metrepersecond.com/MPS/<?php echo $hire_detail['upload_pic_path']; ?>" width="150" height="120">
					         <div class="price"><strong><i class="fa fa-inr" aria-hidden="true"></i><?php echo $hire_detail['booking_charge']; ?></strong></div>
                </div>
                <div class="pull-left col-md-8">
									<h4 class="caption-title"><?php echo $hire_detail['name']; ?></h4>
									<h5 class="caption-title-sub">Profesional In <?php echo $hire_detail['profesional']; ?></h5>
									<div class="caption-text"><p><?php echo $hire_detail['description']; ?></p></div>
                  <div class="pull-left">
                      <span class="exp"><i class="fa fa-cog"></i> <?php echo $hire_detail['Year_of_exp']; ?> Years Exp</span>
                      <span class="vhls-type"><i class="fa fa-car"></i> <?php echo $hire_detail['vehicle_type']; ?></span>
                      <div class="rating">
                        <span class="star"></span>
                        <span class="star active"></span>
                        <span class="star active"></span>
                        <span class="star active"></span>
                        <span class="star active"></span>
                      </div>
                  </div>
								</div>
              </div>
          </a>
			
     <?php  $i++; } 
     
    }else
    {
      echo "Hire Mechanics not avialable";
    }
     ?> 

    </div>
    </div>

    </section>

    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>

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

				  

                   <div class="col-md-12 text-center"> <div id="emailerror"></div><input type="button" value="Create Account" id="register" name="register" class="col-md-12 btn btn-theme"></div>

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

<?php 

?>

<?php 

?>