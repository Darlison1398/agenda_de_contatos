<?php
 
  session_start();

  include_once("connection.php");
  include_once("url.php");

  $data = $_POST;

  if(!empty($data)){

    // modificação no banco
    

    # CRIANDO contato. Alógica é baseada no tipo que vem do formulário
    if($data["type"] === "create"){
      $name = $data["name"];
      $phone = $data["phone"];
      $observations = $data["observations"];

      $query = "INSERT INTO contacts (name, phone, observations) VALUES (:name, :phone, :observations)";

      $stmt = $conn->prepare($query);

      $stmt->bindParam(":name", $name);
      $stmt->bindParam(":phone", $phone);
      $stmt->bindParam(":observations", $observations);

      try {
        $stmt->execute();
        $_SESSION["msg"] = "Contato criado com sucesso!!!";
      } catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Erro: $error";
      }
    }

    ###  EDITAR CONTATO
  else if ($data["type"] === "edit"){
    $name = $data["name"];
    $phone = $data["phone"];
    $observations = $data["observations"];
    $id = $data["id"];

    $query = "UPDATE contacts SET name = :name, phone = :phone, observations = :observations WHERE id = :id";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":observations", $observations);
    $stmt->bindParam(":id", $id);

    try {
      $stmt->execute();
      $_SESSION["msg"] = "Contato atualizado com sucesso!!!";
    } catch (PDOException $e) {
      $error = $e->getMessage();
      echo "Erro: $error";
    }
    

    ## DELETANDO CONTATO
  } else if($data["type"] === "delete"){
    $id = $data["id"];

    $query = "DELETE FROM contacts WHERE id = :id";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(":id", $id);
    
    try {
      $stmt->execute();
      $_SESSION["msg"] = "Contato deletado com sucesso!!!";
    } catch (PDOException $e) {
      $error = $e->getMessage();
      echo "Erro: $error";
    }
  }

    // redirecionando para home
    header("Location:" . $BASE_URL . "../index.php");
    
  } else{
    // Seleção de dados 
  if(!empty($_GET)){
    $id = $_GET["id"];
  }

  //retorna o dado de um contato
  if(!empty($id)){
    $query = "SELECT * FROM contacts WHERE id = :id";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(":id", $id);

    $stmt-> execute();

    $contact = $stmt->fetch();
  }
  // retorna todos os contatos
  $contacts = [];

  $query = "SELECT * FROM contacts";

  $stmt = $conn->prepare($query);

  $stmt->execute();

  $contacts = $stmt->fetchAll(); // vai receber todos os dados da PDO



  }

  ## Fechando a conexão
  $conn = null; 

  // para fechar a conexão, poderiamos usar, também, o método close();



  # ESSE processo, deve ser inserido na header
?>