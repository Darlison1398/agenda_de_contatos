<?php
  # vamos nos conectar ao banco MySQL

  $host = "localhost";
  $db = "agenda";
  $user = "root";
  $pass = "Darlin13#5";

  try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

    // ativando modo erros caso haja. Esse recurso, para o software e exibe o erro que existe na conexão
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
  } catch (PDOException $e) {
    // erro na conexão
    $error = $e->getMessage();
    echo "Erro: $error";
  }
?>