<?php
    session_start();
    include_once '../view/cadFuncionario-4.html';

    $servico = $_POST['slcPesquisarServico'];
    $subcategoria = $_POST['slcPesquisarSubCategoria'];
 
    $_SESSION['slcPesquisarServico'] = $servico;
    $_SESSION['slcPesquisarSubCategoria'] = $subcategoria;
   
    
?>