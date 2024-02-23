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
  <style>
    <?php echo file_get_contents("style.css"); ?>
  </style>

  <form action="" method="POST">
    <h1>Форма</h1>

    <?php
    if (!empty($messages)) {
      print('<div id="messages">');
      // Выводим все сообщения.
      foreach ($messages as $message) {
        print($message);
      }
      print('</div>');
    }
    ?>

    <div class="form-content">
      <div class="form-item">
        <label class="" for="name" <?php if ($errors['name']) {print 'class="error"';} ?>> <?php $messages['name']?>ФИО</label><br>
        <input class="input name" type="text" name="name" value="<?php echo $values['name']; ?>">
      </div>
      <div class="form-item">
        <label class="" for="phone" <?php if ($errors['phone1'] || $errors['phone2']) {print 'class="error"';} ?>>Teлефон</label><br>
        <input class="input tel" type="tel" placeholder="" name="phone" value="<?php print $values['phone']; ?>">
      </div>
      <div class="form-item">
          <label class="" for="email" <?php if ($errors['email1'] || $errors['email2']) {print 'class="error"';} ?>>Email</label> <br>
        <input class="input email" type="email"  name="email" value="<?php print $values['email']; ?>">
      </div>
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
        <span <?php if ($errors['year']) {print 'class="error"';} ?>>Год :</span>
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
        <p <?php if ($errors['languages']) {print 'class="error"';} ?> >Любимый язык программирования:</p>
        <ul>
          <li>
            <input type="checkbox" id="JS" name="languages[]" value='JS' <?php if (!empty($values['languages'])) {print 'checked';}?>>
            <label for="JS">JS</label>
          </li>
          <li>
            <input type="checkbox" id="Python" name="languages[]" value='Python' <?php if (!empty($values['languages'])) {print 'checked';}?>>
            <label for="Python">Python</label>
          </li>
          <li>
            <input type="checkbox" id="C++" name="languages[]" value='C++' <?php if (!empty($values['languages'])) {print 'checked';}?>>
            <label for="C++">C++</label>
          </li>
        </ul>
      </div>
      <div class="form-item">
        <p class="big-text" <?php if ($errors['biography1'] || $errors['biography2']) {print 'error';} ?>>О себе:</p>
        <textarea name="biography" cols=24 rows=4 maxlength=128></textarea>
      </div>
    </div>
    <div class="send">
      <div class="contract">
        <input type="checkbox" id="checkboxContract" name="checkboxContract" <?php if ($values['checkboxContract'] == '1') {print 'checked';} ?> >
        <label for="checkboxContract">С контрактом ознакомлен(а)</label>
      </div>
      <input class="btn" type="submit" name="submit" value="Отправить" />
    </div>
  </form>
</body>

</html>
