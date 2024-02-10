<?php
 
  session_start();

  include_once("connection.php");
  include_once("url.php");

  $data = $_POST;

  if(!empty($data)){

    // modificação no banco
        // Upload da imagem
        if (isset($_FILES["caminho_imagem"])) {
          $uploadDirectory = "../img/foto/";
          $uploadedFile = $uploadDirectory . basename($_FILES["caminho_imagem"]["name"]);
          $uploadOk = 1;
          
          // Verificar se o arquivo já existe
          if (file_exists($uploadedFile)) {
              $_SESSION["msg"] = "Erro: A imagem já existe.";
              $uploadOk = 0;
          }
  
          // Verificar o tamanho máximo permitido (5MB neste exemplo)
          if ($_FILES["caminho_imagem"]["size"] > 5000000) {
              $_SESSION["msg"] = "Erro: A imagem é muito grande.";
              $uploadOk = 0;
          }
  
          // Verificar o tipo de arquivo (você pode adicionar mais tipos conforme necessário)
          $allowedTypes = ["jpg", "jpeg", "png", "gif"];
          $fileExtension = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));
          if (!in_array($fileExtension, $allowedTypes)) {
              $_SESSION["msg"] = "Erro: Somente arquivos JPG, JPEG, PNG e GIF são permitidos.";
              $uploadOk = 0;
          }
  
          // Verificar se $uploadOk é 0 devido a um erro
          if ($uploadOk == 0) {
              $_SESSION["msg"] = "Erro: A imagem não foi enviada.";
          } else {
              // Se tudo estiver correto, tentar fazer o upload
              if (move_uploaded_file($_FILES["caminho_imagem"]["tmp_name"], $uploadedFile)) {
                  $_SESSION["msg"] = "Imagem enviada com sucesso.";
                  $caminho_imagem = $uploadedFile;
              } else {
                  $_SESSION["msg"] = "Erro ao fazer o upload da imagem.";
              }
          }
      }

    # CRIANDO contato. Alógica é baseada no tipo que vem do formulário
    if($data["type"] === "create"){
      $name = $data["name"];
      $phone = $data["phone"];
      $observations = $data["observations"];
      //$caminho_imagem = $data["caminho_imagem"];

      $query = "INSERT INTO contacts (name, phone, observations, caminho_imagem) VALUES (:name, :phone, :observations, :caminho_imagem)";

      $stmt = $conn->prepare($query);

      $stmt->bindParam(":name", $name);
      $stmt->bindParam(":phone", $phone);
      $stmt->bindParam(":observations", $observations);
      $stmt->bindParam(":caminho_imagem", $caminho_imagem);

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

    // Antes de preparar a consulta, certifique-se de que o caminho da imagem está definido corretamente
    if (isset($_FILES['caminho_imagem']) && $_FILES['caminho_imagem']['error'] == UPLOAD_ERR_OK) {
      $uploadDirectory = "../img/foto/";
      $uploadedFile = $uploadDirectory . basename($_FILES["caminho_imagem"]["name"]);
      
      if (move_uploaded_file($_FILES["caminho_imagem"]["tmp_name"], $uploadedFile)) {
          $_SESSION["msg"] = "Imagem enviada com sucesso.";
          $caminho_imagem = basename($_FILES["caminho_imagem"]["name"]); 
      } else {
          $_SESSION["msg"] = "Erro ao fazer o upload da imagem.";
      }
    }
    
    $query = "UPDATE contacts SET name = :name, phone = :phone, observations = :observations";
    
    if (isset($caminho_imagem)) {
      $query .= ", caminho_imagem = :caminho_imagem";
    }
    
    //$query .= " WHERE id = :id";

    $query .= " WHERE id = :id";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":observations", $observations);
    
    if (isset($caminho_imagem)) {
      $stmt->bindParam(":caminho_imagem", $caminho_imagem);
    }
    
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

