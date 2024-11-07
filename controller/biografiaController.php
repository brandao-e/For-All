<?php 
    session_start();
   include_once '../view/cadFuncionario-3.html';
    /*$pNome = $_SESSION['pNome'];
    $uNome = $_SESSION['uNome'];
    $Email = $_SESSION['email'];
    $senha = $_SESSION['password'];
    $xp = $_SESSION['xp'];*/
    $bio = $_POST['biografia'];
    var_dump($bio);
    $_SESSION['biografia'] = $bio;

?>