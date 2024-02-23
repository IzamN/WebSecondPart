<?php
error_reporting(E_ALL ^ E_WARNING);
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();
  if (!empty($_COOKIE['save'])) {
      setcookie('save', '', 100000);
      $messages[] = '<div class="good">Спасибо, результаты сохранены</div>';
  }
  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['phone1'] = !empty($_COOKIE['phone_error1']);
  $errors['phone2'] = !empty($_COOKIE['phone_error2']);
  $errors['email1'] = !empty($_COOKIE['email_error1']);
  $errors['email2'] = !empty($_COOKIE['email_error2']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['languages'] = !empty($_COOKIE['languages_error']);
  $errors['biography1'] = !empty($_COOKIE['biography_error1']);
  $errors['biography2'] = !empty($_COOKIE['biography_error2']);
  $errors['checkboxContract'] = !empty($_COOKIE['checkboxContract_error']);

  if ($errors['name']) {
    setcookie('name_error', '', 100000);
    $messages['name'] = '<p class="msg">Заполните поле ФИО</p>';
  }
  if ($errors['email1']) {
    setcookie('email_error1', '', 100000);
    $messages['email1'] = '<p class="msg">Заполните поле email</p>';
  } else if ($errors['email2']) {
    setcookie('email_error2', '', 100000);
    $messages['email2'] = '<p class="msg">Неверно заполнено поле email</p>';
  }
  if ($errors['phone1']){
    setcookie('phone_error1','',100000);
    $messages['phone1']='<p class="msg">Заполните поле телефон</p>';
  }
  if ($errors['phone2']){
    setcookie('phone_errors2','',100000);
    $messages['phone2']='<p class="msg">Неверно заполнено поле телефон</p>';
  }
 if ($errors['year']) {
    setcookie('year_error', '', 100000);
    $messages['year'] = '<p class="msg">Вам должно быть 14 лет</p>';
  }
  if ($errors['gender']) {
    setcookie('gender_error', '', 100000);
    $messages['gender'] = '<p class="msg">Выберите пол</p>';
  }
  if ($errors['languages']) {
    setcookie('languages_error', '', 100000);
    $messages['languages'] = '<p class="msg">Выберите язык программирования</p>';
  } 
  if ($errors['biography1']) {
    setcookie('biography_error1', '', 100000);
    $messages['biography1'] = '<p class="msg">Расскажи о себе что-нибудь</p>';
  } else if ($errors['biography2']) {
    setcookie('biography_error2', '', 100000);
    $messages['biography2'] = '<p class="msg">Недопустимый формат ввода (необходимо на русском)</p>';
  }
  if ($errors['checkboxContract']) {
    setcookie('checkboxContract_error', '', 100000);
    $messages['checkboxContract'] = '<p class="msg">Ознакомьтесь с контрактом</p>';
  }
  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['phone'] = empty($_COOKIE['phone_value']) ? '' : $_COOKIE['phone_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['day'] = empty($_COOKIE['day_value']) ? '' : $_COOKIE['day_value'];
  $values['month'] = empty($_COOKIE['month_value']) ? '' : $_COOKIE['month_value'];
  $values['year'] = empty($_COOKIE['year_value']) ? '' : $_COOKIE['year_value'];
  $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
  $values['languages'] = empty($_COOKIE['languages_value']) ? '' : $_COOKIE['languages_value'];
  $values['biography'] = empty($_COOKIE['biography_value']) ? '' : $_COOKIE['biography_value'];
  $values['checkboxContract'] = empty($_COOKIE['checkboxContract_value']) ? '' : $_COOKIE['checkboxContract_value'];
  include('form.php');
}else {
  $errors = FALSE;

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

  if (empty($name)) {
    setcookie('name_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('name_value', $name, time() + 30 * 24 * 60 * 60);
  }

  if (empty($phone)) {
    setcookie('phone_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } 
  // else if (!filter_var($phone, FILTER_VALIDATE_EMAIL)) {
  //   setcookie('phone_error2', '1', time() + 24 * 60 * 60);
  //   setcookie('phone_value', $phone, time() + 30 * 24 * 60 * 60);
  //   $errors = TRUE;
  // } 
  else {
    setcookie('phone_value', $phone, time() + 30 * 24 * 60 * 60);
  }

  if (empty($email)) {
    setcookie('email_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setcookie('email_error2', '1', time() + 24 * 60 * 60);
    setcookie('email_value', $email, time() + 30 * 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('email_value', $email, time() + 30 * 24 * 60 * 60);
  }

  if ((2024 - $year) < 14) {
    setcookie('year_error', '1', time() + 24 * 60 * 60);
    setcookie('year_value', $year, time() + 30 * 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('year_value', $year, time() + 30 * 24 * 60 * 60);
  }

  if (empty($gender)) {
    setcookie('gender_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('gender_value', $gender, time() + 30 * 24 * 60 * 60);
  }

  if (empty($languages)) {
    setcookie('languages_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('languages_value', serialize($languages), time() + 30 * 24 * 60 * 60);
  }

  if (empty($biography)) {
    setcookie('biography_error1', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else if (!preg_match('/^[\p{Cyrillic}\d\s,.!?-]+$/u', $biography)) {
    setcookie('biography_error2', '1', time() + 24 * 60 * 60);
    setcookie('biography_value', $biography, time() + 30 * 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('biography_value', $biography, time() + 30 * 24 * 60 * 60);
  }
  if ($checkboxContract == '') {
    setcookie('checkboxContract_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('checkboxContract_value', $checkboxContract, time() + 30 * 24 * 60 * 60);
  }

  if ($errors) {
    header('Location: index.php');
    exit();
  }
  else {
    setcookie('name_error', '', 100000);
    setcookie('phone_error1', '', 100000);
    setcookie('phone_error2', '', 100000);
    setcookie('email_error1', '', 100000);
    setcookie('email_error2', '', 100000);
    setcookie('year_error', '', 100000);
    setcookie('gender_error', '', 100000);
    setcookie('languages_error', '', 100000);
    setcookie('biography_error1', '', 100000);
    setcookie('biography_error2', '', 100000);
    setcookie('checkboxContract_error', '', 100000);
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
  setcookie('save', '1');
  header('Location: index.php');
}
// $name = $_POST['name'];
// $email = $_POST['email'];
// $day = $_POST['day'];
// $month = $_POST['month'];
// $year = $_POST['year'];
// $pol = $_POST['pol'];
// $phone = $_POST['phone'];
// $biography = $_POST['biography'];
// $checkboxContract=$_POST['checkboxContract'];
// if (isset($_POST["languages"])) {
//   $languages = $_POST["languages"];
//   $filtred_languages = array_filter(
//     $languages,
//     function ($value) {
//       return ($value == 'JS' || $value == 'Python' || $value == 'C++');
//     }
//   );
// }

// $errors = FALSE;

// if (empty($name)) {
//   print('
//     <h3>
//       Заполните имя.
//     </h3>');
//   $errors = TRUE;
// }
// if (empty($phone)) {
//   print('
//     <h3>
//       Заполните телефон.
//     </h3>');
//   $errors = TRUE;
// }

// if (empty($email)) {
//   print('
//     <h3>
//       Заполните email.
//     </h3>');
//   $errors = TRUE;
// }

// if (!is_numeric($year)) {
//   print('
//     <h3>
//       Неправильный формат ввода года.
//     </h3>');
//   $errors = TRUE;
// } else if ((2024 - $year) < 18) {
//   print('
//     <h3>
//       Форма отправляется только совершеннолетними, вам нет 18.
//     </h3>');
//   $errors = TRUE;
// }

// if (empty($languages)) {
//   print('
//     <h3>
//       Выберите любимый язык программирования.
//     </h3>');
//   $errors = TRUE;
// }


// if (empty($biography)) {
//   print('
//     <h3>
//       Расскажи о себе.
//     </h3>');
//   $errors = TRUE;
// } else if (!preg_match('/^[\p{Cyrillic}\d\s,.!?-]+$/u', $biography)) {
//   print('
//     <h3>
//       Недопустимый формат ввода биографии (русские буквы).
//     </h3>');
//   $errors = TRUE;
// }

// if ($checkboxContract == '') {
//   print('
//     <h3>
//       Ознакомьтесь с контрактом.
//     </h3>');
//   $errors = TRUE;
// }

// if ($errors) {
//   exit();
// }

// $user = 'u67359';
// $pass = '1353557';
// $db = new PDO('mysql:host=localhost;dbname=u67359', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

// try {
// $stmt = $db->prepare("INSERT INTO application (name, phone, email, day, month, year, pol, biography) VALUES (?, ?,?, ?, ?, ?,?,?)");
// $stmt->execute([$name, $phone,$email, $day, $month, $year, $pol, $biography]);
// $application_id = $db->lastInsertId();
// $stmt = $db->prepare("INSERT INTO languages (application_id, language) VALUES (?, ?)");
// foreach ($languages as $language) {
//   $stmt->execute([$application_id, $language]);
// }
// } catch (PDOException $e) {
//   print('Error : ' . $e->getMessage());
//   exit();
// }
//  header('Location: ?save=1');

?>
