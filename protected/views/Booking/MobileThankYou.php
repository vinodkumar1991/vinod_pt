
<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet">

<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/jquery/jquery-1.11.1.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<style type="text/css">
	.fa-check{
		color: #24b663;
		font-size: 72px;
		padding-top: 30px;
	}
	.mobile-thnk{
		display: table-cell;
	}
	h2{
		font-family: "Roboto",sans-serif;
		font-size: 36px;
	}
	p{
		font-family: "Roboto",sans-serif;
		font-size: 18px;
		color: #222;
	}
	.btn-theme{
		background: #329866;
		margin-top: 50px;
		color: #fff;
		font-family: "Roboto",sans-serif;
	}
</style>

<script type="text/javascript">
	WebSettings ws = wv.getSettings();
	ws.setJavaScriptEnabled(true);
	wv.addJavascriptInterface(new Object()
	{
	@JavascriptInterface           // For API 17+
	public void performClick(String strl)
	{
	  stringVariable = strl;
	  Toast.makeText (YourActivity.this, stringVariable, Toast.LENGTH_SHORT).show();
	}
	}, "ok");
</script>
<div class="container">
	<div class="">
		<div class="check text-center"><i class="fa fa-check" aria-hidden="true"></i></div>
		<h2 class="text-center">Thank you for Choosing Us!</h2>
		<p class="text-center">
        <?php
  
  echo $payment_status;
?>
</p>
		<div class="text-center"><button type="button" class="btn btn-theme" id="ok_btn" value="someValue" onclick="ok.performClick(this.value);">OK</button></div>
	</div>
</div>
