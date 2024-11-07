<?php 
session_start();
$idempresa = $_SESSION['idEmp'];
require 'conexao.php';
    $sql = "SELECT * FROM interessevags WHERE idEmpresa = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $idempresa);
    $stmt->execute();
    $interrese = $stmt->fetch(PDO::FETCH_ASSOC);  

    $idTraba =  $interrese['idTraba'];
    $idVaga = $interrese['idVagaIntrr'];

    $sql = "SELECT * FROM trabalhador WHERE idTrabalhador = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $idTraba);
    $stmt->execute();
    $interreseTrabalhador = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM vagas WHERE idVaga = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $idVaga);
    $stmt->execute();
    $interreseVaga = $stmt->fetch(PDO::FETCH_ASSOC);

    echo $interreseTrabalhador['primeiroNome'], $interreseVaga['tituloVaga'];



?>