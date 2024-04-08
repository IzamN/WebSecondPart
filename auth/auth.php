<?php
printf($_SERVER['PHP_AUTH_USER'])
if (empty($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW'])) {
    requireLogin();
}
else {
    printf('<div><a href=authout.php>Выйти</a></div>');
}
 $user = 'u67359';
 $pass = '1353557';
 $db = new PDO('mysql:host=localhost;dbname=u67359', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
//$db = new PDO('mysql:host=localhost;dbname=u67359', 'u67359', '29122003Nadya!');

$stmt = $db->prepare("SELECT login, password FROM admins WHERE login = ?");
$stmt->execute([$_SERVER['PHP_AUTH_USER']]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $validUser = $row['login'];
    $validPassHash = $row['password'];
} else {
    requireLogin();
}

if ($_SERVER['PHP_AUTH_USER'] != $validUser  || ($_SERVER['PHP_AUTH_PW']) != $validPassHash ) {
    requireLogin();
}
session_start();
function requireLogin() {
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="My site"');
    print('<h1>401 Требуется авторизация</h1>');
    exit();
}


