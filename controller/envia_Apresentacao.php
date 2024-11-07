<?php
session_start();
//$id = $_SESSION['idTrabalhador'];
include 'conexao.php';

$target_dir = "../video/";  // Diretório onde as imagens serão salvas

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'post') {
    $arquivo = $_FILES['apresentacao'];

        if($arquivo['error'])
        die("falha ao carregar");

        if($arquivo['size']>10485760)
        die("arquivo excedeu limite, maximo de 10MB");


       $id = 65;
        $nomeArq = $arquivo['name'];
        $nomeCodigo = uniqid();
        $extensao = strtolower(pathinfo($nomeArq, PATHINFO_EXTENSION));

        $path = $target_dir.$nomeCodigo.".".$extensao;

        $sql = "INSERT INTO trabalhador(videoApresentacao) VALUES (:video) WHERE idTrabalhador = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':video', $path);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

}
?>