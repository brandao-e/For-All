<?php 
session_start();

include 'conexao.php';

$PnomeEmpresa = $_POST['pNome'];
$UnomeEmpresa = $_POST['uNome'];
$email = $_POST['email'];
$senha = $_POST['senha'];


$sql = "INSERT INTO empresa(primeiroNome, ultimoNome, email, senha) VALUES (:nome, :unome, :email, :senha)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':nome', $PnomeEmpresa);
$stmt->bindParam(':unome', $UnomeEmpresa);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha);
$stmt->execute();


?>