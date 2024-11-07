<?php
include_once("../model/vaga_empresa.php"); // Certifique-se de que o caminho está correto para o arquivo de modelo

class VagasController {
    private $vagaModel;

    public function __construct() {
        $this->vagaModel = new Vaga(); // Inicializa o modelo Vaga
    }

    // Método para mostrar uma vaga específica
    public function mostrarVaga($idVaga) {
        return $this->vagaModel->getVagaById($idVaga); // Obtém a vaga pelo ID
    }

    // Método para cancelar uma vaga
    public function cancelar($idVaga) {
        return $this->vagaModel->cancelarVaga($idVaga); // Cancela a vaga
    }

    // Método para ativar uma vaga
    public function ativar($idVaga) {
        return $this->vagaModel->ativarVaga($idVaga); // Ativa a vaga
    }
}

// Criação de uma instância da controller
$controller = new VagasController();

if (isset($_REQUEST["acao"])) {
    switch ($_REQUEST["acao"]) {
        case 'mostrar':
            // Exibe a vaga com base no ID passado
            if (isset($_GET['idVaga'])) {
                $vaga = $controller->mostrarVaga($_GET['idVaga']);
                echo json_encode($vaga);  // Retorna a vaga em formato JSON
            }
            break;

        case 'cancelar':
            // Cancela a vaga com base no ID
            if (isset($_POST['idVaga'])) {
                $controller->cancelar($_POST['idVaga']);
                echo "Vaga cancelada com sucesso!";
            }
            break;

        case 'ativar':
            // Ativa a vaga com base no ID
            if (isset($_POST['idVaga'])) {
                $controller->ativar($_POST['idVaga']);
                echo "Vaga ativada com sucesso!";
            }
            break;

        default:
            echo "Ação não reconhecida!";
    }
}
?>
