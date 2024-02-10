<!--  PÁGINA DE VISUALIZAÇÃO INDIVIDUAL DE CADA CONTATO  -->

<?php
  include_once("templates/header.php");
?>
  <div class="container" id="view-contact-container">
    <?php include_once("templates/backbtn.html") ?><br>
        
    <div class="card" style="width:400px">
      <!-- Exibição da imagem -->
      <?php if (!empty($contact["caminho_imagem"])) : ?>
        <?php
            $imageURL = $BASE_URL . "/img/foto/" . basename($contact["caminho_imagem"]);
        ?>
        <img src="<?= $imageURL ?>" alt="<?= $contact["name"] ?> - Imagem do Contato">
      <?php endif; ?>

      <div class="card-body">

        <h4 class="card-title"> <?= $contact["name"] ?> </h4>
        <p class= "bold">Telefone:</p>
        <p> <?= $contact["phone"] ?> </p>
        <p class= "bold">Observação:</p>
        <p> <?= $contact["observations"] ?> </p> 

        <a href="#" class="btn btn-primary">See Profile</a>
      </div>

    </div>








  </div>

<?php
  include_once("templates/footer.php");
?>