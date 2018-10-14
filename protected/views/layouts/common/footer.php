<!-- FOOTER -->
<div class="clear"></div>
<section class="subscribe">
            <div class="container">
                <!-- Get in touch -->
                        <!-- Contact form -->
                        <div id="contact-form">
                                <div class="col-md-6">
                                <div class="form-group footer-btn">
                                <a class="btn ripple-effect btn-theme" href="<?php echo $this->createUrl('partnership/Partners');?>">Partner With Us</a>
                                <a class="btn ripple-effect btn-theme" href="#">Sign up Us</a>
                                </div>
			                        <ul class="media-list contact-list">
			                            <li class="media">
			                                <div class="media-left"><i class="fa fa-phone"></i></div>
			                                <div class="media-body">Support Phone: 040 42425539</div>
			                            </li>
			                            <li class="media">
			                                <div class="media-left"><i class="fa fa-envelope"></i></div>
			                                <div class="media-body">E mails: support@metrepersecond.com</div>
			                            </li>
			                            <li class="media">
			                                <a href="https://www.facebook.com/metrepersecond" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
			                                <a href="https://twitter.com/metrepersecond" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a>
			                            </li>
			                        </ul>
                    			</div>

                                <div class="col-md-6 contact-form alt">
                                <h2 class="section-title">
                    				<small>Feel Free to Say Hello!</small>
                    				<span>Join us for More.</span>
                				</h2>
                                   
							
<script>

$(document).ready(function()
	{
		$("#submit").click(function() 
		{
				name=$('#name').val();
				email=$('#email').val();
				message=$('#message').val();
				
				$.post('<?php echo $this->createUrl('mPSVEHICLES_DETAILS/getintouch');?>',{
				  
							name:name,
							email:email,
							message:message
						},
						function(data)
						{
							//alert(data);
							/* var form=document.createElement('form');
							form.setAttribute('method','post');
							form.setAttribute('action','getintouch');
							document.body.appendChild(form);
							form.submit(); */
						});
			});
		});
</script>
 							<div class="outer required">
                                        <div class="form-group af-inner has-icon">
                                            <label class="sr-only" for="name">Name</label>
                                            <input type="text"  id="name" placeholder="Name" value="" size="30"
                                                    data-toggle="tooltip" title="Name is required"
                                                    class="form-control placeholder"/>
                                            <span class="form-control-icon"><i class="fa fa-user"></i></span>
                                        </div>
                                    </div>
                                    <div class="outer required">
                                        <div class="form-group af-inner has-icon">
                                            <label class="sr-only" for="email">Email</label>
                                            <input type="text" id="email" placeholder="Email" value="" size="30"
                                                    data-toggle="tooltip" title="Email is required"
                                                    class="form-control placeholder"/>
                                            <span class="form-control-icon"><i class="fa fa-envelope"></i></span>
                                        </div>
                                    </div>

                            
                            <div class="form-group af-inner has-icon">
                                <label class="sr-only" for="input-message">Message</label>
                                <textarea  id="message" placeholder="Message" rows="4" cols="50"
                                        data-toggle="tooltip" title="Message is required"
                                        class="form-control placeholder"></textarea>
                                <span class="form-control-icon"><i class="fa fa-bars"></i></span>
                            </div>

                            <div class="outer required">
                                <div class="form-group af-inner">
                                    <button id="submit" class="btn btn-theme" >Send message</button>
                                </div>
                            </div>
</div>
                        <!-- /Contact form -->
                    </div>
                    </div>
        </section>

    <footer class="footer">
        <div class="footer-meta">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                    <h2 class="section-title">
                    	<small>Our Partners</small>
                	</h2>
                    <div class="ourprtnr">
	                    <a href="https://msg91.com/startups/?utm_source=startup-banner">
	                    	<img src="https://msg91.com/images/startups/msg91Badge.png" width="60" title="MSG91 - SMS for Startups" alt="Bulk SMS - MSG91">
	                    </a>
	                    <a href="#">
	                    	<img src="<?php echo Yii::app()->baseUrl; ?>/images/citruspay_logo.jpg" title="Citruspay" alt="Citruspay">
	                    </a>
	                    <a href="#">
	                    	<img src="<?php echo Yii::app()->baseUrl; ?>/images/ccevenue_logo.png" title="CCAvenue" alt="CCAvenue">
	                    </a>
	                </div>
                    </div>
                        <!-- <p class="btn-row text-center">
                            <a href="#" class="btn btn-theme ripple-effect btn-icon-left facebook wow fadeInDown" data-wow-offset="20" data-wow-delay="100ms"><i class="fa fa-facebook"></i>FACEBOOK</a>
                            <a href="#" class="btn btn-theme btn-icon-left ripple-effect twitter wow fadeInDown" data-wow-offset="20" data-wow-delay="200ms"><i class="fa fa-twitter"></i>TWITTER</a>
                            <a href="#" class="btn btn-theme btn-icon-left ripple-effect pinterest wow fadeInDown" data-wow-offset="20" data-wow-delay="300ms"><i class="fa fa-pinterest"></i>PINTEREST</a>
                            <a href="#" class="btn btn-theme btn-icon-left ripple-effect google wow fadeInDown" data-wow-offset="20" data-wow-delay="400ms"><i class="fa fa-google"></i>GOOGLE</a>
                        </p> -->
                    </div>
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="copyright">&copy; 2016 Meter Per Second — 
						<a href="<?php echo $this->createUrl('Selfdrive/Privacypolicy');?>" target="_blank">Privacy Policy</a>
						<a href="http://www.digitaltoday.co.in" target="_blank" class="pull-right">Powered by Digital Today</a>
						</div>
                    </div>
                    </div>
            </div>
        </div>
    </footer>
    <!-- /FOOTER -->

    <div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>

<?php 

?>

<?php 

?>