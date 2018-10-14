<?php

class MPSUserRegistrationController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionDelboydetails() {
        $shopid = $_GET['id'];
        Yii::app()->session['Variant'] = $shopid;
        $delv_details = Yii::app()->db->createCommand("SELECT dd.`delv_id`,dd.`del_nm`, dd.`img_path`, dd.`age`, 
		dd.`contact`, dd.`adrs`,sd.shop_nm,dd.`reg_cert`, dd.`created_date` FROM `delv_details` as dd,`shop_details` as sd where dd.shop_id=sd.shop_id")->queryAll();

        $shop_names = Yii::app()->db->createCommand("SELECT shop_nm as shop_nm,shop_id as shop_id
        FROM shop_details where role_id=1")->queryAll();
        $MPSCOUNTRIES = Yii::app()->db->createCommand("SELECT distinct MPS_COUNTRIES.id,MPS_COUNTRIES.name FROM `MPS_LOCATIONS`,MPS_COUNTRIES WHERE
		MPS_LOCATIONS.country_code=MPS_COUNTRIES.id")->queryAll();

        $shop_details = Yii::app()->db->createCommand("SELECT   distinct shop_details.shop_nm,shop_details.shop_id,shop_details.shop_img,shop_details.`shopowner_nm`, shop_details.`num_mechanic`, shop_details.`count_service`,shop_details.address,shop_details.contact_num FROM `shop_details`,shop_services_details  WHERE  shop_details.id=$shopid")->queryAll();

        $rawdblData = Yii::app()->db->createCommand("SELECT max(delv_id) as delv_id
        FROM delv_details where delv_id LIKE '%dlb%'")->queryAll();

        $dlb_unique_id = $rawdblData[0]['delv_id'];
        $dlb_unique_id = explode('dlb', $dlb_unique_id);

        foreach ($shop_details as $detail) {
            $shop_id = $detail['shop_id'];
            $fetchservices = Yii::app()->db->createCommand("SELECT  shop_services_details.service_name FROM shop_services_details WHERE 
				  shop_unique_id='$shop_id'")->queryAll();
        }
        $message = "Delivery boy added successfully";
        if (empty($dlb_unique_id[1])) {

            $dlb_unique_id = 'dlb001';
            $this->render('delboy', array("details" => $shop_details, "fetchservices" => $fetchservices, "dlb_unique_id" => $dlb_unique_id, "MPSCOUNTRIES" => $MPSCOUNTRIES, "shop_names" => $shop_names, 'delv_details' => $delv_details, "message" => $message));
        } else {
            $this->render('delboy', array("details" => $shop_details, "fetchservices" => $fetchservices, "dlb_unique_id" => $dlb_unique_id[1], "MPSCOUNTRIES" => $MPSCOUNTRIES, "shop_names" => $shop_names, 'delv_details' => $delv_details, "message" => $message));
        }
    }

    public function actiongetLocationlist() {
        $shop_id = $_POST['shopid'];
        $html = '';
        $shop_det = Yii::app()->db->createCommand("SELECT  city FROM `shop_details` WHERE  shop_id='$shop_id'")->queryAll();
        foreach ($shop_det as $shop_d) {
            //
            $city_code = $shop_d['city'];
            // echo "SELECT  location_name FROM `MPS_LOCATIONS` WHERE  city=$city_code";
            $shop_detLOC = Yii::app()->db->createCommand("SELECT  location_name FROM `MPS_LOCATIONS` WHERE  city_code=$city_code")->queryAll();
            foreach ($shop_detLOC as $loc) {
                $html.=$loc['location_name'];
            }
        }

        echo $html;
    }

    public function actiondeleteMshop() {
        $shopuiqueid = $_POST['shopid'];
        // exit;
        $sql = Yii::app()->db->createCommand("UPDATE shop_details SET status = 1 WHERE id=$shopuiqueid")->execute();
        echo '1';
    }

    public function actionuserRegister() {//select users
        $vmake = Yii::app()->db->createCommand("SELECT * FROM MPS_VEHICLE_MAKES")->queryAll();

        $shop_names = Yii::app()->db->createCommand("SELECT shop_nm as shop_nm,shop_id as shop_id
         FROM shop_details where role_id=1")->queryAll();

        //fetch countries
        //$MPSCOUNTRIES = MPSCOUNTRIES::model()->findAll();
        $MPSCOUNTRIES = Yii::app()->db->createCommand("SELECT distinct MPS_COUNTRIES.id,MPS_COUNTRIES.name FROM `MPS_LOCATIONS`,MPS_COUNTRIES WHERE
		MPS_LOCATIONS.country_code=MPS_COUNTRIES.id")->queryAll();
        //fetch shop unique id(exp:mse001)

        $rawData = Yii::app()->db->createCommand("SELECT max(shop_id) as shop_id
        FROM shop_details where shop_id LIKE '%mse%'")->queryAll();

        $rawdblData = Yii::app()->db->createCommand("SELECT max(delv_id) as delv_id
        FROM delv_details where delv_id LIKE '%dlb%'")->queryAll();
        $rawslfData = Yii::app()->db->createCommand("SELECT max(self_unique_id) as self_unique_id
        FROM MPS_SELFDRIVEAGENCY_DETAILS where self_unique_id LIKE '%SLD%'")->queryAll();

        $rawhmcData = Yii::app()->db->createCommand("SELECT max(hire_mechanic_id) as hire_mechanic_id
        FROM HIRE_A_MECHANIC where hire_mechanic_id LIKE '%HMC%'")->queryAll();

        $shop_unique_id = $rawData[0]['shop_id'];
        $shopid = explode('mse', $shop_unique_id);

        $dlb_unique_id = $rawdblData[0]['delv_id'];
        $dlb_unique_id = explode('dlb', $dlb_unique_id);
        $slf_unique_id = $rawslfData[0]['self_unique_id'];
        $selfdrive_id = explode('SLD', $slf_unique_id);
        //print_r($selfdrive_id);

        $hire_mechanic_id = $rawhmcData[0]['hire_mechanic_id'];
        $hire_mechanic_id = explode('HMC', $hire_mechanic_id);
        /* 		if(empty($hire_mechanic_id[1]) || empty($selfdrive_id[1]) )
          {
          $shopid='mse001';
          $dlb_unique_id='dlb001';
          $selfdrive_id='SLD001';

          $hire_mechanic_id='HMC001';

          $this->render('userRegi',array("shopuniqueid"=>$shopid,"dlb_unique_id"=>$dlb_unique_id,"selfuniqueid"=>$selfdrive_id,"hireid"=>$hire_mechanic_id,'MPSCOUNTRIES'=>$MPSCOUNTRIES,'shop_names'=>$shop_names));

          }
          else
          {
          //echo $selfdrive_id[1];


          $this->render('userRegi',array("shopuniqueid"=>$shopid[1],"dlb_unique_id"=>$dlb_unique_id[1],
          "selfuniqueid"=>$selfdrive_id[1],"hireid"=>$hire_mechanic_id[1],'MPSCOUNTRIES'=>$MPSCOUNTRIES,'shop_names'=>$shop_names));

          }
         */


        if (empty($shopid[1]) || empty($dlb_unique_id[1]) || empty($selfdrive_id[1]) || empty($hire_mechanic_id[1])) {

            $shopid = 'mse001';
            $dlb_unique_id = 'dlb001';
            $selfdrive_id = 'SLD001';
            $hire_mechanic_id = 'HMC001';

            $this->render('userRegi', array("shopuniqueid" => $shopid, "dlb_unique_id" => $dlb_unique_id, "selfuniqueid" => $selfdrive_id, "hireid" => $hire_mechanic_id, 'MPSCOUNTRIES' => $MPSCOUNTRIES, 'shop_names' => $shop_names, 'vmake' => $vmake));
        } else {
            //echo $selfdrive_id[1];


            $this->render('userRegi', array("shopuniqueid" => $shopid[1], "dlb_unique_id" => $dlb_unique_id[1],
                "selfuniqueid" => $selfdrive_id[1], "hireid" => $hire_mechanic_id[1], 'MPSCOUNTRIES' => $MPSCOUNTRIES, 'shop_names' => $shop_names, 'vmake' => $vmake));
        }
    }

    public function actiongetZip() {
        $area = $_POST['area'];
        $MPzip = Yii::app()->db->createCommand("SELECT MPS_LOCATIONS.zipcode FROM `MPS_LOCATIONS` where  MPS_LOCATIONS.area_code=$area")->queryAll();
        foreach ($MPzip as $MPzi) {
            /* if($area['area_code']!='1')
              { */
            echo $MPzi['zipcode'];
            //}
        }
    }

    public function actionGetarea() {
        $city_id = $_POST['City'];

        //echo "SELECT MPS_LOCATIONS.area_code,MPS_LOCATIONS.location_name FROM `MPS_LOCATIONS` where  MPS_LOCATIONS.city_code=$city_id";
        //exit;
        $MPSrea = Yii::app()->db->createCommand("SELECT MPS_LOCATIONS.area_code,MPS_LOCATIONS.location_name FROM `MPS_LOCATIONS` where  MPS_LOCATIONS.city_code=$city_id ")->queryAll();

        //$city_id = $_POST['pdelcity'];

        $aid = array();
        $aname = array();
        $html = "";
        $html.="<option value=''>Select Area</option>";
        foreach ($MPSrea as $area) {
            /* if($area['area_code']!='1')
              { */
            $html .="<option value='" . $area['area_code'] . "'>" . $area['location_name'] . "</option>";
            //}
        }
        $html .="<option value='1'>Others</option>";
        echo $html;
    }

    public function actionGetstate() {
        $country_id = $_POST['Country'];
        $MPSstate = Yii::app()->db->createCommand("SELECT distinct MPS_STATES.id,MPS_STATES.name FROM `MPS_LOCATIONS`,MPS_STATES WHERE
		MPS_LOCATIONS.state_code=MPS_STATES.id and MPS_LOCATIONS.country_code=$country_id ")->queryAll();


        $sid = array();
        $sname = array();
        $html = "";
        $html.="<option value=''>Select State</option>";
        foreach ($MPSstate as $state) {

            $html .="<option value='" . $state['id'] . "'>" . $state['name'] . "</option>";
        }

        echo $html;
    }

    public function actionGetcity() {
        $state_id = $_POST['State'];
        $MPScity = Yii::app()->db->createCommand("SELECT distinct MPS_CITIES.id,MPS_CITIES.name FROM `MPS_LOCATIONS`,MPS_CITIES WHERE MPS_LOCATIONS.city_code=MPS_CITIES.id and MPS_LOCATIONS.state_code=$state_id")->queryAll();

        $cid = array();
        $cname = array();
        $html = "";
        $html.="<option value=''>Select City</option>";
        foreach ($MPScity as $city) {

            $html .="<option value='" . $city['id'] . "'>" . $city['name'] . "</option>";
        }

        echo $html;
    }

    public function actionManageruser() {//select users
        $getUserInfo = Yii::app()->db->createCommand("SELECT mci.id, mci.username, mci.surname, mci.emailid, mci.mobile_no, mci.location FROM `MPS_CUSTOMER_INFO` as mci,MPS_CUSTOMERACC_INFO as mcai WHERE mcai.loginid=mci.id")->queryAll();
        $this->render('customers', array("customersdata" => $getUserInfo));
    }

    public function actiongetshopUniqueId() {


        $rawData = Yii::app()->db->createCommand("SELECT max(owner_emailid)
        FROM shop_details")->queryAll();
        echo $emailcount = count($rawData);
    }

    public function actionemailValidation() {

        $own_emailid = $_POST['emailid'];
        $rawData = Yii::app()->db->createCommand("SELECT owner_emailid
        FROM shopowner_details
        WHERE owner_emailid='$own_emailid'")->queryAll();
        echo $emailcount = count($rawData);
    }

    public function actiongetCities() {
        $MPSCITIES = MPSCITIES::model()->findAll();
        // print_r($country);
        // exit;   

        $this->render('userRegi', array('MPSCITIES' => $MPSCITIES));
    }

    public function actiongetIds() {
        $id = $_POST['roleval'];

        if ($id > 1) {
            $rawData = Yii::app()->db->createCommand("SELECT max(delv_id) as delv_id
        FROM delv_details where roleid = $id")->queryAll();
            $shop_unique_id = $rawData[0]['delv_id'];

            //$dlbshopid=explode('dlb',$shop_unique_id);
            if (!isset($shop_unique_id)) {
                echo $shop_unique_id = 'dlb001';
            } else {

                $shop_unique_id = explode('dlb', $shop_unique_id);
                $sp = $shop_unique_id[1] + 1;
                echo 'dlb00' . $sp;
            }
        } else if ($id > 0) {
            $mech_unique_id = Yii::app()->db->createCommand("SELECT max(shop_id) as shop_id
        FROM shop_details where role_id = '$id'")->queryAll();
            $mech_unique = $mech_unique_id[0]['shop_id'];
            //$mech_unique=explode('mse',$mech_unique);
            //echo $mech_unique; 
            if (!isset($mech_unique)) {
                echo $mech_unique = 'mse001';
            } else {

                $mech_unique = explode('mse', $mech_unique);
                $mu = $mech_unique[1] + 1;
                echo 'mse00' . $mu;
            }
        }
        //print_r($dlbshopid[1]);
        //exit;
        //echo $dlbshopid[1].'**'.$mech_unique[1]; 
    }

    public function actiondelboysub() {

        $MPSCOUNTRIES = MPSCOUNTRIES::model()->findAll();




        $delroleid = $_POST['delroleid'];

        $delnm = $_POST['delnm'];
        $age = $_POST['age'];
        $wldelshop = $_POST['wldelshop'];
        $delemailid = $_POST['delemailid'];
        //$country=$_POST['pdelcountry'];
        $delid = $_POST['delid'];
        $deladrs = $_POST['deladrs'];
        $adrs2 = $_POST['adrs2'];
        $delcon = $_POST['delcon'];
        //$pdelstate=$_POST['pdelstate'];
        //$pdelcity=$_POST['pdelcity'];
        //$pdelarea=$_POST['pdelarea'];
        //$img_path=$_FILES['picid']['tmp_name'];
        $idproof = Yii::app()->request->baseUrl;
        $url2 = $_SERVER['DOCUMENT_ROOT'] . "$idproof/users_images/dlb/idproof/";
        $uploadfile1 = $url2 . basename($_FILES['picid']['tmp_name']);
        move_uploaded_file($_FILES['picid']['tmp_name'], $uploadfile1);
        $image1 = file_get_contents($uploadfile1);
        $encrypted = base64_encode($image1);

        //-------------
        $regcert = Yii::app()->request->baseUrl;
        $url = $_SERVER['DOCUMENT_ROOT'] . "$regcert/users_images/dlb/rc/";
        $uploadfile = $url . basename($_FILES['rc']['tmp_name']);
        move_uploaded_file($_FILES['rc']['tmp_name'], $uploadfile);


        $regcertadrs = Yii::app()->request->baseUrl;
        $urladrs = $_SERVER['DOCUMENT_ROOT'] . "$regcertadrs/users_images/dlb/addressproof/";
        $uploadfileadrs = $urladrs . basename($_FILES['addressproof']['tmp_name']);
        move_uploaded_file($_FILES['addressproof']['tmp_name'], $uploadfileadrs);


        $delusernm = $_POST['delusernm'];
        $deluserpwd = $_POST['deluserpwd'];
        $Locationlist = 'N/A';

        /*  $wldelcountry=$_POST['wldelcountry'];
          $wldelstate=$_POST['wldelstate'];
          $wldelcity=$_POST['wldelcity'];
          $wldelarea=$_POST['wldelarea']; */


        $model = new DelvDetails();
        //print_r($model->shop_id);
        $model->shop_id = $wldelshop;
        $model->del_nm = $delnm;
        $model->age = $age;
        $model->delv_id = $delid;
        $model->roleid = $delroleid;
        $model->adrs = $deladrs;
        $model->adrs2 = $adrs2;
        $model->contact = $delcon;
        $model->area = 'N/A';
        //$model->state=$pdelstate;
        //$model->city=$pdelcity;
        //$model->area=$pdelarea;
        $model->reg_cert = basename($_FILES['rc']['tmp_name']);
        $model->img_path = basename($_FILES['picid']['tmp_name']);
        $model->adrs_proof = basename($_FILES['addressproof']['tmp_name']);
        $model->data = $encrypted;
        $model->save();

        //delivery boy DETAILS
        $models = new ShopownerDetails();
        $models->shop_unique_id = $delid;
        $models->username = $delusernm;
        $models->password = md5($deluserpwd);
        $models->owner_emailid = $delemailid;
        $models->save();

        //---------
        //delivery boy DETAILS
        $model3 = new DevWorklocDetails();
        //$model3->id=111112;
        /* $model3->dev_id=$delid;
          $model2->country=$wldelcountry;
          $model2->roleid=$delroleid;
          $model2->state=$wldelstate;
          $model2->city=$wldelcity;
          $model2->area=$wldelarea;
          $model3->save(); */

        //worklocation details
        //------------------------
        $rawData = Yii::app()->db->createCommand("SELECT max(delv_id) as delv_id
        FROM delv_details where delv_id like '%dlb%'")->queryAll();
        $shop_unique_id = $rawData[0]['delv_id'];
        $dlbshopid = explode('dlb', $shop_unique_id);

        $shop_names = Yii::app()->db->createCommand("SELECT shop_nm as shop_nm,shop_id as shop_id
        FROM shop_details where role_id=1")->queryAll();

        $mech_unique_id = Yii::app()->db->createCommand("SELECT max(shop_id) as shop_id
        FROM shop_details where shop_id LIKE '%mse%'")->queryAll();
        $mech_unique = $mech_unique_id[0]['shop_id'];
        $mech_unique = explode('mse', $mech_unique);




        //$this->render('userRegi',array('message'=>$message,'MPSCOUNTRIES'=>$MPSCOUNTRIES));
        $message = 'Successfully Inserted';
        $id = Yii::app()->session['Variant'];
        $this->redirect("Delboydetails?id=$id&spid=$wldelshop");
        /*  if(empty($dlbshopid[1]) || empty($mech_unique[1]))
          {
          $dlbshopid='dbl001';
          $mech_unique='mse001';

          $this->render('userRegi',array("shopuniqueid"=>$mech_unique,"dlb_unique_id"=>$dlbshopid,'MPSCOUNTRIES'=>$MPSCOUNTRIES,'message'=>$message,'shop_names'=>$shop_names));
          }
          else
          {

          $this->render('userRegi',array("shopuniqueid"=>$mech_unique[1],"dlb_unique_id"=>$dlbshopid[1],'MPSCOUNTRIES'=>$MPSCOUNTRIES,'message'=>$message,'shop_names'=>$shop_names));
          } */
    }

    public function actionimageupload() {

        $user = Yii::app()->user->getState('user');
        if (!isset($user)) {
            $this->render('dashboard');
        } else {

            $MPSCOUNTRIES = Yii::app()->db->createCommand("SELECT distinct MPS_COUNTRIES.id,MPS_COUNTRIES.name FROM `MPS_LOCATIONS`,MPS_COUNTRIES WHERE
		MPS_LOCATIONS.country_code=MPS_COUNTRIES.id")->queryAll();




            $idproof = Yii::app()->request->baseUrl;
            $url2 = $_SERVER['DOCUMENT_ROOT'] . "$idproof/users_images/mse/idproof/";
            $uploadfile1 = $url2 . basename($_FILES['userfile']['tmp_name']);
            move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile1);
            $orgpath = 'mps/index.php/users_images/mse/idproof/' . basename($_FILES['userfile']['tmp_name']);
            $image1 = file_get_contents($uploadfile1);
            $encrypted = base64_encode($image1);
            //----------------------------
            /* $url3=$_SERVER['DOCUMENT_ROOT']."$idproof/users_images/mse/addressproof/";
              $uploadfile2 = $url3 .basename($_FILES['adrsroof']['tmp_name']);
              move_uploaded_file($_FILES['adrsroof']['tmp_name'], $uploadfile);
              $image2=file_get_contents($uploadfile2);
              $encrypted=base64_encode($image2); */
            //-----------------------------------------

            $email = $_POST['emailid'];

            $shop_nm = $_POST['shop_nm'];
            $veh_type = $_POST['veh_type'];
            $city = $_POST['city'];
            $country = $_POST['country'];
            $shopid = $_POST['shopid'];
            $roletype = $_POST['roletype'];

            $area = $_POST['area'];
            $ownername = $_POST['ownername'];
            $num_mec = $_POST['num_mech'];
            $address = $_POST['adrs'];

            //$zipcode=$_POST['zipcode'];

            $count_service = $_POST['servicecap'];

            $contact_num = $_POST['cont'];
            $location = $_POST['location'];
            $locationexp = explode(',', $location);
            $lat = $locationexp[0];
            $long = $locationexp[1];
            $typeofservices = $_POST['typeofservices'];
            //shopowner_details

            $username = $_POST['username'];
            $password = md5($_POST['password']);


            //shop details
            $model = new ShopDetails();


            $model->shop_nm = $shop_nm;
            $model->veh_type = $veh_type;
            $model->city = $city;
            $model->country = $country;
            $model->shop_id = $shopid;
            $model->sector = $area;
            $model->shopowner_nm = $ownername;
            $model->num_mechanic = $num_mec;
            $model->address = $address;
            $model->role_id = $roletype;
            $model->latitude = $lat;
            $model->longitude = $long;
            //$model->zipcode=$zipcode;
            $model->img_path = basename($_FILES['userfile']['tmp_name']);
            $model->data = $encrypted;
            $model->shop_img = $orgpath;
            $model->contact_num = $contact_num;


            $model->count_service = $count_service;

            $model->save();

            //SHOP OWNER DETAILS
            $models = new ShopownerDetails();
            $models->shop_unique_id = $shopid;
            $models->username = $username;
            $models->password = $password;
            $models->owner_emailid = $email;
            $models->save();

            //services details

            foreach ($typeofservices as $typeserve) {
                $modelservice = new ShopServicesDetails();
                $modelservice->shop_unique_id = $shopid;
                $modelservice->service_name = $typeserve;
                $modelservice->save();
            }


            $shop_names = Yii::app()->db->createCommand("SELECT shop_nm as shop_nm,shop_id as shop_id
        FROM shop_details where role_id=1")->queryAll();

            $rawData = Yii::app()->db->createCommand("SELECT max(shop_id) as shop_id
        FROM shop_details")->queryAll();
            $shop_unique_id = $rawData[0]['shop_id'];
            $mech_shopid = explode('mse', $shop_unique_id);


            $rawData = Yii::app()->db->createCommand("SELECT max(delv_id) as delv_id
        FROM delv_details where delv_id like '%dlb%'")->queryAll();
            $shop_unique_id = $rawData[0]['delv_id'];
            $dlbshopid = explode('dlb', $shop_unique_id);

            $rawslfData = Yii::app()->db->createCommand("SELECT max(self_unique_id) as self_unique_id
        FROM MPS_SELFDRIVEAGENCY_DETAILS where self_unique_id LIKE '%SLD%'")->queryAll();
            $slf_unique_id = $rawslfData[0]['self_unique_id'];
            $selfdrive_id = explode('SLD', $slf_unique_id);

            $rawhmcData = Yii::app()->db->createCommand("SELECT max(hire_mechanic_id) as hire_mechanic_id
        FROM HIRE_A_MECHANIC where hire_mechanic_id LIKE '%HMC%'")->queryAll();
            $hire_mechanic_id = $rawhmcData[0]['hire_mechanic_id'];
            $hire_mechanic_id = explode('HMC', $hire_mechanic_id);

            //$this->render('userRegi',array('message'=>$message,'MPSCOUNTRIES'=>$MPSCOUNTRIES));
            if (empty($mech_shopid[1]) || empty($dlbshopid[1]) || empty($selfdrive_id[1]) || $hire_mechanic_id[1]) {
                $mech_shopid = 'mse001';
                $dlbshopid = 'dlb001';
                $selfdrive_id = 'SLD001';
                $selfdrive_id = 'SLD001';
                $hire_mechanic_id = 'HMC001';
                $message = 'Successfully Inserted';
                $this->render('userRegi', array("shopuniqueid" => $mech_shopid, "dlb_unique_id" => $dlbshopid, "selfuniqueid" => $selfdrive_id, 'MPSCOUNTRIES' => $MPSCOUNTRIES, 'message' => $message, "shop_names" => $shop_names, "hireid" => $hire_mechanic_id));
            } else {
                $this->actionuserRegister();
                // $message='Successfully Inserted';
                // $this->render('userRegi',array("shopuniqueid"=>$mech_shopid[1],"dlb_unique_id"=>$dlbshopid[1],"selfuniqueid"=>$selfdrive_id,'MPSCOUNTRIES'=>$MPSCOUNTRIES,'message'=>$message,"shop_names"=>$shop_names));
            }
        }
    }

    public function actionsaveUser() {
        //$img_path=$_POST['userfile'];
        //$img_path=$_FILES['userfile']['tmp_name'];

        $email = $_POST['email'];
        $shop_nm = $_POST['shop_nm'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $shopid = $_POST['shopid'];
        $area = $_POST['area'];
        $ownername = $_POST['ownername'];
        $num_mec = $_POST['num_mech'];
        $address = $_POST['adrs'];

        $zipcode = $_POST['zipcode'];

        $count_service = $_POST['count_service'];

        $contact_num = $_POST['cont'];

        $typeofservices = $_POST['typeofservices'];
        //shopowner_details

        $username = $_POST['username'];
        $password = md5($_POST['password']);


        //shop details
        $model = new ShopDetails();


        $model->shop_nm = $shop_nm;
        $model->city = $city;
        $model->country = $country;
        $model->shop_id = $shopid;
        $model->sector = $area;
        $model->shopowner_nm = $ownername;
        $model->num_mechanic = $num_mec;
        $model->address = $address;
        //$model->owner_emailid=$email;
        $model->zipcode = $zipcode;
        //$model->img_path=$img_path;
        $model->contact_num = $contact_num;


        $model->count_service = $count_service;

        $model->save();

        //SHOP OWNER DETAILS
        $models = new ShopownerDetails();
        $models->shop_unique_id = $shopid;
        $models->username = $username;
        $models->password = $password;
        $models->owner_emailid = $email;
        $models->save();

        //services details

        foreach ($typeofservices as $typeserve) {
            $modelservice = new ShopServicesDetails();
            $modelservice->shop_unique_id = $shopid;
            $modelservice->service_name = $typeserve;
            $modelservice->save();
        }

        //$this->actionSendEmail();
    }

    public function actionManagermechanicshop() {//select users
        /*  $rawData=Yii::app()->db->createCommand("SELECT `id`, `shop_nm`, `shop_id`, `contact_num`,`shopowner_nm`, `num_mechanic`, `address`, `city`,
          `sector`, `contact_num`, `zipcode`, `img_path`, `count_service`, `created_date` FROM `shop_details`")->queryAll();
          // or using: $rawData=User::model()->findAll();
          $dataProvider=new CArrayDataProvider($rawData, array(
          'keyField' => 'shop_nm',
          'sort'=>array(
          'attributes'=>array(
          'shop_nm','shop_id','shopowner_nm','address','contact_num','city','sector','zipcode','created_date'
          ),
          ),
          'pagination'=>array(
          'pageSize'=>2,
          ),
          )); */
        $mech_details = Yii::app()->db->createCommand("SELECT shop_details.id,shop_details.country,shop_details.shop_id,shop_details.contact_num,shop_details.shop_nm,
		shop_details.shopowner_nm,shop_details.address,shop_details.img_path,shop_details.created_date,
        count(delv_details.id) as num_delv,shop_details.count_service
		FROM shop_details
		left JOIN delv_details
		ON delv_details.shop_id=shop_details.shop_id and (select count(delv_id) from delv_details) group by  shop_details.id")->queryAll();

        foreach ($mech_details as $mech_det) {
            $shop_id = $mech_det['shop_id'];
            $Criteria = new CDbCriteria();
            $Criteria->condition = "shop_unique_id = '$shop_id'";
            $servicelist = ShopServicesDetails::model()->findAll($Criteria);
        }
        if (!empty($servicelist)) {
            foreach ($servicelist as $servicelis) {
                $service_names[] = $servicelis['service_name'];
            }
        } else {
            $service_names = 0;
        }

        $this->render('manageMechanicusers', array('mech_details' => $mech_details, "service_name" => $service_names));
    }

    public function actionBookingReports() {
        $bookingDetails = Yii::app()->db->createCommand("SELECT  distinct a.f_name,a.pickadrs,a.emailid,a.mobno,a.vehicle_type,a.bookid,a.model_id,b.models_name,c.makes_name,a.makes_id,a.service_name,a.plan_name, a.amout,a.timestamp,e.car_img,a.status,min(a.timestamp),a.mech_status,a.delv_status FROM MPS_PACKAGEWISE_AMT_DETAILS as a,MPS_VEHICLE_MODELS as b,MPS_VEHICLE_MAKES as c,MPS_CUSTOMER_INFO as mci,MPS_CUSTOMERACC_INFO as mcc,MPS_VEHICLES as e WHERE  b.models_id=a.model_id and c.makes_id=a.makes_id and mcc.loginid=a.userid and e.models_id=a.model_id group by a.id")->queryAll();
        $bookingbikeDetails = Yii::app()->db->createCommand("SELECT  distinct a.f_name,a.pickadrs,a.emailid,a.mobno,a.vehicle_type,a.bookid,a.model_id,b.bike_model_name,c.brand_name,a.makes_id,a.service_name,a.plan_name, a.amout,a.timestamp,b.bike_model_img_path,a.status,max(a.timestamp),a.mech_status,a.delv_status FROM MPS_PACKAGEWISE_AMT_DETAILS as a,bike_models
			as b,bike_brands as c,MPS_CUSTOMER_INFO as mci,MPS_CUSTOMERACC_INFO as mcc WHERE  b.bike_model_id=a.model_id and c.brand_id=a.makes_id and mcc.loginid=a.userid  and a.vehicle_type='bike' group by a.id")->queryAll();
        $final = array_merge($bookingDetails, $bookingbikeDetails);

        $this->render('manageBookings', array("BookingDetails" => $final));
    }

    public function actionFetchDeliveryboydata() {//select users
        //$delv_details = DelvDetails::model()->findAll();
        $delv_details = Yii::app()->db->createCommand("SELECT dd.`delv_id`,dd.`del_nm`, dd.`img_path`, dd.`age`, 
		dd.`contact`, dd.`adrs`,sd.shop_nm,dd.`reg_cert`, dd.`created_date` FROM `delv_details` as dd,`shop_details` as sd where dd.shop_id=sd.shop_id")->queryAll();

        $this->render('manageDeliveryboyusers', array('delv_details' => $delv_details));
    }

    public function actionSendEmail() {
        $transport = Swift_SmtpTransport::newInstance("smtp.gmail.com", 568, 'ssl');
        $transport->setUsername("beenapaninaik1991@gmail.com");
        $transport->setPassword("@!@!beena");
        $mailer = Swift_Mailer::newInstance($transport);
        $emailBody = 'dhkfsjklfj';
        /* $message = Swift_Message::newInstance();
          $message->setTo(array(
          "beenapaninaik1991@gmail.com" => "beena",

          ));


          $mailer->send($message);

          /* $mailer = Swift_Mailer::newInstance($transporter);
          $emailBody='dfhdfkjljklhk'; */
        $message = Swift_Message::newInstance()
                ->setFrom(array('beena' => 'beenapaninaik1991@gmail.com'))
                ->setTo(array("ani" => "laughingstarbeena@gmail.com"))
                ->setBody($emailBody, 'text/html');
        echo $result = $mailer->send($message);
    }

}
