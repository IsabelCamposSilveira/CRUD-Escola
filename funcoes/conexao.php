<!-- Pág para criar a conexão com o banco de dados-->

<?php 
    $server = "localhost";
    $user = "root";
    $pass = "";
    $bd = "escola";

    try {
        $conn = new PDO("mysql:host=$server;dbname=$bd", $user, $pass);
        // Configurar o modo de erro do PDO para exceções
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
    }
?>