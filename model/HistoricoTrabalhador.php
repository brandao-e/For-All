<?php 
class HistoricoTrabalhador implements JsonSerializable {
    private $idContratacao;
    private $dataContratacao;
    private $idTrabalhador;
    private $idEmpresa;
    private $con;

    private $idUsuario;
    private $primeiroNome;
    private $ultimoNome;
    private $email;
    private $biografia;
    private $servico;
    private $subcategoria;

    function jsonSerialize(): mixed {
        return [
            'id_contratacao' => $this->idContratacao,
            'data_contratacao' => $this->dataContratacao,
            'id_trabalhador' => $this->idTrabalhador,
            'id_empresa' => $this->idEmpresa,

            'primeiroNome' => $this->primeiroNome,
            'ultimoNome' => $this->ultimoNome,
            'email' => $this->email,
            'biografia' => $this->biografia,
            'servico' => $this->servico,
            'subcategoria' => $this->subcategoria
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
        $sql = "SELECT DISTINCT hc.idContratacaoFuncio,
                        hc.idEmpresa,
                        hc.dataContratacao,
                        t.primeiroNome,
                        t.ultimoNome,
                        t.email,
                        t.biografia,
                        s.servico,
                        sb.subcategoria
            FROM historicofuncionario hc
            INNER JOIN trabalhador t ON t.idTrabalhador = hc.idTrabalhador
            INNER JOIN servico s ON s.idServico = t.servico
            INNER JOIN subcategoria sb ON sb.idSubcategoria = t.subcategoria  -- Corrigido alias para 'sb'
            INNER JOIN usuario u ON u.idEmpresa = hc.idEmpresa
            WHERE u.idUsuario = ?";
        $valores = array($this->idUsuario);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);

        $dados = array();

        foreach($exec->fetchAll() as $valor) {
            $historico = new HistoricoTrabalhadore();
            $historico->idContratacao = $valor['idContratacao'];
            $historico->idEmpresa = $valor['idEmpresa'];
            $historico->dataContratacao = $valor['dataContratacao'];
            $historico->primeiroNome = $valor['primeiroNome'];
            $historico->ultimoNome = $valor['ultimoNome'];
            $historico->email = $valor['email'];
            $historico->biografia = $valor['biografia'];
            $historico->servico = $valor['servico'];
            $historico->subcategoria = $valor['subcategoria'];

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