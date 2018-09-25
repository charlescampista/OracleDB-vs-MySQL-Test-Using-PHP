<?php
    require_once "classes/Vendedor.php";
    require_once "classes/Cliente.php";
    
    
    class Utilitarios {
        public function instanciarClientes($qtdElementos) {
            $listaClientes = new ArrayObject();
            for($i=0;$i<$qtdElementos;$i++){
                $cliente = new Cliente();
                $cliente->setNome('Cliente'.($i+1));
                $listaClientes->append($cliente);
            }
            return $listaClientes;
        }
        public function instanciarVendedores($qtdElementos) {
            $listaVendedores = new ArrayObject();
            for($i=0;$i<$qtdElementos;$i++){
                $vendedor = new Vendedor();
                $vendedor->setNome('Vendedor'.($i+1));
                $listaVendedores->append($vendedor);
            }
            return $listaVendedores;
        }
    }
?>