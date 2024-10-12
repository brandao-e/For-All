<?php 
class HistoricoTrabalhadore implements JsonSerializable {
    private $idContratacao;
    private $dataContratacao;
    private $idTrabalhador;
    private $idEmpresa;
    private $con;

    function jsonSerialize(): mixed {
        return [
            'id_contratacao' => $this->idContratacao,
            'data_contratacao' => $this->dataContratacao,
            'id_trabalhador' => $this->idTrabalhador,
            'id_empresa' => $this->idEmpresa
        ];
    }

    function __get($atributo) {
        return $this->$atributo;
    }

    function __set($atributo, $value) {
        $this->$atributo = $value;
    }

    function __construct() {
        include_once("Conexao.php");
        $classe_con = new Conexao();
        $this->con = $classe_con->Conectar();
    }

    function Cadastrar() {
        $sql = "INSERT INTO historico_trabalhadores (dataContratacao, idTrabalhador, idEmpresa) VALUES (?, ?, ?)";
        $valores = array($this->dataContratacao, $this->idTrabalhador, $this->idEmpresa);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Atualizar() {
        $sql = "UPDATE historico_trabalhadores SET dataContratacao = ?, idTrabalhador = ?, idEmpresa = ? WHERE idContratacao = ?";
        $valores = array($this->dataContratacao, $this->idTrabalhador, $this->idEmpresa, $this->idContratacao);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Excluir() {
        $sql = "DELETE FROM historico_trabalhadores WHERE idContratacao = ?";
        $valores = array($this->idContratacao);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Consultar() {
        $sql = "SELECT * FROM historico_trabalhadores";
        $exec = $this->con->prepare($sql);
        $exec->execute();

        $dados = array();

        foreach($exec->fetchAll() as $valor) {
            $historico = new HistoricoTrabalhadore();
            $historico->idContratacao = $valor['idContratacao'];
            $historico->dataContratacao = $valor['dataContratacao'];
            $historico->idTrabalhador = $valor['idTrabalhador'];
            $historico->idEmpresa = $valor['idEmpresa'];

            $dados[] = $historico;
        }

        return $dados;
    }

    function RetornaDados() {
        $sql = "SELECT * FROM historico_trabalhadores WHERE idContratacao = ?";
        $valores = array($this->idContratacao);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
        $valor = $exec->fetch();

        $historico = new HistoricoTrabalhadore();
        $historico->idContratacao = $valor['idContratacao'];
        $historico->dataContratacao = $valor['dataContratacao'];
        $historico->idTrabalhador = $valor['idTrabalhador'];
        $historico->idEmpresa = $valor['idEmpresa'];

        return $historico;
    }
}
?>