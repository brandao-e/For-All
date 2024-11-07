<?php 
    session_start();
   //header('Location:../view/cadFuncionario-2.html');
        include '../view/cadFuncionario-2.html';
   $pNome = $_POST['pNome'];
   $uNome = $_POST['uNome'];
   $Email = $_POST['email'];
   $senha = $_POST['password'];
   $xp = $_POST['xp'];

    $_SESSION['pNome'] = $pNome ; 
    $_SESSION['uNome'] = $uNome ;
    $_SESSION['email'] = $Email ;
    $_SESSION['password'] = $senha ;
    $_SESSION['xp'] = $xp ;
    
   // var_dump("$pNome, $uNome, $Email, $senha, $xp");
?>