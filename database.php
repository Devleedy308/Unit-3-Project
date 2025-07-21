<?php
$dsn = 'mysql:host=localhost;dbname=unit3_restaurant';
$username = 'root';
$password = 'sesame';   // Update if your password is different :)

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "<p>Database Error: $error_message</p>";
    exit();
}
?>
