<?php

include 'config.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $rawPassword = $_POST['password'];
    $hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("SELECT * FROM user_form WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $message[] = 'User already exists!';
        } else {
            $insertStmt = $conn->prepare("INSERT INTO user_form (username, email, geboortedatum, password) VALUES (:name, :email, :birthday, :password)");
            $insertStmt->bindParam(':name', $name);
            $insertStmt->bindParam(':email', $email);
            $insertStmt->bindParam(':birthday', $birthday);
            $insertStmt->bindParam(':password', $hashedPassword);
            $insertStmt->execute();

            header('location:inloggen.php');
        }
    } catch (PDOException $e) {
        die('Databasefout: ' . $e->getMessage());
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="signup.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    <div class="navbar">
        <a href="homepage.php"><img src="images/logo.png" alt="Mijn Logo" class="logo"></a>
        <ul>
            <li><a href="homepage.php">HOME</a></li>
            <li><a href="overons.php">OVER ONS</a></li>
            <li><a href="klantenservice.php">KLANTENSERVICE</a></li>
            <li><a href="inloggen.php">INLOGGEN</a></li>
        </ul>
    </div>


    <main>

        <form id="registreren_form" action="signup.php" class="form_class" method="POST">
            <?php
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '<div class="message" style="text-align: center; font-size:30px; color: red;"  onclick="this.remove();">' . $message . '</div>';
                }
            }
            ?>
            <div class="form_div">
                <label>Name:</label>
                <input class="field_class" name="name" type="text" placeholder="Naam" autofocus required>
                <label>email:</label>
                <input class="field_class" name="email" type="email" placeholder="Email" autofocus required>
                <label>geboortedatum:</label>
                <input class="field_class" id="dateInput" name="birthday" type="date" placeholder="Geboortedatum" autofocus required="required" min="1900-01-01" max="2005-09-27">
                <p id="pf">Je Moet minimaal 18 te zijn*</p>
                <script>
                    $("#dateInput").validate();
                </script>
                <label>Password:</label>
                <input id="pass" class="field_class" name="password" type="password" placeholder="Wachtwoord" min='8' required> <br>
                <button class="submit_class" type="submit" form="registreren_form" name="submit">registreren</button><br>
            </div>
        </form>
    </main>

    </div>
    <footer>
    <h4>Contactgegevens</h4>
    <p><strong>Phonix</strong></p>
    <p> <a href="https://www.google.com/maps/place/Marco+Polostraat+12,+1057+EL+Amsterdam/@52.3650846,4.8543552,17z/data=!3m1!4b1!4m5!3m4!1s0x47c5e20da6f45ff7:0x4cbc5f54fbfde04e!8m2!3d52.3650814!4d4.8569301?entry=ttu">Adres: Mercopolostraat 12, 1055 PW Amsterdam</a></p>
    <p> <a href="tel:+120-3309321"> Telefoon: 120-3309321</a></p>
    <p><a href="mailto:Phonix@info.com">Phonix@info.com</a> </p>
  </footer>

</body>

</html>