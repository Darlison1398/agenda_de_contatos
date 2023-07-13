<?php 
  # header do sistema
  include_once("templates/header.php");

?>
  <div class="cantainer">
    <?php include_once("templates/backbtn.html") ?>
    <h1 id="main-title">Criar contato</h1>
    <form id="create-form" action="<?= $BASE_URL ?>config/process.php" method="POST">
      <input type="hidden" name="type" value="create">
      <div class="form-group">
        <label for="name">Nome do contato:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome" required>
      </div>
      <div class="form-group">
        <label for="phone">Telefone do contato:</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o Telefone" required>
      </div>
      <div class="form-group">
        <label for="observations">Observações:</label>

        <textarea type="text" class="form-control" id="observations" name="observations" 
        placeholder="Insira as observações" rows="3"></textarea>

      </div>
      <button id="btn-submit" type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
  </div>
  <!-- a tag "name" em cada parte do formulário, é a forma que a gente se guia no back-end. Serve para 
     nos ajudar a se guiar pelo pelo banco de dados quando formos inserir dados na tabela -->

<?php
  # Footer do sistema
  include_once("templates/footer.php");

?>
