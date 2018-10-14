<html>
<head>

</head>
<body>
<center>



   <!--Payment :: START-->
    <form method="post" id="redirect" name="redirect" action="<?php echo Yii::app()->params['payment_keys']['ccavenue']['secure_url']; ?>"> 
        <input type='hidden' name='encRequest' id='encRequest'/>
        <input type='hidden' name='access_code' id='access_code' value ="<?php echo Yii::app()->params['payment_keys']['ccavenue']['access_code']; ?>"/>
    </form>
    <!--Payment :: END-->

</center>
 <script>
        jQuery(document).ready(function ()
        {
         
            $.post('<?php echo Yii::app()->params['webURL'] .'/Self/SelfDrive/DoEncrypt'; ?>',function (response) {
                                    if ('' != response && response.length > 0) {
                                         $('#encRequest').val(response);
                                        $('#redirect').submit();
                                    } else {
                                        return false;
                                    }
                                });
            
        });
</script>
</body>
</html>