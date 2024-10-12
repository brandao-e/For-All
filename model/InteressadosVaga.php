<?php 
// Classe utilizada quando clicar no botão "demonstrar interesse"
class InteressadosVaga implements JsonSerializable {
    private $codigo;
    private $idTrabalhador;
    private $idVaga;
    private $con;

    function jsonSerialize(): mixed {
        return [
            'codigo' => $this->codigo,
            'id_trabalhador' => $this->idTrabalhador,
            'id_vaga' => $this->idVaga
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
        $sql = "INSERT INTO interessados_vaga (idTrabalhador, idVaga) VALUES (?, ?)";
        $valores = array($this->idTrabalhador, $this->idVaga);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Atualizar() {
        $sql = "UPDATE interessados_vaga SET idTrabalhador = ?, idVaga = ? WHERE codigo = ?";
        $valores = array($this->idTrabalhador, $this->idVaga, $this->codigo);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Excluir() {
        $sql = "DELETE FROM interessados_vaga WHERE codigo = ?";
        $valores = array($this->codigo);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Consultar() {
        $sql = "SELECT * FROM interessados_vaga";
        $exec = $this->con->prepare($sql);
        $exec->execute();

        $dados = array();

        foreach($exec->fetchAll() as $valor) {
            $interessado = new InteressadosVaga();
            $interessado->codigo = $valor['codigo'];
            $interessado->idTrabalhador = $valor['idTrabalhador'];
            $interessado->idVaga = $valor['idVaga'];

            $dados[] = $interessado;
        }

        return $dados;
    }

    function RetornaDados() {
        $sql = "SELECT * FROM interessados_vaga WHERE codigo = ?";
        $valores = array($this->codigo);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
        $valor = $exec->fetch();

        $interessado = new InteressadosVaga();
        $interessado->codigo = $valor['codigo'];
        $interessado->idTrabalhador = $valor['idTrabalhador'];
        $interessado->idVaga = $valor['idVaga'];

        return $interessado;
    }
}
?>