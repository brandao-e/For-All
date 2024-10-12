<?php 
class Comentario implements JsonSerializable {
    private $idComentario;
    private $idPublicacao;
    private $idUsuario;
    private $dataComentario;
    private $horaComentario;
    private $con;

    function jsonSerialize(): mixed {
        return [
            'idComentario' => $this->idComentario,
            'idPublicacao' => $this->idPublicacao,
            'idUsuario' => $this->idUsuario,
            'dataComentario' => $this->dataComentario,
            'horaComentario' => $this->horaComentario
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
        $sql = "INSERT INTO comentarios (idPublicacao, idUsuario, dataComentario, horaComentario) VALUES (?, ?, ?, ?)";
        $valores = array($this->idPublicacao, $this->idUsuario, $this->dataComentario, $this->horaComentario);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Atualizar() {
        $sql = "UPDATE comentarios SET idPublicacao = ?, idUsuario = ?, dataComentario = ?, horaComentario = ? WHERE idComentario = ?";
        $valores = array($this->idPublicacao, $this->idUsuario, $this->dataComentario, $this->horaComentario, $this->idComentario);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Excluir() {
        $sql = "DELETE FROM comentarios WHERE idComentario = ?";
        $valores = array($this->idComentario);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Consultar() {
        $sql = "SELECT * FROM comentarios";
        $exec = $this->con->prepare($sql);
        $exec->execute();

        $dados = array();

        foreach($exec->fetchAll() as $valor) {
            $comentario = new Comentario();
            $comentario->idComentario = $valor['idComentario'];
            $comentario->idPublicacao = $valor['idPublicacao'];
            $comentario->idUsuario = $valor['idUsuario'];
            $comentario->dataComentario = $valor['dataComentario'];
            $comentario->horaComentario = $valor['horaComentario'];

            $dados[] = $comentario;
        }

        return $dados;
    }

    function RetornaDados() {
        $sql = "SELECT * FROM comentarios WHERE idComentario = ?";
        $valores = array($this->idComentario);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
        $valor = $exec->fetch();

        $comentario = new Comentario();
        $comentario->idComentario = $valor['idComentario'];
        $comentario->idPublicacao = $valor['idPublicacao'];
        $comentario->idUsuario = $valor['idUsuario'];
        $comentario->dataComentario = $valor['dataComentario'];
        $comentario->horaComentario = $valor['horaComentario'];

        return $comentario;
    }
}
?>