<?php

require('database.php');

$message = "";

if (isset($_POST['submit'])) {
  $email = $_POST["email"];
  $wachtwoord = $_POST["wachtwoord"];

  $stmt = $pdo->prepare("SELECT email, pwd FROM users WHERE pwd=:wachtwoord AND email = :email");
  $stmt->execute(["wachtwoord" => $wachtwoord, "email" => $email]);
  $user = $stmt->fetch();

  if (!$user) {
    $message = "Email or password is incorrect!";
  } else {
    $message = "You are logged in!";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loginpagina</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="inloggen.css">
</head>

<body>

  <div class="navbar">
    <a href="/beroepsprojectleerjaar2/SAFAE/homepage.php/"><img src="logo.png" alt="Mijn Logo" class="logo"></a>
    <ul>
      <li><a href="/beroepsprojectleerjaar2/SAFAE/homepage.php">HOME</a></li>
      <li><a href="overons.php">OVER ONS</a></li>
      <li><a href="klantenservice.php">KLANTENSERVICE</a></li>
      <li><a href="inloggen.php">INLOGGEN</a></li>
    </ul>
  </div>

  <?php if (!empty($message)) : ?>
  <h3 style="text-align: center; font-size:30px;">
    <?php echo $message; ?>
  </h3>
<?php endif; ?>
  <main>
    <form id="login_form" class="form_class" method="POST">
      <div class="form_div">
        <label>Email:</label>
        <input class="field_class" name="email" type="email" placeholder="Email" autofocus>
        <label>Password:</label>
        <input id="pass" class="field_class" name="wachtwoord" type="password" placeholder="Wachtwoord" min="8"> <br>
        <button class="submit_class" type="submit" form="login_form" name="submit">Inloggen</button><br>
        <a href="signup.php">Geen account? Klik hier om een te maken</a>
      </div>
    </form>
  </main>

  <footer>
    <h4>Contactgegevens</h4>
    <p><strong>Phonix</strong></p>
    <p>Adres: Mercopolostraat 12, 1055 PW Amsterdam</p>
    <p>  <a href="tel:+120-3309321"> Telefoon: 120-3309321</a></p>
    <p><a href="mailto:Phonix@info.com">Phonix@info.com</a> </p>
  </footer>
</body>

</html>