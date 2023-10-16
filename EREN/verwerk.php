<?php
$host = 'localhost:3307'; 
$database = 'registratie'; 
$username = 'root';
$password = '';

try {

    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Verbinding met de database is tot stand gebracht!";
} catch (PDOException $e) {
    die("Fout bij het verbinden met de database: " . $e->getMessage());
}

if  ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST["naam"];
    $email = $_POST["email"];
    $wachtwoord = $_POST["wachtwoord"];
}

    try {

        $stmt = $pdo->prepare("INSERT INTO inlog (naam, email, wachtwoord) VALUES (?, ?, ?)");
        $stmt->execute([$naam, $email, $wachtwoord]);

        echo "Klant is toegevoegd aan de database.";
    } catch (PDOException $e) {
        die("Fout bij toevoegen van klant: " . $e->getMessage());
    }

function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
