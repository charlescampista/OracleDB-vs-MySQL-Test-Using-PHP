
<?php

//require_once "Usuario.php";

class ConexaoOracle {

    //private $dbh;

    public static $instance;

    private function __construct() {
    }
    
    public static function getInstance(){
        if (!isset(self::$instance)){
            try {
        
                $server         = "127.0.0.1";
                $db_username    = "SYSTEM";
                $db_password    = "";
                $service_name   = "XE";
                $sid            = "";
                $port           = 1521;
                $dbtns          = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = $server)(PORT = $port)) (CONNECT_DATA = (SERVICE_NAME = $service_name) (SID = $sid)))";
        
                //$this->dbh = new PDO("mysql:host=".$server.";dbname=".dbname, $db_username, $db_password);
        
                self::$instance = new PDO("oci:dbname=" . $dbtns . ";charset=utf8", $db_username, $db_password, array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
        
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

        }

        return self::$instance;
    }

    /*public function select($sql) {
        $sql_stmt = $this->dbh->prepare($sql);
        $sql_stmt->execute();
        $result = $sql_stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "Sucesso na execucao";
        var_dump($result);
        return $result;
    }

    public function insert($sql) {
        $sql_stmt = $this->dbh->prepare($sql);
        try {
            $result = $sql_stmt->execute();
        } catch (PDOException $e) {
            trigger_error('Error occured while trying to insert into the DB:' . $e->getMessage(), E_USER_ERROR);
        }
        if ($result) {
            return $sql_stmt->rowCount();
        }
    }

    function __destruct() {
        $this->dbh = NULL;
    }
    */
}

/*$dbh = new PDOConnection();

$start = microtime(true);
for($i=0; $i<3000; $i++){
    $usuario = new Usuario();
    $usuario->setNome("Usuario".$i);
    $dbh->insert("insert into USUARIO columns(ID,NAME) values (".$i.",'teste".($i+1)."')");
}
$end = microtime(true);
echo "<h1>Esta operação levou".($start - $end)."Segundos.</h1>";


$dbh->insert("insert into USUARIO columns(ID,NAME) values (102,'Charles')");*/
//$dbh->select("select * from usuario");

?>
