<?php
include_once("../model/usuario.php");
$Usuario = new Usuario();

if (isset($_REQUEST["acao"])) {

    switch ($_REQUEST["acao"]) {

        case 'cadastrar':
            $Usuario->nome   = $_POST['nome'];
            $Usuario->email  = $_POST['email'];
            $Usuario->senha  = $_POST['senha'];
            $Usuario->salt   = $_POST['salt']; // Adicione lógica para gerar salt, se necessário
            $Usuario->tipo   = $_POST['tipo'];
            $Usuario->Cadastrar();
            echo "ok";
            break;

        case 'atualizar':
            $Usuario->id     = $_POST['id'];
            $Usuario->nome   = $_POST['nome'];
            $Usuario->email  = $_POST['email'];
            $Usuario->senha  = $_POST['senha'];
            $Usuario->salt   = $_POST['salt'];
            $Usuario->tipo   = $_POST['tipo'];
            $Usuario->Atualizar();
            echo "ok";
            break;

        case 'excluir':
            $Usuario->id = $_POST['id'];
            $Usuario->Excluir();
            echo "ok";
            break;

        case 'consultar_json':
            echo json_encode($Usuario->Consultar());
            break;

        case 'retorna_cod':
            $Usuario->id = $_POST['id'];
            echo json_encode($Usuario->RetornaDados());
            break;

        case 'login':
            session_start();
            $Usuario->email = $_POST['email--input'];
            $Usuario->senha = $_POST['password--input'];
            $resultado = $Usuario->Login();
        
            if ($resultado) {
                $_SESSION['usuario_id'] = $resultado->id;
                $_SESSION['usuario_nome'] = $resultado->nome;
                $_SESSION['usuario_email'] = $resultado->email;
                $_SESSION['tipo_usuario'] = $resultado->tipo;
                $_SESSION['idEmpresa'] = $resultado->idEmpresa;
                $_SESSION['idTrabalhador'] = $resultado->idTrabalhador;

                // header("Location: ../view/perfil_empresa.php");

                if ($_SESSION['tipo_usuario'] == 1) {
                    header("Location: ../view/perfil_empresa.php");
                } else {
                    header("Location: ../view/perfil_trabalhador.html");
                }
            } else {
                $displayError = "block";
                header("Location: login.php?erro=$displayError");
                exit();
            }
        break;            
    }
}
?>