<?php
    require_once "classes/ConexaoOracle.php";

    class OracleDAO{
        public static $instance;

        private function __construct() {}

        public static function getInstance() {
            if(!isset(self::$instance)) self::$instance = new OracleDAO();
            return self::$instance;
        }

        //FUNÇOES DE INSERIR TABELAS
        public function criarTabelaVendedor() {
            try{
                $sqlTable = "CREATE TABLE Vendedor(
                    id int NOT NULL,
                    nome VARCHAR(255),
                    idCliente int,
                    PRIMARY KEY (id),
                    CONSTRAINT fkvendedor
                    FOREIGN KEY(idCliente)
                    REFERENCES Cliente(id)
                    ON DELETE CASCADE
                )";
                $sqlSequence = "CREATE SEQUENCE pkvendedor MINVALUE 1 START WITH 1";
                $sqlCommit = "COMMIT";
                $prepare = ConexaoOracle::getInstance()->prepare($sqlTable);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlSequence);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlCommit);
                return $prepare->execute();

            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }
        public function criarTabelaCliente() {
            try{
                $sqlTable = "CREATE TABLE Cliente(
                    id int NOT NULL,
                    nome VARCHAR(255),
                    PRIMARY KEY (id)
                )";
                $sqlSequence = "CREATE SEQUENCE pkcliente MINVALUE 1 START WITH 1";
                $sqlCommit = "COMMIT";
                $prepare = ConexaoOracle::getInstance()->prepare($sqlTable);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlSequence);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlCommit);
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
                $sqlUpdate = 'UPDATE Vendedor
                SET nome = :novoValor
                WHERE id = :id';
                $sqlCommit = "COMMIT";
                $prepare = ConexaoOracle::getInstance()->prepare($sqlUpdate);
                $prepare->bindValue(':id', $id, PDO::PARAM_INT);
                $prepare->bindValue(':novoValor', $novoValor, PDO::PARAM_STR);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlCommit);
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
                $sqlCommit = "COMMIT";
                $prepare = ConexaoOracle::getInstance()->prepare($sql);
                $prepare->bindValue(':id', $id, PDO::PARAM_INT);
                $prepare->bindValue(':novoValor', $novoValor, PDO::PARAM_STR);
                return $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlCommit);
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
                $sqlInsert = "INSERT INTO Cliente
                (id,nome)
                VALUES
                (PKCLIENTE.nextval,:nome)
                ";
                $sqlCommit = "COMMIT";
                $prepare = ConexaoOracle::getInstance()->prepare($sqlInsert);
                $prepare->bindValue(':nome', $nome, PDO::PARAM_STR);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlCommit);
                return $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }
        public function inserirVendedor($nome,$idCliente) {
            try{
                $sqlInsert = "INSERT INTO Vendedor
                (id,nome,idCliente)
                VALUES
                (PKCLIENTE.nextval,:nome,:idCliente)
                ";
                $sqlCommit = "COMMIT";
                $prepare = ConexaoOracle::getInstance()->prepare($sqlInsert);
                $prepare->bindValue(':nome', $nome, PDO::PARAM_STR);
                $prepare->bindValue(':idCliente', $idCliente, PDO::PARAM_INT);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlCommit);
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
                $prepare = ConexaoOracle::getInstance()->prepare($sql);
                $prepare->execute();
                return $result = $prepare->fetchAll();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            }
        }
        public function selecionarClientes() {
            try{
                $sql = 'SELECT * FROM Cliente';
                $prepare = ConexaoOracle::getInstance()->prepare($sql);
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
                $sql = 'SELECT 
                        v.nome as nomevendedor,
                        v.id as idvendedor,
                        v.idcliente as idcliente, 
                        c.nome as nomecliente 
                        FROM vendedor v 
                        INNER JOIN Cliente c 
                        ON v.idCliente = c.id';
                $prepare = ConexaoOracle::getInstance()->prepare($sql);
                $prepare->execute();
                return $result = $prepare->fetchAll();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }

        //FUNÇOES DE DELEÇÃO DE REGISTROS
        public function deletarCliente($id) {
            try{
                $sqlDelete = 'DELETE FROM Cliente
                WHERE id = :id';
                $sqlCommit = "COMMIT";
                $prepare = ConexaoOracle::getInstance()->prepare($sqlDelete);
                $prepare->bindValue(':id', $id, PDO::PARAM_INT);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlCommit);
                return $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }
        public function deletarVendedor($id) {
            try{
                $sqlDelete = 'DELETE FROM Vendedor
                WHERE id = :id';
                $sqlCommit = "COMMIT";
                $prepare = ConexaoOracle::getInstance()->prepare($sqlDelete);
                $prepare->bindValue(':id', $id, PDO::PARAM_INT);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlCommit);
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
                $sqlDropTable = "DROP TABLE Vendedor CASCADE CONSTRAINTS";
                $sqlDropSequence = "DROP SEQUENCE PKVENDEDOR";
                $sqlCommit = "COMMIT";
                $prepare = ConexaoOracle::getInstance()->prepare($sqlDropTable);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlDropSequence);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlCommit);
                return $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }
        public function deletarTabelaCliente() {
            try{
                $sqlDropTable = "DROP TABLE Cliente CASCADE CONSTRAINTS";
                $sqlDropSequence = "DROP SEQUENCE PKCLIENTE";
                $sqlCommit = "COMMIT";
                $prepare = ConexaoOracle::getInstance()->prepare($sqlDropTable);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlDropSequence);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlCommit);
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
                $sqlCommit = "COMMIT";
                $prepare = ConexaoOracle::getInstance()->prepare($sqlTable);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlCommit);
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
                $sqlCommit = "COMMIT";
                $prepare = ConexaoOracle::getInstance()->prepare($sqlDropTable);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlCommit);
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
                $sqlCommit = "COMMIT";
                $prepare = ConexaoOracle::getInstance()->prepare($sqlInsert);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlCommit);
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
                $sqlCommit = "COMMIT";
                $prepare = ConexaoOracle::getInstance()->prepare($sqlInsert);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlCommit);
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
                $sqlCommit = "COMMIT";
                $prepare = ConexaoOracle::getInstance()->prepare($sqlInsert);
                $prepare->execute();
                $prepare = ConexaoOracle::getInstance()->prepare($sqlCommit);
                $prepare->execute();
            } catch (Exception $e) {
                echo "Ocorreu um erro ao tentar executar esta ação";
                echo "<br>";
                echo $e->getMessage();
            }
        }

    }
?>