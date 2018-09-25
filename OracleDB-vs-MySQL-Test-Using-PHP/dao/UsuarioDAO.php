<?php
    require_once "classes/Conexao.php";
    require_once "classes/Usuario.php";
    
    class UsuarioDAO {
        public static $instance;

        private function __construct() {
            //
        }

        public static function getInstance(){
            if(!isset(self::$instance)) self::$instance = new UsuarioDAO();
            return self::$instance;
        }
        
        public function inserir(Usuario $usuario){
            try{
                $sql = "INSERT INTO usuario(
                    nome
                    )
                    VALUES(
                    :nome
                    )";

                $prepare = Conexao::getInstance()->prepare($sql);
                $prepare->bindValue(":nome",$usuario->getNome());
                return $prepare->execute();
            }   catch (Exception $e) {
                print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            }
        }
    }
?>