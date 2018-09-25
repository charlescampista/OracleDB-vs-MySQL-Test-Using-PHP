<?php
    require_once "classes/Conexao.php";



    class MySqlDAO {
        public static $instance;

        private function __construct() {}
        
        public static function getInstance() {
            if(!isset(self::$instance)) self::$instance = new MySqlDAO();
            return self::$instance;
        }



        //FUNÇÕES CRIAR TABELA
        public function criarTabelaVendedor() {
            try{
                $sql = "CREATE TABLE Vendedor(
                    id int NOT NULL AUTO_INCREMENT,
                    nome VARCHAR(255),
                    idCliente int,
                    PRIMARY KEY (id),
                    FOREIGN KEY (idCliente) REFERENCES Cliente(id)
                    ON DELETE CASCADE
                )";
                $prepare = Conexao::getInstance()->prepare($sql);
                return $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }
        public function criarTabelaCliente() {
            try{
                $sql = "CREATE TABLE Cliente(
                    id int NOT NULL AUTO_INCREMENT,
                    nome VARCHAR(255),
                    PRIMARY KEY (id)
                )";
                $prepare = Conexao::getInstance()->prepare($sql);
                return $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }

        //FUNÇÕES DELETAR TABELA
        public function deletarTabelaVendedor() {
            try{
                $sql = "DROP TABLE Vendedor";
                $prepare = Conexao::getInstance()->prepare($sql);
                return $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }
        public function deletarTabelaCliente() {
            try{
                $sql = "DROP TABLE Cliente";
                $prepare = Conexao::getInstance()->prepare($sql);
                return $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }

        //FUNÇÕES DE INSERÇÃO
        public function inserirCliente($nome) {
            try{
                $sql = 'INSERT INTO Cliente
                (nome)
                VALUES
                (:nome)';
                $prepare = Conexao::getInstance()->prepare($sql);
                $prepare->bindValue(':nome', $nome, PDO::PARAM_STR);
                //->bindValue(':calories', $calories, PDO::PARAM_INT);
                return $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }
        public function inserirVendedor($nome,$idCliente) {
            try{
                $sql = 'INSERT INTO Vendedor
                (nome,idCliente)
                VALUES
                (:nome,:idCliente)';
                $prepare = Conexao::getInstance()->prepare($sql);
                $prepare->bindValue(':nome', $nome, PDO::PARAM_STR);
                $prepare->bindValue(':idCliente', $idCliente, PDO::PARAM_INT);
                return $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }

        //FUNÇÕES DE ATUALIZAÇÃO
        public function atualizarVendedor($id,$novoValor) {
            try{
                $sql = 'UPDATE Vendedor
                SET nome = :novoValor
                WHERE id = :id';
                $prepare = Conexao::getInstance()->prepare($sql);
                $prepare->bindValue(':id', $id, PDO::PARAM_INT);
                $prepare->bindValue(':novoValor', $novoValor, PDO::PARAM_STR);
                return $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }
        public function atualizarCliente($id,$novoValor) {
            try{
                $sql = 'UPDATE Cliente
                SET nome = :novoValor
                WHERE id = :id';
                $prepare = Conexao::getInstance()->prepare($sql);
                $prepare->bindValue(':id', $id, PDO::PARAM_INT);
                $prepare->bindValue(':novoValor', $novoValor, PDO::PARAM_STR);
                return $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }

        //FUÇÕES DE CONSULTAS
        public function selecionarVendedores() {
            try{
                $sql = 'SELECT * FROM Vendedor';
                $prepare = Conexao::getInstance()->prepare($sql);
                $prepare->execute();
                return $result = $prepare->fetchAll();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }
        public function selecionarClientes() {
            try{
                $sql = 'SELECT * FROM Cliente';
                $prepare = Conexao::getInstance()->prepare($sql);
                $prepare->execute();
                return $result = $prepare->fetchAll();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }
        public function selecionarVendedoresClientes() {
            try{
                $sql = 'SELECT * FROM vendedor AS v
                INNER JOIN Cliente AS c ON v.idCliente = c.id';
                $prepare = Conexao::getInstance()->prepare($sql);
                $prepare->execute();
                return $result = $prepare->fetchAll();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }

        //FUNÇOES DE DELEÇÃO
        public function deletarCliente($id) {
            try{
                $sql = 'DELETE FROM Cliente
                WHERE id = :id';
                $prepare = Conexao::getInstance()->prepare($sql);
                $prepare->bindValue(':id', $id, PDO::PARAM_INT);
                return $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }
        public function deletarVendedor($id) {
            try{
                $sql = 'DELETE FROM Vendedor
                WHERE id = :id';
                $prepare = Conexao::getInstance()->prepare($sql);
                $prepare->bindValue(':id', $id, PDO::PARAM_INT);
                return $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }



        ############################## TESTE STRESS #################################################
        public function criarTabelaTeste() {
            try{
                $sqlTable = "CREATE TABLE Teste(
                    campo1 VARCHAR(255),
                    campo2 VARCHAR(255),
                    campo3 VARCHAR(255),
                    campo4 VARCHAR(255),
                    campo5 VARCHAR(255)
                )";
                $prepare = Conexao::getInstance()->prepare($sqlTable);
                $prepare->execute();

            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }
        public function deletarTabelaTeste() {
            try{
                $sqlDropTable = "DROP TABLE Teste";
                $prepare = Conexao::getInstance()->prepare($sqlDropTable);
                $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }
        public function inserirRegistroTeste() {
            try{
                $sqlInsert = "INSERT INTO Teste
                (campo1,campo2,campo3,campo4,campo5)
                VALUES
                ('nome1','nome2','nome3','nome4','nome5')
                ";
                $prepare = Conexao::getInstance()->prepare($sqlInsert);
                $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }
        public function selecionarRegistrosTeste() {
            try{
                $sqlInsert = "SELECT * FROM Teste";
                $prepare = Conexao::getInstance()->prepare($sqlInsert);
                $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }
        public function deletarRegistrosTeste() {
            try{
                $sqlInsert = "DELETE FROM Teste";
                $prepare = Conexao::getInstance()->prepare($sqlInsert);
                $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }
    }
?>