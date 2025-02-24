<?php 
    $dsn = 'mysql:host=localhost;dbname=tweety';
    $user = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Connection error! ' . $e->getMessage();
    }	
?>
