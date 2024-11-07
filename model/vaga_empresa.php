<?php
class Vaga implements JsonSerializable {

    private $idVaga;
    private $tituloVaga;
    private $salarioVaga;
    private $statusVaga;
    private $tipoContrato;
    private $cargaHoraria;
    private $bairroEmpresa;
    private $complemento;
    private $descricao;
    private $dataPublicacao;
    private $conn;

    // Implementação do método jsonSerialize
    public function jsonSerialize() {
        return [
            'idVaga' => $this->idVaga,
            'tituloVaga' => $this->tituloVaga,
            'salarioVaga' => $this->salarioVaga,
            'statusVaga' => $this->statusVaga,
            'tipoContrato' => $this->tipoContrato,
            'cargaHoraria' => $this->cargaHoraria,
            'bairroEmpresa' => $this->bairroEmpresa,
            'complemento' => $this->complemento,
            'descricao' => $this->descricao,
            'dataPublicacao' => $this->dataPublicacao
        ];
    }

    // Métodos mágicos para obter e definir atributos
    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $value) {
        $this->$atributo = $value;
    }

    // Construtor que inicializa a conexão com o banco de dados
    public function __construct() {
        include_once("ConexaoVagas.php");
        $classe_con = new Conexao();
        $this->conn = $classe_con->getPDO();
    }

    // Método para obter todas as vagas
    public function getVagas() {
        $query = $this->conn->prepare("SELECT * FROM vagas");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obter uma vaga específica pelo ID
    public function getVagaById($idVaga) {
        $query = $this->conn->prepare("
            SELECT v.*, s.servico 
            FROM vagas v 
            JOIN servico s ON v.servicoVaga = s.idServico 
            WHERE v.idVaga = :id
        ");
        $query->bindParam(':id', $idVaga);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Método para cancelar uma vaga
    public function cancelarVaga($idVaga) {
        $query = $this->conn->prepare("UPDATE vagas SET statusVaga = 'Cancelada' WHERE idVaga = :id");
        $query->bindParam(':id', $idVaga);
        return $query->execute();
    }

    // Método para ativar uma vaga
    public function ativarVaga($idVaga) {
        $query = $this->conn->prepare("UPDATE vagas SET statusVaga = 'Ativa' WHERE idVaga = :id");
        $query->bindParam(':id', $idVaga);
        return $query->execute();
    }
}
?>
