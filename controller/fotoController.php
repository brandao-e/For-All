<?php
session_start();

//include 'cad5_Final.php';

//include_once 'cad5_Final.php';

$telefone = $_POST['telefone'];
$dataNas = $_POST['dataNas'];
$arquivo = $_FILES['upload'];


 if($arquivo['error'])
 die("falha ao carregar");

 if($arquivo['size']>10485760)
 die("arquivo excedeu limite, maximo de 10MB");

 //echo"<pre>";
 //print_r($arquivo);
// echo"</pre>";

 $pasta = "../imagem";
 $nomeArq = $arquivo['name'];
 $nomeCodigo = uniqid();
 $extensao = strtolower(pathinfo($nomeArq, PATHINFO_EXTENSION));

 $path = $pasta.$nomeCodigo.".".$extensao;

 if($extensao != 'jpg' && $extensao !='png')
 die("arquivo invalido");

 $arquivoUpload = move_uploaded_file($arquivo["tmp_name"],$path);

 $_SESSION['dataNas'] = $dataNas;
 $_SESSION['telefone'] = $telefone;
 $_SESSION['foto'] = $path;

 header('Location: cad5_Final.php');
//var_dump($path, $telefone, $dataNas);
?>