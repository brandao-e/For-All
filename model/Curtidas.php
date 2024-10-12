<?php 
class Curtida implements JsonSerializable {
    private $idCurtida;
    private $idPublicacao;
    private $idUsuario;
    private $dataCurtida;
    private $horaCurtida;
    private $con;

    function jsonSerialize(): mixed {
        return [
            'idCurtida' => $this->idCurtida,
            'idPublicacao' => $this->idPublicacao,
            'idUsuario' => $this->idUsuario,
            'dataCurtida' => $this->dataCurtida,
            'horaCurtida' => $this->horaCurtida
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
        $sql = "INSERT INTO curtidas (idPublicacao, idUsuario, dataCurtida, horaCurtida) VALUES (?, ?, ?, ?)";
        $valores = array($this->idPublicacao, $this->idUsuario, $this->dataCurtida, $this->horaCurtida);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Atualizar() {
        $sql = "UPDATE curtidas SET idPublicacao = ?, idUsuario = ?, dataCurtida = ?, horaCurtida = ? WHERE idCurtida = ?";
        $valores = array($this->idPublicacao, $this->idUsuario, $this->dataCurtida, $this->horaCurtida, $this->idCurtida);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Excluir() {
        $sql = "DELETE FROM curtidas WHERE idCurtida = ?";
        $valores = array($this->idCurtida);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Consultar() {
        $sql = "SELECT * FROM curtidas";
        $exec = $this->con->prepare($sql);
        $exec->execute();

        $dados = array();

        foreach($exec->fetchAll() as $valor) {
            $curtida = new Curtida();
            $curtida->idCurtida = $valor['idCurtida'];
            $curtida->idPublicacao = $valor['idPublicacao'];
            $curtida->idUsuario = $valor['idUsuario'];
            $curtida->dataCurtida = $valor['dataCurtida'];
            $curtida->horaCurtida = $valor['horaCurtida'];

            $dados[] = $curtida;
        }

        return $dados;
    }

    function RetornaDados() {
        $sql = "SELECT * FROM curtidas WHERE idCurtida = ?";
        $valores = array($this->idCurtida);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
        $valor = $exec->fetch();

        $curtida = new Curtida();
        $curtida->idCurtida = $valor['idCurtida'];
        $curtida->idPublicacao = $valor['idPublicacao'];
        $curtida->idUsuario = $valor['idUsuario'];
        $curtida->dataCurtida = $valor['dataCurtida'];
        $curtida->horaCurtida = $valor['horaCurtida'];

        return $curtida;
    }
}
?>