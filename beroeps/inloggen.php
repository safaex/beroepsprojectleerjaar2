<?php

include 'config.php';
session_start();

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  try {
    $stmt = $conn->prepare("SELECT * FROM user_form WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $hashedPassword = $row['password'];

      if (password_verify($password, $hashedPassword)) {
        $_SESSION['user_id'] = $row['id'];
        header('location:index.php');
      } else {
        $message[] = 'Incorrect password!';
      }
    } else {
      $message[] = 'Email address not found!';
    }
  } catch (PDOException $e) {
    die('Database error: ' . $e->getMessage());
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
  <link rel="stylesheet" href="style.css">
</head>

<body>

        <div class="navbar">
        <a href="home.php"><img src="images/logo.png" alt="Mijn Logo" class="logo"></a>


        <ul>
            <li><a href="home.php">HOME</a></li>
            <li><a href="overons.php">OVER ONS</a></li>
            <li><a href="klantservice.php">KLANTENSERVICE</a></li>
            <li><a href="onzeservice.php">ONZE SERVICE</a></li>
            <li><a href="inloggen.php">INLOGGEN</a></li>
        </ul>
    </div>

  <main>
    <form id="login_form" class="form_class" method="POST">
      <?php
      if (isset($message)) {
        foreach ($message as $message) {
          echo '<div class="message" style="text-align: center; font-size:30px; color: red;"  onclick="this.remove();">' . $message . '</div>';
        }
      }
      ?>

      <div class="form_div">
        <label>Email:</label>
        <input class="field_class" name="email" type="email" placeholder="Email" autofocus>
        <label>Password:</label>
        <input id="pass" class="field_class" name="password" type="password" placeholder="Wachtwoord" min="8"> <br>
        <button class="submit_class" type="submit" form="login_form" name="submit">Inloggen</button><br>
        <a href="signup.php">Geen account? Klik hier om een te maken</a>
      </div>
    </form>
  </main>

  <footer>
    <h4>Contactgegevens</h4>
    <p><strong>Phonix</strong></p>
    <p> <a href="https://www.google.com/maps/place/Marco+Polostraat+12,+1057+EL+Amsterdam/@52.3650846,4.8543552,17z/data=!3m1!4b1!4m5!3m4!1s0x47c5e20da6f45ff7:0x4cbc5f54fbfde04e!8m2!3d52.3650814!4d4.8569301?entry=ttu">Adres: Mercopolostraat 12, 1055 PW Amsterdam</a></p>
    <p> <a href="tel:+120-3309321"> Telefoon: 120-3309321</a></p>
    <p><a href="mailto:Phonix@info.com">Phonix@info.com</a> </p>
  </footer>
</body>

</html>