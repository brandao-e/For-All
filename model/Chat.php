<?php 
class Chat implements JsonSerializable {
    private $idChat;
    private $tipoChat; // Pode ser 'Individual' ou 'Grupo'
    private $nome;
    private $dataCriacao;
    private $con;

    function jsonSerialize(): mixed {
        return [
            'id_chat' => $this->idChat,
            'tipo_chat' => $this->tipoChat,
            'nome' => $this->nome,
            'data_criacao' => $this->dataCriacao
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
        $sql = "INSERT INTO chat (tipoChat, nome, dataCriacao) VALUES (?, ?, ?)";
        $valores = array($this->tipoChat, $this->nome, $this->dataCriacao);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Atualizar() {
        $sql = "UPDATE chat SET tipoChat = ?, nome = ?, dataCriacao = ? WHERE idChat = ?";
        $valores = array($this->tipoChat, $this->nome, $this->dataCriacao, $this->idChat);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Excluir() {
        $sql = "DELETE FROM chat WHERE idChat = ?";
        $valores = array($this->idChat);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Consultar() {
        $sql = "SELECT * FROM chat";
        $exec = $this->con->prepare($sql);
        $exec->execute();

        $dados = array();

        foreach($exec->fetchAll() as $valor) {
            $chat = new Chat();
            $chat->idChat = $valor['idChat'];
            $chat->tipoChat = $valor['tipoChat'];
            $chat->nome = $valor['nome'];
            $chat->dataCriacao = $valor['dataCriacao'];

            $dados[] = $chat;
        }

        return $dados;
    }

    function RetornaDados() {
        $sql = "SELECT * FROM chat WHERE idChat = ?";
        $valores = array($this->idChat);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
        $valor = $exec->fetch();

        $chat = new Chat();
        $chat->idChat = $valor['idChat'];
        $chat->tipoChat = $valor['tipoChat'];
        $chat->nome = $valor['nome'];
        $chat->dataCriacao = $valor['dataCriacao'];

        return $chat;
    }
}
?>