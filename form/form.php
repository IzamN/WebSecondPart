<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link rel="stylesheet" href="style.css">

  <title>Form</title>
</head>

<body>
  <?php
    if (!empty($messages1['good'])) {
      print($messages1['good']);
    }
    if (!empty($messages1['login'])) {
      print($messages1['login']);
    }
    if (empty($_SESSION['login'])) {
    ?>
        <div id="header"><a href=login.php>Войти</a></div>
    <?php
    }
    
  ?>
  <form action="" method="POST">
    <h1>Форма</h1>

    <div class="form-content">
      <div class="form-item">
        <label  for="name" <?php if ($errors['name']) {print 'class="error"';} ?>>ФИО </label>
        <input class="input name" type="text" name="name" value="<?php echo $values['name']; ?>">
      </div>
      <div class="form-item">
        <label for="phone" <?php if ($errors['phone1'] || $errors['phone2']) {print 'class="error"';} ?>>Телефон<?php if ($messages['phone1']) print($messages['phone1']); else if ($messages['phone2'])print($messages['phone2']); ?></label>
        <input class="input tel" type="tel" placeholder="" name="phone" value="<?php print $values['phone']; ?>">
      </div>
      <div class="form-item">
          <label for="email" <?php if ($errors['email1'] || $errors['email2']) {print 'class="error"';} ?>>Email<?php if ($messages['email1']) print($messages['email1']);  else if ($messages['email2'])print($messages['email2']); ?></label> 
        <input class="input email" type="email"  name="email" value="<?php print $values['email']; ?>">
      </div>
      <span <?php if ($errors['year']) {print 'class="error"';} ?>>Дата рождения <?php if ($messages['year']) print($messages['year']);?></span>
      <div class="date">
        <div class="date-item">
      <span>Число:</span>
        <select name="day">
          <?php
          for ($i = 1; $i < 32; $i++) {
            printf('<option value="%d">%d </option>', $i, $i);
          }
          ?>
        </select>
        </div>
        <div class="date-item">
        <span>Месяц:</span>
        <select name="month">
          <?php
          for ($i = 1; $i < 13; $i++) {
            printf('<option value="%d">%d </option>', $i, $i);
          }
          ?>
        </select>
        </div>
        <div class="date-item">
        <span >Год :</span>
        <select name="year">
          <?php 
            for ($i = 2024; $i >= 1922; $i--) {
              if ($i == $values['year']) {
                printf('<option selected value="%d">%d год</option>', $i, $i);
              } else {
              printf('<option value="%d">%d год</option>', $i, $i);
              }
            }
          ?>
        </select>
        </div>
        
      </div>
      <div class="form-item">
        <p>Пол:</p>
        <ul>
          <li>
            <input type="radio" id="radioMale" name="pol" value="male"  <?php if ($values['gender'] == 'male') {print 'checked';} ?> checked>
            <label for="radioMale">Муж</label>
          </li>
          <li>
            <input type="radio" id="radioFemale" name="pol" value="female" <?php if ($values['gender'] == 'female') {print 'checked';} ?>>
            <label for="radioFemale">Жен</label>
          </li>
        </ul>
      </div>
      <div class="form-item">
        <p <?php if ($errors['languages']) {print 'class="error"';} ?> >Любимый язык программирования:<?php if ($messages['languages']) print($messages['languages']);?></p>
        <ul>
          <li>
            <input type="checkbox" id="JS" name="languages[]" value='1' 
            <?php if (isset($values['languages']) && !empty($values['languages']) && in_array(1, unserialize($values['languages']))) {print 'checked';}?>
            >
            <label for="JS">JS</label>
          </li>
          <li>
            <input type="checkbox" id="Python" name="languages[]" value='2'  <?php if (isset($values['languages']) && !empty($values['languages']) && in_array(2, unserialize($values['languages']))) {print 'checked';}?>
            >
            <label for="Python">Python</label>
          </li>
          <li>
            <input type="checkbox" id="C++" name="languages[]" value='3' <?php if (isset($values['languages']) && !empty($values['languages']) && in_array(3, unserialize($values['languages']))) {print 'checked';}?> >
            <label for="C++">C++</label>
          </li>
        </ul>
      </div>
      <div class="form-item">
        <p  <?php if ($errors['biography1'] || $errors['biography2']) {print 'class="error"';} ?>> О себе:<?php if ($messages['biography1']) print($messages['biography1']); else if ($messages['biography2'])print($messages['biography2']);?> </p>
        <textarea name="biography" cols=24 rows=4 maxlength=128 ><?php if ($values['biography']) print($values['biography']); ?></textarea>
      </div>
    </div>
    <div class="send">
      <div class="contract">
        <input type="checkbox" id="checkboxContract" name="checkboxContract" <?php if ($values['checkboxContract'] == '1') {print 'checked';} ?> >
        <label for="checkboxContract">С контрактом ознакомлен(а)  <?php if ($messages['checkboxContract']) print($messages['checkboxContract']);?></label>
      </div>
      <?php if (!empty($_SESSION['login'])) {echo '<input type="hidden" name="token" value="' . $_SESSION["token"] . '">'; } ?>
      <input class="btn" type="submit" name="submit" value="Отправить" />
    </div>
  </form>
</body>

</html>
