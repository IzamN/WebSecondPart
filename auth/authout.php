<?php
$_SERVER['PHP_AUTH_USER']='';
$_SERVER['PHP_AUTH_PW']='';
session_start();
session_destroy();
// header('Location: ./index.php');
// include ('index.php');
header('Location: ./');
exit();


