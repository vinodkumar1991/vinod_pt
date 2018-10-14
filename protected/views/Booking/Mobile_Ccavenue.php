<!--Payment :: START-->
<form method="post" id="redirect" name="redirect" action="<?php echo Yii::app()->params['payment_keys']['ccavenue']['secure_url']; ?>"> 
    <input type='hidden' name='encRequest' id='encRequest' value='<?php echo $encyprt_booked_data; ?>'/>
    <input type='hidden' name='access_code' id='access_code' value ="<?php echo Yii::app()->params['payment_keys']['ccavenue']['access_code']; ?>"/>
</form>
<!--Payment :: END-->
<script type="text/javascript">
    $('#redirect').submit();
</script>