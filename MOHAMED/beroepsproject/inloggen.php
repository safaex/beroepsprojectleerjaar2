<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loginpagian</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <style>
    body {
      background-image: url(back.gif);
      background-size: 120%;
    }

    main {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 89vh;
      width: 100%;

    }

    .navbar {
      width: 85%;
      margin: auto;
      padding: 35px 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .logo {
      width: 130px;
      cursor: pointer;
    }

    .navbar ul li {
      list-style: none;
      display: inline-block;
      margin: 0 20px;
      position: relative;
    }

    .navbar ul li a {
      text-decoration: none;
      color: rgb(0, 0, 0);
      text-transform: uppercase;

    }

    .navbar ul li::after {
      content: '';
      height: 3px;
      width: 0;
      background: #009688;
      position: absolute;
      left: 0;
      bottom: -10px;
      transition: 0.5s;
    }

    .navbar ul li:hover:after {
      width: 100%;
    }

    a {
      text-decoration: none;
      font-size: 16px;
      justify-content: space-around;
      display: flex;
      color: rgb(36, 26, 61);
    }

    .form_class {
      width: 500px;
      padding: 40px;
      border-radius: 8px;
      font-family: 'system-ui';
      box-shadow: 5px 5px 10px rgb(0, 0, 0, 0.3);
    }

    .form_div {
      text-transform: uppercase;
    }

    .form_div>label {
      letter-spacing: 3px;
      font-size: 1rem;
    }

    .info_div {
      text-align: center;
      margin-top: 20px;
    }

    .info_div {
      letter-spacing: 1px;
    }

    .field_class {
      width: 100%;
      border-radius: 6px;
      border-style: solid;
      border-width: 1px;
      padding: 5px 0px;
      text-indent: 6px;
      margin-top: 10px;
      margin-bottom: 20px;
      font-family: 'system-ui';
      font-size: 0.9rem;
      letter-spacing: 2px;
    }

    .submit_class {
      border-style: none;
      border-radius: 5px;
      background-color: #FFE6D4;
      padding: 8px 20px;
      font-family: 'system-ui';
      text-transform: uppercase;
      letter-spacing: .8px;
      display: block;
      margin: auto;
      margin-top: 10px;
      box-shadow: 2px 2px 5px rgb(0, 0, 0, 0.2);
      cursor: pointer;
    }

    footer {
      display: flex;
      flex-direction: column;
      align-items: center;
      color: black;
    }
  </style>
</head>
<div class="navbar">
<a href="homepage.php"><img src="logo.png" alt="Mijn Logo" class="logo"></a>
  <ul>
    <li><a href="homepage.php">HOME</a></li>
    <li><a href="overons.php">OVER ONS</a></li>
    <li><a href="klantenservice.php">KLANTENSERVICE</a></li>
    <li><a href="inloggen.php">INLOGGEN</a></li>
  </ul>
</div>

<body>

  <?php

  require('database.php');

  if (isset($_POST['submit'])) {

    $email = $_POST["email"];
    $wachtwoord = $_POST["wachtwoord"];

    $stmt = $pdo->prepare("SELECT email, pwd FROM users WHERE pwd=:wachtwoord AND email = :email");

    $stmt->execute(["wachtwoord" => $wachtwoord, "email" => $email]);

    $user = $stmt->fetch();

    if (!$user) {

      echo "<h3 style='    .form_class {
      width: 500px;
      padding: 40px;
      border-radius: 8px;
      font-family: 'system-ui';
      box-shadow: 5px 5px 10px rgb(0, 0, 0, 0.3);
    }'>Ongeldige combinatie van gebruikersnaam en wachtwoord</h3>";
    } else {

      echo "<h3 style='    .form_class {
      width: 500px;
      padding: 40px;
      border-radius: 8px;
      font-family: 'system-ui';
      box-shadow: 5px 5px 10px rgb(0, 0, 0, 0.3);
      text-align: center;
    }
    '>je bent ingelogd </h3>";
    }
  }
  ?>
  <main>
    <form id="login_form" class="form_class" method="POST">
      <div class="form_div">
        <label>Email:</label>
        <input class="field_class" name="email" type="email" placeholder="Email" autofocus>
        <label>Password:</label>
        <input id="pass" class="field_class" name="wachtwoord" type="password" placeholder="Wachtwoord" min=8> <br>
        <button class="submit_class" type="submit" form="login_form" name="submit">Inloggen</button><br>
        <a href="signup.php">Geen account? klick hier om een te maken</a>
      </div>
    </form>
  </main>
  <footer>
    <h4>Contactgegevens</h4>
    <p><strong> Phonix</strong></p>
    <p>Adres: Mercopolostraat 12, 1055 PW Amsterdam</p>
    <p>Telefoon: 120-3309321</p>
    <p>Email: info@Phonix.com</p>

  </footer>
</body>

</html>