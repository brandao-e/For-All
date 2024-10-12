<?php 
// Utilizada pra preencher o campo "outras experiencias" no perfil do trabalhador
class Experiencias implements JsonSerializable {
    private $idExperiencia;
    private $titulo;
    private $texto;
    private $idTrabalhador;
    private $con;

    function jsonSerialize(): mixed {
        return [
            'id_experiencia' => $this->idExperiencia,
            'titulo' => $this->titulo,
            'texto' => $this->texto,
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
        $sql = "INSERT INTO experiencias (titulo, texto, idTrabalhador) VALUES (?, ?, ?)";
        $valores = array($this->titulo, $this->texto, $this->idTrabalhador);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Atualizar() {
        $sql = "UPDATE experiencias SET titulo = ?, texto = ?, idTrabalhador = ? WHERE idExperiencia = ?";
        $valores = array($this->titulo, $this->texto, $this->idTrabalhador, $this->idExperiencia);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Excluir() {
        $sql = "DELETE FROM experiencias WHERE idExperiencia = ?";
        $valores = array($this->idExperiencia);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Consultar() {
        $sql = "SELECT * FROM experiencias";
        $exec = $this->con->prepare($sql);
        $exec->execute();

        $dados = array();

        foreach($exec->fetchAll() as $valor) {
            $experiencia = new Experiencias();
            $experiencia->idExperiencia = $valor['idExperiencia'];
            $experiencia->titulo = $valor['titulo'];
            $experiencia->texto = $valor['texto'];
            $experiencia->idTrabalhador = $valor['idTrabalhador'];

            $dados[] = $experiencia;
        }

        return $dados;
    }

    function RetornaDados() {
        $sql = "SELECT * FROM experiencias WHERE idExperiencia = ?";
        $valores = array($this->idExperiencia);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
        $valor = $exec->fetch();

        $experiencia = new Experiencias();
        $experiencia->idExperiencia = $valor['idExperiencia'];
        $experiencia->titulo = $valor['titulo'];
        $experiencia->texto = $valor['texto'];
        $experiencia->idTrabalhador = $valor['idTrabalhador'];

        return $experiencia;
    }
}
?>