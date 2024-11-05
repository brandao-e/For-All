<?php
    include_once "../model/HistoricoEmpresa.php";

    class HistoricoEmpresasController {
        public function getHistoricoEmpresas($idUsuario) {
            $historicoEmpresa = new HistoricoEmpresa();
            $historicoEmpresa->idUsuario = $idUsuario;
            return $historicoEmpresa->Consultar();
        }        
    }
    
?>