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

    <div class="form-content">

      <div class="form-item">
        <div name="nameErr"><?php echo $nameErr;?></div>
        <label class="" for="name">ФИО</label><br>
          <!-- <input class="line" name="name"> -->
        <input class="input name" type="text" name="name">
      </div>
      <div class="form-item">
        <label class="" for="phone">Teлефон</label><br>
          <!-- <input class="line" name="phone"> -->
        <input class="input tel" type="tel" placeholder="" name="phone">
      </div>
      <div class="form-item">
        <!-- <input class="line" name="email"> -->
          <label class="" for="email">Email</label> <br>
        <input class="input email" type="email"  name="email">
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
        <span>Год :</span>
        <select name="year">
          <?php
          for ($i = 2024; $i >= 1922; $i--) {
            printf('<option value="%d">%d </option>', $i, $i);
          }
          ?>
        </select>
        </div>
        
      </div>
      <div class="form-item">
        <p>Пол:</p>
        <ul>
          <li>
            <input type="radio" id="radioMale" name="pol" value="male" checked>
            <label for="radioMale">Муж</label>
          </li>
          <li>
            <input type="radio" id="radioFemale" name="pol" value="female">
            <label for="radioFemale">Жен</label>
          </li>
        </ul>
      </div>
      <div class="form-item">
        <p>Любимый язык программирования:</p>
        <ul>
          <li>
            <input type="checkbox" id="JS" name="languages[]" value=1>
            <label for="JS">JS</label>
          </li>
          <li>
            <input type="checkbox" id="Python" name="languages[]" value=2>
            <label for="Python">Python</label>
          </li>
          <li>
            <input type="checkbox" id="C++" name="languages[]" value=3>
            <label for="C++">C++</label>
          </li>
        </ul>
      </div>
      <div class="form-item">
        <p class="big-text">О себе:</p>
        <textarea name="biography" cols=24 rows=4 maxlength=128></textarea>
      </div>
    </div>
    <div class="send">
      <div class="contract">
        <input type="checkbox" id="checkboxContract" name="checkboxContract">
        <label for="checkboxContract">С контрактом ознакомлен(а)</label>
      </div>
      <input class="btn" type="submit" name="submit" value="Отправить" />
    </div>
  </form>
</body>

</html>