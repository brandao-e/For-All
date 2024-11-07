<?php 
    // Arquivo: db_connection.php
    
    $host = 'localhost';  // Defina seu host
    $db   = 'bdforall';   // Nome do banco de dados
    $user = 'root';       // Usuário do banco de dados
    $pass = '';           // Senha do banco de dados
    
    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    
    



?>