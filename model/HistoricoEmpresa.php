<?php 
class HistoricoEmpresa implements JsonSerializable {
    private $idContratacao;
    private $dataContratacao;
    private $idEmpresa;
    private $idTrabalhador;
    private $con;

    function jsonSerialize(): mixed {
        return [
            'id_contratacao' => $this->idContratacao,
            'data_contratacao' => $this->dataContratacao,
            'id_empresa' => $this->idEmpresa,
            'id_trabalhador' => $this->idTrabalhador
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
        $sql = "INSERT INTO historico_empresas (dataContratacao, idEmpresa, idTrabalhador) VALUES (?, ?, ?)";
        $valores = array($this->dataContratacao, $this->idEmpresa, $this->idTrabalhador);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Atualizar() {
        $sql = "UPDATE historico_empresas SET dataContratacao = ?, idEmpresa = ?, idTrabalhador = ? WHERE idContratacao = ?";
        $valores = array($this->dataContratacao, $this->idEmpresa, $this->idTrabalhador, $this->idContratacao);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Excluir() {
        $sql = "DELETE FROM historico_empresas WHERE idContratacao = ?";
        $valores = array($this->idContratacao);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Consultar() {
        $sql = "SELECT * FROM historico_empresas";
        $exec = $this->con->prepare($sql);
        $exec->execute();

        $dados = array();

        foreach($exec->fetchAll() as $valor) {
            $historico = new HistoricoEmpresa();
            $historico->idContratacao = $valor['idContratacao'];
            $historico->dataContratacao = $valor['dataContratacao'];
            $historico->idEmpresa = $valor['idEmpresa'];
            $historico->idTrabalhador = $valor['idTrabalhador'];

            $dados[] = $historico;
        }

        return $dados;
    }

    function RetornaDados() {
        $sql = "SELECT * FROM historico_empresas WHERE idContratacao = ?";
        $valores = array($this->idContratacao);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
        $valor = $exec->fetch();

        $historico = new HistoricoEmpresa();
        $historico->idContratacao = $valor['idContratacao'];
        $historico->dataContratacao = $valor['dataContratacao'];
        $historico->idEmpresa = $valor['idEmpresa'];
        $historico->idTrabalhador = $valor['idTrabalhador'];

        return $historico;
    }
}
?>