<?php
    $host = "localhost"; //localhost ou IP do banco
    $dbname = "empresa"; // nome do banco
    $username = "root"; // usuario
    $password = ""; // senha

    //Conexao com o Mysql
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexão com o banco realizada com sucesso!";
    } catch (PDOException $e){
        echo "Erro ao conectar ao banco de dados;". $e->getMessage();
        die();
    }

?>