<?php
// $_SERVER['PHP_AUTH_USER']='';
// $_SERVER['PHP_AUTH_PW']='';
session_start();
 session_destroy();
// header('Location: ./index.php');


include('auth.php');
header('Location: http://u67359.kubsu-dev.ru/web2/auth/index.php');
exit();


