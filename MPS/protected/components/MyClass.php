<?php
public static function is_home_page() {
        $app = Yii::app();
         return $app->controller->route == $app->defaultController;
     }
	 
	 
	//MyClass::is_home_page(); require_once( dirname(__FILE__) . '/../components/helpers.php'); 
	 
	 ?>
	 