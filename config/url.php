<?php
  /*
    Aqui, adicionamos as url que serão usadas durante o desenvolvimento do sistema
  */

  // Eu poderia deixar sem a barra adicionada no final. Porém, se eu não adicionar
  // ela ao final do $BASE_URL, eu devo faver isso de forma manual quando eu for usar essa url;
  
  $BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI'] . '?') . '/';


?>