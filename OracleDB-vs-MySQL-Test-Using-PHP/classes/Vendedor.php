<?php

    class Vendedor {
        private $id;
        private $nome;
        private $idCliente;

        public function getId() {
            return $this->id;
        }
        public function setId($id) {
            $this->id = $id;
        }

        public function getNome() {
            return $this->nome;
        }
        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function getIdCliente() {
            return $this->idCliente;
        }
        public function setIdCliente($idCliente) {
            $this->idCliente = $idCliente;
        }
    }

?>