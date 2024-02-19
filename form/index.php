<?php
error_reporting(E_ALL ^ E_WARNING);
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['save'])) {
    print('
      <p>
        Спасибо, результаты сохранены.
      </p>
      ');
  }
  include('form.php');
  exit();
}

$name = $_POST['name'];
$email = $_POST['email'];
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$pol = $_POST['pol'];
$phone = $_POST['phone'];
$biography = $_POST['biography'];
$checkboxContract=$_POST['checkboxContract'];
if (isset($_POST["languages"])) {
  $languages = $_POST["languages"];
  $filtred_languages = array_filter(
    $languages,
    function ($value) {
      return ($value == 'JS' || $value == 'Python' || $value == 'C++');
    }
  );
}

$errors = FALSE;

if (empty($name)) {
  print('
    <h3>
      Заполните имя.
    </h3>');
  $errors = TRUE;
}
if (empty($phone)) {
  print('
    <h3>
      Заполните телефон.
    </h3>');
  $errors = TRUE;
}

if (empty($email)) {
  print('
    <h3>
      Заполните email.
    </h3>');
  $errors = TRUE;
}

if (!is_numeric($year)) {
  print('
    <h3>
      Неправильный формат ввода года.
    </h3>');
  $errors = TRUE;
} else if ((2024 - $year) < 18) {
  print('
    <h3>
      Форма отправляется только совершеннолетними, вам нет 18.
    </h3>');
  $errors = TRUE;
}

if (empty($languages)) {
  print('
    <h3>
      Выберите любимый язык программирования.
    </h3>');
  $errors = TRUE;
}


if (empty($biography)) {
  print('
    <h3>
      Расскажи о себе.
    </h3>');
  $errors = TRUE;
} else if (!preg_match('/^[\p{Cyrillic}\d\s,.!?-]+$/u', $biography)) {
  print('
    <h3>
      Недопустимый формат ввода биографии (русские буквы).
    </h3>');
  $errors = TRUE;
}

if ($checkboxContract == '') {
  print('
    <h3>
      Ознакомьтесь с контрактом.
    </h3>');
  $errors = TRUE;
}

if ($errors) {
  exit();
}

$user = 'u67359';
$pass = '1353557';
$db = new PDO('mysql:host=localhost;dbname=u67359', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

try {
$stmt = $db->prepare("INSERT INTO application (name, phone, email, day, month, year, pol, biography) VALUES (?, ?,?, ?, ?, ?,?,?)");
$stmt->execute([$name, $phone,$email, $day, $month, $year, $pol, $biography]);
$application_id = $db->lastInsertId();
$stmt = $db->prepare("INSERT INTO languages (application_id, language) VALUES (?, ?)");
foreach ($languages as $language) {
  $stmt->execute([$application_id, $language]);
}
} catch (PDOException $e) {
  print('Error : ' . $e->getMessage());
  exit();
}
 header('Location: ?save=1');

?>
