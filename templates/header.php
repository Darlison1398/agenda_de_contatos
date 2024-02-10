<?php


include_once("config/url.php");
include_once("config/process.php");

if (isset($_SESSION['msg'])) {
    $printMsg = $_SESSION['msg'];
    $_SESSION['msg'] = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de contatos</title>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Css -->
    <link rel="stylesheet" href="<?= $BASE_URL ?>/css/styles.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div>
                <a class="navbar-brand" href="<?= $BASE_URL ?>index.php">
                    <img src="<?= $BASE_URL ?>/img/logo.svg" alt="agenda">
                </a>
            </div>

            <div class="navbar-nav" style="margin-left: auto;">
                <a class="nav-link active" id="home-link" href="<?= $BASE_URL ?>index.php">Agenda</a>
                <a class="nav-link active" href="<?= $BASE_URL ?>create.php">Adicionar Contato</a>
            </div>
        </nav>
    </header>
</body>
</html>
