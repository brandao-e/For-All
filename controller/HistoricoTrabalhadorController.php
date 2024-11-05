<?php
    include_once("../model/HistoricoTrabalhador.php");

    class HistoricoTrabalhadorController {
        public function getHistoricoTrabalhadores($idUsuario) {
            $historicoTrabalhador = new HistoricoTrabalhador();
            $historicoTrabalhador->idUsuario = $idUsuario;
            return $historicoTrabalhador->Consultar();
        }
    }
?>