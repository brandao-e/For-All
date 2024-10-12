<?php 
class Participante implements JsonSerializable {
    private $idParticipante;
    private $idChat;
    private $idUsuario;
    private $dataParticipacao;
    private $con;

    function jsonSerialize(): mixed {
        return [
            'idParticipante' => $this->idParticipante,
            'idChat' => $this->idChat,
            'idUsuario' => $this->idUsuario,
            'dataParticipacao' => $this->dataParticipacao
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
        $sql = "INSERT INTO participante (idChat, idUsuario, dataParticipacao) VALUES (?, ?, ?)";
        $valores = array($this->idChat, $this->idUsuario, $this->dataParticipacao);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Atualizar() {
        $sql = "UPDATE participante SET idChat = ?, idUsuario = ?, dataParticipacao = ? WHERE idParticipante = ?";
        $valores = array($this->idChat, $this->idUsuario, $this->dataParticipacao, $this->idParticipante);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Excluir() {
        $sql = "DELETE FROM participante WHERE idParticipante = ?";
        $valores = array($this->idParticipante);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Consultar() {
        $sql = "SELECT * FROM participante";
        $exec = $this->con->prepare($sql);
        $exec->execute();

        $dados = array();

        foreach($exec->fetchAll() as $valor) {
            $participante = new Participante();
            $participante->idParticipante = $valor['idParticipante'];
            $participante->idChat = $valor['idChat'];
            $participante->idUsuario = $valor['idUsuario'];
            $participante->dataParticipacao = $valor['dataParticipacao'];

            $dados[] = $participante;
        }

        return $dados;
    }

    function RetornaDados() {
        $sql = "SELECT * FROM participante WHERE idParticipante = ?";
        $valores = array($this->idParticipante);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
        $valor = $exec->fetch();

        $participante = new Participante();
        $participante->idParticipante = $valor['idParticipante'];
        $participante->idChat = $valor['idChat'];
        $participante->idUsuario = $valor['idUsuario'];
        $participante->dataParticipacao = $valor['dataParticipacao'];

        return $participante;
    }
}
?>