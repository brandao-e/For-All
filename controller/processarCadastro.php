<?php 
session_start();

// Incluindo o arquivo da classe Conexao
require_once '..\model\Conexao.php'; // Ajuste o caminho conforme necessário
// Estabelecendo a conexão
$conn = new Conexao();

//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pegando as variáveis da sessão
    $pNome = $_SESSION['pNome'];
    $uNome = $_SESSION['uNome'];
    $Email = $_SESSION['email'];
    $senha = $_SESSION['password'];
    $xp = $_SESSION['xp'];
    $bio = $_SESSION['biografia'];
    $servico = $_SESSION['slcPesquisarServico'];
    $subcategoria = $_SESSION['slcPesquisarSubCategoria'];
    $dataNas = $_SESSION['dataNas'];
    $foto = $_SESSION['foto'];
    $telefone = $_SESSION['telefone'];
    // Inserindo os dados no banco de dados
    $conn->inserirDadosFuncionario($pNome, $uNome, $Email, $senha, $xp,$bio, $servico,  $subcategoria, $telefone, $dataNas, $foto);

    // Redirecionar ou mostrar uma mensagem de sucesso
    //header("Location: sucesso.php");
    exit();
    //
//}
?>
