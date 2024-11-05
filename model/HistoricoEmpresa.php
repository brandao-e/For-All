<?php 
class HistoricoEmpresa implements JsonSerializable {
    private $idContratacao;
    private $dataContratacao;
    private $idEmpresa;
    private $idTrabalhador;

    private $empresaPrimeiroNome;
    private $vagaTitulo;
    private $vagaSalario;
    private $vagaDesc;
    private $vagaServico;
    private $idUsuario;
    private $con;

    function jsonSerialize(): mixed {
        return [
            'idContratacao' => $this->idContratacao,
            'dataContratacao' => $this->dataContratacao,
            'idEmpresa' => $this->idEmpresa,
            'idTrabalhador' => $this->idTrabalhador,

            'primeiroNome' => $this->empresaPrimeiroNome,
            'tituloVaga' => $this->vagaTitulo,
            'salarioVaga' => $this->vagaSalario,
            'descricao' => $this->vagaDesc,
            'servico' => $this->vagaServico
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
        $sql = "SELECT DISTINCT he.idContratacao,
                    e.primeiroNome,
                    he.idEmpresa,
                    v.tituloVaga,
                    he.dataContratacao,
                    v.salarioVaga,
                    v.descricao,
                    s.servico,
                    he.idTrabalhador
                FROM historicoempresas he
                INNER JOIN empresa e ON e.idEmpresa = he.idEmpresa
                INNER JOIN vagas v ON v.idEmpresa = he.idEmpresa
                INNER JOIN servico s ON v.servicoVaga = s.idServico
                INNER JOIN usuario u ON u.idTrabalhador = he.idTrabalhador
                WHERE u.idUsuario = ?";
    
        $valores = array($this->idUsuario);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    
        $dados = array();
    
        foreach($exec->fetchAll() as $valor) {
            $historico = new HistoricoEmpresa();
            $historico->idContratacao = $valor['idContratacao'];
            $historico->empresaPrimeiroNome = $valor['primeiroNome'];
            $historico->idEmpresa = $valor['idEmpresa'];
            $historico->vagaTitulo = $valor['tituloVaga'];
            $historico->dataContratacao = $valor['dataContratacao'];
            $historico->vagaSalario = $valor['salarioVaga'];
            $historico->vagaDesc = $valor['descricao'];
            $historico->vagaServico = $valor['servico'];
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