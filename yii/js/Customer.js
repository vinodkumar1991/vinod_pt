jQuery(document).ready(function ()
{
    var intCustomerId;
    var strMobile;
    var strToken;
    var strFirstName;
    var strSMSToken;
    $('#aregister_btn1').click(function ()
    {
        var intCustomer = '';
        var intValidation = '';
        var objCustomer = {};
        var regemail = $("#aregemail_m").val();
        var upwd = $("#aregupwd_m").val();
        var mobNo = $("#aregmobNo_m").val();
        var uname = $("#areguname_m").val();
        objCustomer = {
            first_name: $("#areguname_m").val(),
            username: $("#aregemail_m").val(),
            mobile: $("#aregmobNo_m").val(),
            password: $("#aregupwd_m").val(),
        };
        intValidation = registerValidations(objCustomer);
        if (1 == intValidation) {
            strCustomer = makeString(objCustomer);
            if ('' != strCustomer) {
                saveCustomer(objCustomer);
            } else {
//Need to think what we do
                return false;
            }
        } else {
            return FALSE;
        }
    });
    /**
     * @author Ctel
     * @param object objCustomer
     * @returns integer It will return an integer response
     * @ignore Need to change
     */
    function saveCustomer(objCustomer) {
             $("#nameerror").text("");
             $("#usernameerror").text("");
             $("#mobileerror").text("");
             $("#pwderror").text("");
        $.post(webUrl + 'Login/Customer/create', objCustomer, function (response) {
            var intResponseLen = 0;
            intResponseLen = getObjectLength(response);
            if (intResponseLen > 0 && response.data.customerId > 0) {
                clearCustomerInputs();
                strMobile = response.data.mobile;
                strToken = response.data.verifyToken;
                intCustomerId = response.data.customerId;
                strFirstName = response.data.first_name;
                strSMSToken = response.data.smsToken;
                $('#signup-model_main').modal('hide');
                $('#mps-otp').modal('show');
            } else {
                $("#nameerror").text(response.data.first_name);
                $("#usernameerror").text(response.data.username);
                $("#mobileerror").text(response.data.mobile);
                $("#pwderror").text(response.data.password);
                $('#mps-otp').modal('hide');
            }

        });
    }

    /**
     * @author Ctel
     * @param object objCustomer
     * @returns integer It will return an integer response
     */
    function registerValidations(objCustomer) {
        var intResponse = 0;
        intResponse = 1;
        return intResponse;
    }

    /**
     * @author Ctel
     * @param object objectData
     * @returns string It will return a string
     */
    function makeString(objectData) {
        var strResponse = objSource = '';
        objSource = objectData;
        strResponse = JSON.stringify(objectData);
        return strResponse;
    }

    /**
     * @author Ctel
     * @param object objData
     * @returns integer It will return length of the object
     */
    function getObjectLength(objData) {
        var intLength = 0;
        if ('' != objData) {
            intLength = Object.keys(objData).length;
        }
        return intLength;
    }


    /**
     * @author Ctel
     * @ignore It will handle verification process
     */
    $('#averify_m').click(function ()
    {
       var SignOTP = $("#verifyidd_m").val();
       if(!SignOTP){
            $('#signotp_error').html('<b>OTP cannot be blank.</b>');
            return false;
       }
        var objVerifcationDet = {};
        objVerifcationDet = {
            mobile: strMobile,
            otp: $("#verifyidd_m").val(),
            customerId: intCustomerId,
            first_name: strFirstName,
            smsToken: strSMSToken,
        }
        verfiyToken(objVerifcationDet);
    });

    /**
     * @author Ctel
     * @param object objVerifcationDet
     * @returns boolean It will return either true or false response
     */
    function verfiyToken(objVerifcationDet) {
   $.post(webUrl + 'Login/Customer/verifyToken', objVerifcationDet, function (response) {
            $('#signotp_error').html('');
            var objVerifyResponse = 0;
            objVerifyResponse = getObjectLength(response);
            if (objVerifyResponse > 0 && 'fail' != response.type) {
                $('#mps-otp').modal('hide');
                location.reload();
                return true;
            } else {
                $('#signotp_error').html(response.message);
                return false;
            }
        });
    }

    /**
     * @author Ctel
     * @returns integer It will return an integer response
     */
    function clearCustomerInputs() {
        $("#aregemail_m").val('');
        $("#aregupwd_m").val('');
        $("#aregmobNo_m").val('');
        $("#areguname_m").val('');
        $("#verifyidd_m").val('');
        return 1;
    }
    ;


    /**
     * @author Ctel
     * @ignore It will handle resend verification code activities
     */
    $('#resendbtn').click(function ()
    {
        var objResendToken = {};
        objResendToken = {
            mobile: strMobile,
            customerId: intCustomerId,
        };
        $.post(webUrl + 'Login/Customer/resendToken', objResendToken, function (response) {
            var objResendResponse = 0;
            objResendResponse = getObjectLength(response);
            if (objResendResponse > 0 && '' != response.data.smsToken) {
                strSMSToken = response.data.smsToken;
                strToken = response.data.verifyToken;
                return 1;
            } else {
                return false;
            }
        });
    });

    /**
     * @author Digital Today
     * @ignore It will handle login functionality
     */
    $('#login_btn1').click(function ()
    {
            $("#errMessage").html("");            
            $("#usernameErr").text("");
            $("#passwordErr").text("");
        var objLogin = {};
        objLogin = {
            username: $('#user_name_m').val(),
            password: $('#user_password_m').val()
        }
        $.post(webUrl + 'Login/Customer/SignIN', objLogin, function (response) {            
            if (1 == response.data) {
                location.reload();
                return true;
            } else {               
                    $("#usernameErr").text(response.data.username);                                                      
                    $("#passwordErr").text(response.data.password);
                if(!response.data.username && !response.data.username){
                    $("#errMessage").html(response.message);                    
                }
                return false;
            }

        });
    });



});


