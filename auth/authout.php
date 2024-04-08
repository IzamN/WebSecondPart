<?php
 session_start();
 session_destroy();
 $_SERVER['PHP_AUTH_USER']='';
 $_SERVER['PHP_AUTH_PW']='';

  header('Location: ./');
// header('Location: http://u67359.kubsu-dev.ru/web2/auth/');
include('index.php');

exit();


