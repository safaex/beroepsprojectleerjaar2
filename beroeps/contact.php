<?php


require 'data.php';

if(isset($_POST["submit"])) {
  $naam= $_POST['naam'];
  $achternaam= $_POST['achternaam'];
  $email= $_POST['email'];
  $artikelnummer= $_POST['artikelnummer'];
  $probleem= $_POST['probleem'];
  $afspraak= $_POST['afspraak'];


 $data = [
    'naam' => $naam,
    'achternaam' => $achternaam,
    'email' => $email,
    'artikelnummer' => $artikelnummer,
    'probleem' => $probleem,
    'afspraak' => $afspraak,
  
  ];

  $sql = "INSERT INTO artikel (naam, achternaam, email, artikelnummer, probleem, afspraak
  ) VALUES (:naam, :achternaam, :email, :artikelnummer, :probleem, :afspraak)";
  $stmt=$pdo->prepare($sql);
  $stmt->execute($data);

}

  ?>



<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="stylecontact.css">
</head>
<body>

    
    
<div class="banner">
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

      <form >
        <h2 style = "text-align:center;">Contact formulier</h2>
        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" required>
      
        <label for="achternaams">achternaam:</label>
        <input type="text" id="achternaam" name="achternaam" required>

        <label for="email">email:</label>
        <input type="email" id="email" name="email" required>

        <label for="artikel">artikel:</label>
        <input type="text" id="artikel" name="artikel" required>
      
      
        <label for="probleem">leg u probleem uit:</label>
        <input type="text" id="probleem" name="probleem" required>
      
        <label for="afspraak">maak een afspraak:</label>
        <input type="date" id="afspraak" name="afspraak" required>
      
        <input type="submit" name ="submit" value="versturen">
      </form>

    
</body>
</html>