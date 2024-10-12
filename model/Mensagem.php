<?php 
class Mensagem implements JsonSerializable {
    private $idMensagem;
    private $idChat;
    private $idUsuario;
    private $conteudo;
    private $data_envio;
    private $con;

    function jsonSerialize(): mixed {
        return [
            'idMensagem' => $this->idMensagem,
            'idChat' => $this->idChat,
            'idUsuario' => $this->idUsuario,
            'conteudo' => $this->conteudo,
            'data_envio' => $this->data_envio
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
        $sql = "INSERT INTO mensagem (idChat, idUsuario, conteudo, data_envio) VALUES (?, ?, ?, ?)";
        $valores = array($this->idChat, $this->idUsuario, $this->conteudo, $this->data_envio);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Atualizar() {
        $sql = "UPDATE mensagem SET idChat = ?, idUsuario = ?, conteudo = ?, data_envio = ? WHERE idMensagem = ?";
        $valores = array($this->idChat, $this->idUsuario, $this->conteudo, $this->data_envio, $this->idMensagem);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Excluir() {
        $sql = "DELETE FROM mensagem WHERE idMensagem = ?";
        $valores = array($this->idMensagem);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Consultar() {
        $sql = "SELECT * FROM mensagem";
        $exec = $this->con->prepare($sql);
        $exec->execute();

        $dados = array();

        foreach($exec->fetchAll() as $valor) {
            $mensagem = new Mensagem();
            $mensagem->idMensagem = $valor['idMensagem'];
            $mensagem->idChat = $valor['idChat'];
            $mensagem->idUsuario = $valor['idUsuario'];
            $mensagem->conteudo = $valor['conteudo'];
            $mensagem->data_envio = $valor['data_envio'];

            $dados[] = $mensagem;
        }

        return $dados;
    }

    function RetornaDados() {
        $sql = "SELECT * FROM mensagem WHERE idMensagem = ?";
        $valores = array($this->idMensagem);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
        $valor = $exec->fetch();

        $mensagem = new Mensagem();
        $mensagem->idMensagem = $valor['idMensagem'];
        $mensagem->idChat = $valor['idChat'];
        $mensagem->idUsuario = $valor['idUsuario'];
        $mensagem->conteudo = $valor['conteudo'];
        $mensagem->data_envio = $valor['data_envio'];

        return $mensagem;
    }
}
?>