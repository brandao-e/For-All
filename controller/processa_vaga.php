<?php
session_start();

$idEmpresa = $_SESSION['idEmp'];
include '../controller/conexao.php';


$titulo = $_POST['tituloVaga'];
$salario = $_POST['salarioVaga'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$descricao = $_POST['descricao'];
$bairro = $_POST['bairroEmpresa'];
$complemento = $_POST['complemento'];
$tipoContrato = $_POST['tipoContrato'];
$servicoVaga = $_POST['servicoVaga'];
$Horaria = $_POST['cargaHoraria'];
$Data = $_POST['dataPublicacao'];


$sql = "INSERT INTO vagas(titulovaga, salarioVaga, tipoContrato, cargaHoraria, estadoEmpresa, cidadeEmpresa, bairroEmpresa, complemento, 
descricao, dataPublicacao, idEmpresa)
 VALUES (:titulo, :salario, :tipoContrato, :cHoraria, :esEmpresa, :cEmpresa, :baEmpresa, :complemento, :descricao, :dPublicacao, 
 :idEmpresa)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':titulo',$titulo);
$stmt->bindParam(':salario',$salario);
$stmt->bindParam(':tipoContrato',$tipoContrato);
$stmt->bindParam(':cHoraria',$Horaria);
$stmt->bindParam(':esEmpresa',$estado);
$stmt->bindParam(':cEmpresa',$cidade);
$stmt->bindParam(':baEmpresa',$bairro);
$stmt->bindParam(':complemento',$complemento);
$stmt->bindParam(':descricao',$descricao );
$stmt->bindParam(':dPublicacao',$Data);
$stmt->bindParam(':idEmpresa',$idEmpresa);
$stmt->execute();


?>