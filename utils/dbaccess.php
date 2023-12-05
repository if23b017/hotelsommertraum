<?php

$host = 'localhost';
$dbname = 'hotel_db';
$username = 'your_username';
$password = 'your_password';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$bif1webtechdb", $username, $password);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Use the $pdo object to perform database operations
    // For example, you can execute queries like this:
    // $stmt = $pdo->query("SELECT * FROM your_table");
    // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //     // Process each row
    // }

    // Remember to close the database connection when you're done
    $pdo = null;
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Connection failed: " . $e->getMessage();
}

?>

