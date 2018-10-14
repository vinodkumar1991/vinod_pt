<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HireAMechanicController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionCreate()
	{ 	
           $arrErrors = array();
           $objHireAMechanic = NULL;
           if (isset($_POST['create_hire'])) {
            $objHireAMechanic = new HireAMechanicForm();
            $objHireAMechanic->attributes = $_POST;
            if ($objHireAMechanic->validate()) {
               $arrInputs = $objHireAMechanic->attributes;
	     }
           else {
                $arrErrors = $objHireAMechanic->errors;
            }
            }
           $this->render('/HireAMechanic/HireAMechanic', array('errors' => $arrErrors));
           }
public function actionFunction()
	{ 	
           
		echo "hii";
	}
        
}