<?php 
class Publicacao implements JsonSerializable {
    private $idPublicacao;
    private $idUsuario;
    private $conteudo;
    private $dataPublicacao;
    private $horaPublicacao;
    private $con;

    function jsonSerialize(): mixed {
        return [
            'idPublicacao' => $this->idPublicacao,
            'idUsuario' => $this->idUsuario,
            'conteudo' => $this->conteudo,
            'dataPublicacao' => $this->dataPublicacao,
            'horaPublicacao' => $this->horaPublicacao
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
        $sql = "INSERT INTO publicacoes (idUsuario, conteudo, dataPublicacao, horaPublicacao) VALUES (?, ?, ?, ?)";
        $valores = array($this->idUsuario, $this->conteudo, $this->dataPublicacao, $this->horaPublicacao);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Atualizar() {
        $sql = "UPDATE publicacoes SET idUsuario = ?, conteudo = ?, dataPublicacao = ?, horaPublicacao = ? WHERE idPublicacao = ?";
        $valores = array($this->idUsuario, $this->conteudo, $this->dataPublicacao, $this->horaPublicacao, $this->idPublicacao);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Excluir() {
        $sql = "DELETE FROM publicacoes WHERE idPublicacao = ?";
        $valores = array($this->idPublicacao);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Consultar() {
        $sql = "SELECT * FROM publicacoes";
        $exec = $this->con->prepare($sql);
        $exec->execute();

        $dados = array();

        foreach($exec->fetchAll() as $valor) {
            $publicacao = new Publicacao();
            $publicacao->idPublicacao = $valor['idPublicacao'];
            $publicacao->idUsuario = $valor['idUsuario'];
            $publicacao->conteudo = $valor['conteudo'];
            $publicacao->dataPublicacao = $valor['dataPublicacao'];
            $publicacao->horaPublicacao = $valor['horaPublicacao'];

            $dados[] = $publicacao;
        }

        return $dados;
    }

    function RetornaDados() {
        $sql = "SELECT * FROM publicacoes WHERE idPublicacao = ?";
        $valores = array($this->idPublicacao);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
        $valor = $exec->fetch();

        $publicacao = new Publicacao();
        $publicacao->idPublicacao = $valor['idPublicacao'];
        $publicacao->idUsuario = $valor['idUsuario'];
        $publicacao->conteudo = $valor['conteudo'];
        $publicacao->dataPublicacao = $valor['dataPublicacao'];
        $publicacao->horaPublicacao = $valor['horaPublicacao'];

        return $publicacao;
    }
}
?>