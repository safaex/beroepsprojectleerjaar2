<?php

require('database.php');
if (isset($_POST['submit'])) {

    $naam = $_POST["naam"];
    $email = $_POST["email"];
    $brthd = $_POST["birthday"];
    $wachtwoord = $_POST["wachtwoord"];

    $sql = "INSERT INTO users (id, username, email, gd, pwd) VALUES (null,:username, :email, :gd, :pwd)";


    $stmt = $pdo->prepare($sql);
    $data = [
        'username' => $naam,
        'email' => $email,
        'gd' => $brthd,
        'pwd' => $wachtwoord
    ];
    
    $stmt->execute($data);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loginpagian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
     <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Inloggen</h1>
        <a class="btn btn-primary" href="home.html" role="button">Home</a>
        <a class="btn btn-primary" href="loginpagina.php" role="button">Inloggen</a>
    </header>
    <main>
        <form id="registreren_form" action="signup.php" class="form_class" method="POST">
            <div class="form_div">
                <label>Name:</label>
                <input class="field_class" name="naam" type="text" placeholder="Naam" autofocus required>
                <label>email:</label>
                <input class="field_class" name="email" type="email" placeholder="Email" autofocus required>
                <label>geboortedatum:</label>
                <input class="field_class" id="dateInput" name="birthday" type="date" placeholder="Geboortedatum" autofocus required="required" min="1900-01-01" max="2005-09-27">
                <p id="pf">Je Moet minimaal 18 te zijn*</p>
                <script>
                    $("#dateInput").validate();
                </script>
                <label>Password:</label>
                <input id="pass" class="field_class" name="wachtwoord" type="password" placeholder="Wachtwoord" min=8 required> <br>
                <button class="submit_class" type="submit" form="registreren_form" name="submit">registreren</button><br>
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