<?php 
    session_start();
    require 'conexao.php';
    $idTrabalhador = $_SESSION['idTraba'];
    $idVaga = $_SESSION['idVaga'];
    $iDempresa = $_SESSION['idEmpresa'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idTrabalhador;
    $idVaga;
    $iDempresa;
    $sql = "INSERT INTO interessevags(idEmpresa, idTraba, idVagaIntrr) VALUES 
    (:idempresa, :idtraba, :idvaga) ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idempresa', $iDempresa);
    $stmt->bindParam(':idtraba', $idTrabalhador);
    $stmt->bindParam(':idvaga', $idVaga);
    $stmt->execute();
    $vaga = $stmt->fetch(PDO::FETCH_ASSOC);  
    exit();

}    



?>