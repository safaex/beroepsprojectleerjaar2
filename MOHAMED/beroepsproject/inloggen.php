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
      background-size: cover;
    }

    main {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 89vh;
      width: 100%;

    }

    header {
      display: flex;
      align-items: center;
      justify-content: space-around;
      background-color: rgba(255, 255, 255, 0.4);
      height: 2cm;
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

<body>
  <header>
    <h1>Inloggen</h1>
    <a class="btn btn-primary" href="home.html" role="button">Home</a>
    <a class="btn btn-primary" href="inloggen.php" role="button">Inloggen</a>
  </header>
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