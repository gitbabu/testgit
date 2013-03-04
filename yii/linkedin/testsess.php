<?php
session_start();
$_SESSION["test_sess"]="Zingo";
error_reporting(E_ALL);
print_r($_SESSION);
//print_r(Yii::app()->session);
?>