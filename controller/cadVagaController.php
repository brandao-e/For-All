<?php
include_once("../model/cadVaga.php");

$Vaga = new Vaga;
        
        case 'cadastrar':
            // Verifica se a requisição é de cadastro de vaga
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Coleta os dados do formulário
                $Vaga->servicoVaga   = $_POST['servicoVaga'];
                $Vaga->tituloVaga    = $_POST['tituloVaga'];
                $Vaga->salarioVaga   = $_POST['salarioVaga'];
                $Vaga->tipoContrato  = $_POST['tipoContrato'];
                $Vaga->cargaHoraria  = $_POST['cargaHoraria'];
                $Vaga->estadoEmpresa = $_POST['estadoEmpresa'];
                $Vaga->cidadeEmpresa = $_POST['cidadeEmpresa'];
                $Vaga->bairroEmpresa = $_POST['bairroEmpresa'];
                $Vaga->complemento   = $_POST['complemento'];
                $Vaga->descricao     = $_POST['descricao'];
                $Vaga->dataPublicacao= $_POST['dataPublicacao'];
                $Vaga->statusVaga    = 'ativo';  // Definido como "ativo" por padrão

                // Chama o método de cadastro da vaga
                $Vaga->cadastrar();

                // Retorna uma resposta para o cliente
                echo "Vaga cadastrada com sucesso!";
            }
            break;