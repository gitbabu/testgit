<?php 
	error_reporting(E_ALL);
	$b=Yii::getPathOfAlias('application'); 
		
		require_once($b .'/modules/yiiauth/components/Yiiauth.php');
		
		class Linktest extends Yiiauth{
			
			
		}
?>		