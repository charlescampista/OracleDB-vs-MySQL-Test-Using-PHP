<?php
    require_once "classes/Conexao.php";
    require_once "classes/Utilitarios.php";
    require_once "dao/MySqlDAO.php";
    require_once "dao/OracleDAO.php";
    session_start();
    $qtdFixo = 10000;

    isset($_SESSION["mysqlCriarDeletar"]) ? $mysqlCriarDeletar = $_SESSION["mysqlCriarDeletar"] :  $mysqlCriarDeletar = "Não definido";
    isset($_SESSION["mysqlInserir"]) ? $mysqlInserir = $_SESSION["mysqlInserir"] :  $mysqlInserir = "Não definido";
    isset($_SESSION["mysqlSelecionar"]) ? $mysqlSelecionar = $_SESSION["mysqlSelecionar"] :  $mysqlSelecionar = "Não definido";
    isset($_SESSION["mysqlDeletarRegistros"]) ? $mysqlDeletarRegistros = $_SESSION["mysqlDeletarRegistros"] : $mysqlDeletarRegistros = "Não definido";
    
    isset($_SESSION["oracleCriarDeletar"]) ? $oracleCriarDeletar = $_SESSION["oracleCriarDeletar"]  : $oracleCriarDeletar = "Não definido";
    isset($_SESSION["oracleInserir"]) ? $oracleInserir = $_SESSION["oracleInserir"] : $oracleInserir = "Não definido";
    isset($_SESSION["oracleSelecionar"]) ? $oracleSelecionar = $_SESSION["oracleSelecionar"]  : $oracleSelecionar = "Não definido";
    isset($_SESSION["oracleDeletarRegistros"]) ? $oracleDeletarRegistros = $_SESSION["oracleDeletarRegistros"]  : $oracleDeletarRegistros = "Não definido";

    isset($_SESSION["mysqlcriarTabelaVendedor"]) ?  $mysqlcriarTabelaVendedor = $_SESSION["mysqlcriarTabelaVendedor"] : $mysqlcriarTabelaVendedor = "Não definido";
    isset($_SESSION["mysqlcriarTabelaCliente"]) ?  $mysqlcriarTabelaCliente = $_SESSION["mysqlcriarTabelaCliente"] : $mysqlcriarTabelaCliente = "Não definido";
    isset($_SESSION["mysqlinserirCliente"]) ?  $mysqlinserirCliente = $_SESSION["mysqlinserirCliente"] : $mysqlinserirCliente = "Não definido";
    isset($_SESSION["mysqlinserirVendedor"]) ?  $mysqlinserirVendedor = $_SESSION["mysqlinserirVendedor"] : $mysqlinserirVendedor = "Não definido";
    isset($_SESSION["mysqlatualizarCliente"]) ?  $mysqlatualizarCliente = $_SESSION["mysqlatualizarCliente"] : $mysqlatualizarCliente = "Não definido";
    isset($_SESSION["mysqlselecionarClientes"]) ?  $mysqlselecionarClientes = $_SESSION["mysqlselecionarClientes"] : $mysqlselecionarClientes = "Não definido";
    isset($_SESSION["mysqlselecionarVendedores"]) ?  $mysqlselecionarVendedores = $_SESSION["mysqlselecionarVendedores"] : $mysqlselecionarVendedores = "Não definido";
    isset($_SESSION["mysqlselecionarVendedorCliente"]) ?  $mysqlselecionarVendedorCliente = $_SESSION["mysqlselecionarVendedorCliente"] : $mysqlselecionarVendedorCliente = "Não definido";
    isset($_SESSION["mysqldeletarClientes"]) ?  $mysqldeletarClientes = $_SESSION["mysqldeletarClientes"] : $mysqldeletarClientes = "Não definido";
    isset($_SESSION["mysqldeletarVendedores"]) ?  $mysqldeletarVendedores = $_SESSION["mysqldeletarVendedores"] : $mysqldeletarVendedores = "Não definido";
    isset($_SESSION["mysqldeletarTabelaCliente"]) ?  $mysqldeletarTabelaCliente = $_SESSION["mysqldeletarTabelaCliente"] : $mysqldeletarTabelaCliente = "Não definido";
    isset($_SESSION["mysqldeletarTabelaVendedor"]) ?  $mysqldeletarTabelaVendedor = $_SESSION["mysqldeletarTabelaVendedor"] : $mysqldeletarTabelaVendedor = "Não definido";
    
    isset($_SESSION["oraclecriarTabelaVendedor"])  ?  $oraclecriarTabelaVendedor  =  $_SESSION["oraclecriarTabelaVendedor"]      : $oraclecriarTabelaVendedor  = "Não definido";
    isset($_SESSION["oraclecriarTabelaCliente"])  ?  $oraclecriarTabelaCliente  =  $_SESSION["oraclecriarTabelaCliente"]      : $oraclecriarTabelaCliente  = "Não definido";
    isset($_SESSION["oracleinserirCliente"])  ?  $oracleinserirCliente  =  $_SESSION["oracleinserirCliente"]      : $oracleinserirCliente  = "Não definido";
    isset($_SESSION["oracleinserirVendedor"])  ?  $oracleinserirVendedor  =  $_SESSION["oracleinserirVendedor"]      : $oracleinserirVendedor  = "Não definido";
    isset($_SESSION["oracleatualizarCliente"])  ?  $oracleatualizarCliente  =  $_SESSION["oracleatualizarCliente"]      : $oracleatualizarCliente  = "Não definido";
    isset($_SESSION["oracleselecionarClientes"])  ?  $oracleselecionarClientes  =  $_SESSION["oracleselecionarClientes"]      : $oracleselecionarClientes  = "Não definido";
    isset($_SESSION["oracleselecionarVendedores"])  ?  $oracleselecionarVendedores  =  $_SESSION["oracleselecionarVendedores"]      : $oracleselecionarVendedores  = "Não definido";
    isset($_SESSION["oracleselecionarVendedorCliente"])  ?  $oracleselecionarVendedorCliente  =  $_SESSION["oracleselecionarVendedorCliente"]      : $oracleselecionarVendedorCliente  = "Não definido";
    isset($_SESSION["oracledeletarClientes"])  ?  $oracledeletarClientes  =  $_SESSION["oracledeletarClientes"]      : $oracledeletarClientes  = "Não definido";
    isset($_SESSION["oracledeletarVendedores"])  ?  $oracledeletarVendedores  =  $_SESSION["oracledeletarVendedores"]      : $oracledeletarVendedores  = "Não definido";
    isset($_SESSION["oracledeletarTabelaCliente"])  ?  $oracledeletarTabelaCliente  =  $_SESSION["oracledeletarTabelaCliente"]      : $oracledeletarTabelaCliente  = "Não definido";
    isset($_SESSION["oracledeletarTabelaVendedor"])  ?  $oracledeletarTabelaVendedor  =  $_SESSION["oracledeletarTabelaVendedor"]      : $oracledeletarTabelaVendedor  = "Não definido";




    function salvarValoresTesteStress(){
        global $mysqlCriarDeletar;
        global $mysqlInserir;
        global $mysqlSelecionar;
        global $mysqlDeletarRegistros;
        global $oracleCriarDeletar;
        global $oracleInserir;
        global $oracleSelecionar;
        global $oracleDeletarRegistros;
    
        $_SESSION["mysqlCriarDeletar"] = $mysqlCriarDeletar;
        $_SESSION["mysqlInserir"] = $mysqlInserir;
        $_SESSION["mysqlSelecionar"] = $mysqlSelecionar;
        $_SESSION["mysqlDeletarRegistros"] = $mysqlDeletarRegistros;

        $_SESSION["oracleCriarDeletar"] = $oracleCriarDeletar;
        $_SESSION["oracleInserir"] = $oracleInserir;
        $_SESSION["oracleSelecionar"] = $oracleSelecionar;
        $_SESSION["oracleDeletarRegistros"] = $oracleDeletarRegistros;
    }

    function salvarValoresTesteFixo() {
    global $mysqlcriarTabelaVendedor;
    global $mysqlcriarTabelaCliente;
    global $mysqlinserirCliente;
    global $mysqlinserirVendedor;
    global $mysqlatualizarCliente;
    global $mysqlselecionarClientes;
    global $mysqlselecionarVendedores;
    global $mysqlselecionarVendedorCliente;
    global $mysqldeletarClientes;
    global $mysqldeletarVendedores;
    global $mysqldeletarTabelaCliente;
    global $mysqldeletarTabelaVendedor;
    
    global $oraclecriarTabelaVendedor;
    global $oraclecriarTabelaCliente;
    global $oracleinserirCliente;
    global $oracleinserirVendedor;
    global $oracleatualizarCliente;
    global $oracleselecionarClientes;
    global $oracleselecionarVendedores;
    global $oracleselecionarVendedorCliente;
    global $oracledeletarClientes;
    global $oracledeletarVendedores;
    global $oracledeletarTabelaCliente;
    global $oracledeletarTabelaVendedor;

    $_SESSION["mysqlcriarTabelaVendedor"] =  $mysqlcriarTabelaVendedor;
    $_SESSION["mysqlcriarTabelaCliente"] =  $mysqlcriarTabelaCliente;
    $_SESSION["mysqlinserirCliente"] =  $mysqlinserirCliente;
    $_SESSION["mysqlinserirVendedor"] =  $mysqlinserirVendedor;
    $_SESSION["mysqlatualizarCliente"] =  $mysqlatualizarCliente;
    $_SESSION["mysqlselecionarClientes"] =  $mysqlselecionarClientes;
    $_SESSION["mysqlselecionarVendedores"] =  $mysqlselecionarVendedores;
    $_SESSION["mysqlselecionarVendedorCliente"] =  $mysqlselecionarVendedorCliente;
    $_SESSION["mysqldeletarClientes"] =  $mysqldeletarClientes;
    $_SESSION["mysqldeletarVendedores"] =  $mysqldeletarVendedores;
    $_SESSION["mysqldeletarTabelaCliente"] =  $mysqldeletarTabelaCliente;
    $_SESSION["mysqldeletarTabelaVendedor"] =  $mysqldeletarTabelaVendedor;

    $_SESSION["oraclecriarTabelaVendedor"] =  $oraclecriarTabelaVendedor;
    $_SESSION["oraclecriarTabelaCliente"] =  $oraclecriarTabelaCliente;
    $_SESSION["oracleinserirCliente"] =  $oracleinserirCliente;
    $_SESSION["oracleinserirVendedor"] =  $oracleinserirVendedor;
    $_SESSION["oracleatualizarCliente"] =  $oracleatualizarCliente;
    $_SESSION["oracleselecionarClientes"] =  $oracleselecionarClientes;
    $_SESSION["oracleselecionarVendedores"] =  $oracleselecionarVendedores;
    $_SESSION["oracleselecionarVendedorCliente"] =  $oracleselecionarVendedorCliente;
    $_SESSION["oracledeletarClientes"] =  $oracledeletarClientes;
    $_SESSION["oracledeletarVendedores"] =  $oracledeletarVendedores;
    $_SESSION["oracledeletarTabelaCliente"] =  $oracledeletarTabelaCliente;
    $_SESSION["oracledeletarTabelaVendedor"] =  $oracledeletarTabelaVendedor;
    
    }

    if(array_key_exists('zerar',$_POST)){
        global $mysqlcriarTabelaVendedor;
        global $mysqlcriarTabelaCliente;
        global $mysqlinserirCliente;
        global $mysqlinserirVendedor;
        global $mysqlatualizarCliente;
        global $mysqlselecionarClientes;
        global $mysqlselecionarVendedores;
        global $mysqlselecionarVendedorCliente;
        global $mysqldeletarClientes;
        global $mysqldeletarVendedores;
        global $mysqldeletarTabelaCliente;
        global $mysqldeletarTabelaVendedor;
        
        global $oraclecriarTabelaVendedor;
        global $oraclecriarTabelaCliente;
        global $oracleinserirCliente;
        global $oracleinserirVendedor;
        global $oracleatualizarCliente;
        global $oracleselecionarClientes;
        global $oracleselecionarVendedores;
        global $oracleselecionarVendedorCliente;
        global $oracledeletarClientes;
        global $oracledeletarVendedores;
        global $oracledeletarTabelaCliente;
        global $oracledeletarTabelaVendedor;

        global $mysqlCriarDeletar;
        global $mysqlInserir;
        global $mysqlSelecionar;
        global $mysqlDeletarRegistros;
        global $oracleCriarDeletar;
        global $oracleInserir;
        global $oracleSelecionar;
        global $oracleDeletarRegistros;


        $_SESSION["mysqlcriarTabelaVendedor"] =  "Não definido";
        $_SESSION["mysqlcriarTabelaCliente"] =  "Não definido";
        $_SESSION["mysqlinserirCliente"] =  "Não definido";
        $_SESSION["mysqlinserirVendedor"] =  "Não definido";
        $_SESSION["mysqlatualizarCliente"] =  "Não definido";
        $_SESSION["mysqlselecionarClientes"] =  "Não definido";
        $_SESSION["mysqlselecionarVendedores"] =  "Não definido";
        $_SESSION["mysqlselecionarVendedorCliente"] =  "Não definido";
        $_SESSION["mysqldeletarClientes"] =  "Não definido";
        $_SESSION["mysqldeletarVendedores"] =  "Não definido";
        $_SESSION["mysqldeletarTabelaCliente"] =  "Não definido";
        $_SESSION["mysqldeletarTabelaVendedor"] =  "Não definido";

        $_SESSION["oraclecriarTabelaVendedor"] =  "Não definido";
        $_SESSION["oraclecriarTabelaCliente"] =  "Não definido";
        $_SESSION["oracleinserirCliente"] =  "Não definido";
        $_SESSION["oracleinserirVendedor"] =  "Não definido";
        $_SESSION["oracleatualizarCliente"] =  "Não definido";
        $_SESSION["oracleselecionarClientes"] =  "Não definido";
        $_SESSION["oracleselecionarVendedores"] =  "Não definido";
        $_SESSION["oracleselecionarVendedorCliente"] =  "Não definido";
        $_SESSION["oracledeletarClientes"] =  "Não definido";
        $_SESSION["oracledeletarVendedores"] =  "Não definido";
        $_SESSION["oracledeletarTabelaCliente"] =  "Não definido";
        $_SESSION["oracledeletarTabelaVendedor"] =  "Não definido";

        $_SESSION["mysqlCriarDeletar"] = "Não definido";
        $_SESSION["mysqlInserir"] = "Não definido";
        $_SESSION["mysqlSelecionar"] = "Não definido";
        $_SESSION["mysqlDeletarRegistros"] = "Não definido";
        $_SESSION["oracleCriarDeletar"] = "Não definido";
        $_SESSION["oracleInserir"] = "Não definido";
        $_SESSION["oracleSelecionar"] = "Não definido";
        $_SESSION["oracleDeletarRegistros"] = "Não definido";

    }

    ################################## - MYSQL - ################################################

    //EVENTOS DE INSERIR TABELAS
    if(array_key_exists('inserirtblvendedor',$_POST)){
        $start = microtime(true);
        MySqlDAO::getInstance()->criarTabelaVendedor();
        $end = microtime(true);
        $mysqlcriarTabelaVendedor = (($start - $end)*-1);

        salvarValoresTesteFixo();
    }
    if(array_key_exists('inserirtblcliente',$_POST)){
        $start = microtime(true);
        MySqlDAO::getInstance()->criarTabelaCliente();
        $end = microtime(true);
        $mysqlcriarTabelaCliente = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }

    //EVENTOS DE DELETAR TABELAS
    if(array_key_exists('deletartblvendedor',$_POST)){
        $start = microtime(true);
        MySqlDAO::getInstance()->deletarTabelaVendedor();
        $end = microtime(true);
        $mysqldeletarTabelaVendedor = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }
    if(array_key_exists('deletartblcliente',$_POST)){
        $start = microtime(true);
        MySqlDAO::getInstance()->deletarTabelaCliente();
        $end = microtime(true);
        $mysqldeletarTabelaCliente= (($start - $end)*-1);
        salvarValoresTesteFixo();
    }
    
    //EVENTOS INSERÇÃO DE DADOS
    if(array_key_exists('inserirclientes',$_POST)){
        global $qtdFixo;
        $utilitarios = new Utilitarios();
        $listaClientes = $utilitarios->instanciarClientes($qtdFixo);
        echo "<h2>Instancias de Clientes Criadas</h2>";
        $start = microtime(true);
        for($i=0;$i<sizeof($listaClientes);$i++) {
            MySqlDAO::getInstance()->inserirCliente($listaClientes[$i]->getNome());
        }
        $end = microtime(true);
        $mysqlinserirCliente = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }
    if(array_key_exists('inserirvendedores',$_POST)){
        global $qtdFixo;
        $utilitarios = new Utilitarios();
        $listaVendedores = $utilitarios->instanciarVendedores($qtdFixo);
        echo "<h2>Instancias de Vendedores Criadas</h2>";
        $start = microtime(true);
        for($i=0;$i<sizeof($listaVendedores);$i++) {
            MySqlDAO::getInstance()->inserirVendedor($listaVendedores[$i]->getNome(),1);
        }
        $end = microtime(true);
        $mysqlinserirVendedor = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }

    //EVENTOS DE ATUALIZAÇÃO DE DADOS
    if(array_key_exists('atualizarvendedores',$_POST)){
        global $qtdFixo;
        $start = microtime(true);
        for($i=0;$i<$qtdFixo;$i++) {
            MySqlDAO::getInstance()->atualizarVendedor(($i+1),"teste teste teste teste teste teste teste teste".($i+1));
        }
        $end = microtime(true);
        $mysqlatualizarCliente = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }
    if(array_key_exists('atualizarclientes',$_POST)){
        global $qtdFixo;
        $start = microtime(true);
        for($i=0;$i<$qtdFixo;$i++) {
            MySqlDAO::getInstance()->atualizarCliente(($i+1),"teste teste teste teste teste teste teste teste".($i+1));
        }
        $end = microtime(true);
        $mysqlatualizarCliente = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }

    //EVENTOS DE SELEÇÃO
    if(array_key_exists('selecionarvendedores',$_POST)){
        $start = microtime(true);
        $lista = MySqlDAO::getInstance()->selecionarvendedores();
        $end = microtime(true);
        /* foreach ($lista as $vendedor) {
            echo $vendedor['nome'];
            echo "<br>";
        } */
        $mysqlselecionarVendedores = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }
    if(array_key_exists('selecionarclientes',$_POST)){
        $start = microtime(true);
        $lista = MySqlDAO::getInstance()->selecionarclientes();
        $end = microtime(true);
        $mysqlselecionarClientes = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }
    if(array_key_exists('selecionarvendedoresclientes',$_POST)){
        $start = microtime(true);
        $lista = MySqlDAO::getInstance()->selecionarVendedoresClientes();
        $end = microtime(true);
        /* foreach ($lista as $cliente) {
            echo $cliente['1'];
            echo "<br>";
        } */
        $mysqlselecionarVendedorCliente = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }

    //EVENTOS DE DELEÇÃO
    if(array_key_exists('deletarclientes',$_POST)){
        $start = microtime(true);
        for($i=0;$i<$qtdFixo;$i++) {
            MySqlDAO::getInstance()->deletarCliente(($i+1));
        }
        $end = microtime(true);
        $mysqldeletarClientes = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }
    if(array_key_exists('deletarvendedor',$_POST)){
        $start = microtime(true);
        for($i=0;$i<$qtdFixo;$i++) {
            MySqlDAO::getInstance()->deletarVendedor(($i+1));
        }
        $end = microtime(true);
        $mysqldeletarVendedores = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }
    ################################## - MYSQL - ################################################




    ################################## - ORACLE - ################################################

    //EVENTOS INSERIR TABELAS ORACLE
    if(array_key_exists('oracleinserirtblvendedor',$_POST)){
        $start = microtime(true);
        OracleDAO::getInstance()->criarTabelaVendedor();
        $end = microtime(true);
        $oraclecriarTabelaVendedor = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }
    if(array_key_exists('oracleinserirtblcliente',$_POST)){
        $start = microtime(true);
        OracleDAO::getInstance()->criarTabelaCliente();
        $end = microtime(true);
        $oraclecriarTabelaCliente = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }


    //EVENTOS INSERÇÃO DE DADOS ORACLE
    if(array_key_exists('oracleinserirclientes',$_POST)){
        global $qtdFixo;
        $utilitarios = new Utilitarios();
        $listaClientes = $utilitarios->instanciarClientes($qtdFixo);
        echo "<h2>Instancias de Clientes Criadas</h2>";
        $start = microtime(true);
        for($i=0;$i<sizeof($listaClientes);$i++) {
            OracleDAO::getInstance()->inserirCliente($listaClientes[$i]->getNome());
        }
        $end = microtime(true);
        $oracleinserirCliente = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }
    if(array_key_exists('oracleinserirvendedores',$_POST)){
        global $qtdFixo;
        $utilitarios = new Utilitarios();
        $listaVendedores = $utilitarios->instanciarVendedores($qtdFixo);
        echo "<h2>Instancias de Vendedores Criadas</h2>";
        $start = microtime(true);
        for($i=0;$i<sizeof($listaVendedores);$i++) {
            OracleDAO::getInstance()->inserirVendedor($listaVendedores[$i]->getNome(),1);
        }
        $end = microtime(true);
        $oracleinserirVendedor = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }


    //EVENTOS DE ATUALIZAÇÃO DE DADOS ORACLE
    if(array_key_exists('oracleatualizarvendedores',$_POST)){
        $start = microtime(true);
        for($i=0;$i<$qtdFixo;$i++) {
            OracleDAO::getInstance()->atualizarVendedor(($i+1),"VENDEDOR".($i+1));
            echo 'Passou Aqui';
            echo "<br>";
        }
        $end = microtime(true);
    }
    if(array_key_exists('oracleatualizarclientes',$_POST)){
        $start = microtime(true);
        for($i=0;$i<$qtdFixo;$i++) {
            OracleDAO::getInstance()->atualizarCliente(($i+1),"Charles".($i+1));
        }
        $end = microtime(true);
        $oracleatualizarCliente = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }

    //EVENTOS DE SELEÇÃO
    if(array_key_exists('oracleselecionarvendedores',$_POST)){
        $start = microtime(true);
        $lista = OracleDAO::getInstance()->selecionarvendedores();
        $end = microtime(true);
        /* foreach ($lista as $vendedor) {
            echo $vendedor['NOME'];
            echo "<br>";
        } */
        $oracleselecionarVendedores = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }
    if(array_key_exists('oracleselecionarclientes',$_POST)){
        $start = microtime(true);
        $lista = OracleDAO::getInstance()->selecionarclientes();
        $end = microtime(true);
        /* foreach ($lista as $cliente) {
            echo $cliente['NOME'];
            echo "<br>";
        } */
        $oracleselecionarClientes = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }
    if(array_key_exists('oracleselecionarvendedoresclientes',$_POST)){
        $start = microtime(true);
        $lista = OracleDAO::getInstance()->selecionarVendedoresClientes();
        $end = microtime(true);
        echo "<h2> ".$qtdFixo." dados buscados em ".(($start - $end)*-1)."Segundos.</h2>";
        /* foreach ($lista as $cliente) {
            echo "VENDEDOR: - ".$cliente['NOMEVENDEDOR']." ### "."CLIENTE: - ".$cliente['NOMECLIENTE'];
            echo "<br>";
        } */
        $oracleselecionarVendedorCliente = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }

    //EVENTOS DE DELEÇÃO
    if(array_key_exists('oracledeletarclientes',$_POST)){
        $start = microtime(true);
        for($i=0;$i<$qtdFixo;$i++) {
            OracleDAO::getInstance()->deletarCliente(($i+1));
        }
        $lista = 
        $end = microtime(true);
        $oracledeletarClientes= (($start - $end)*-1);
        salvarValoresTesteFixo();
    }
    if(array_key_exists('oracledeletarvendedor',$_POST)){
        $start = microtime(true);
        for($i=0;$i<$qtdFixo;$i++) {
            OracleDAO::getInstance()->deletarVendedor(($i+1));
        }
        $end = microtime(true);
        $oracledeletarVendedores = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }

    //EVENTOS DE DELETAR TABELAS ORACLE
    if(array_key_exists('oracledeletartblvendedor',$_POST)){
        $start = microtime(true);
        OracleDAO::getInstance()->deletarTabelaVendedor();
        $end = microtime(true);
        $oracledeletarTabelaVendedor = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }
    if(array_key_exists('oracledeletartblcliente',$_POST)){
        $start = microtime(true);
        OracleDAO::getInstance()->deletarTabelaCliente();
        $end = microtime(true);
        $oracledeletarTabelaCliente = (($start - $end)*-1);
        salvarValoresTesteFixo();
    }
    
    ################################## - ORACLE - ################################################
    
    
    ##################################### - TESTE DE STRESS - ######################################

    #MYSQL MYSQL MYSQL MYSQL MYSQL MYSQL MYSQL MYSQL MYSQL MYSQL 
    if(array_key_exists('mysqlteste',$_POST)){
        global $mysqlcriardeletar;
        global $mysqlInserir;
        global $mysqlSelecionar;
        global $mysqlDeletarRegistros;

        if(isset($_POST['mysqlquantidade'])){
            $quantidade = $_POST['mysqlquantidade'];
    
            MySqlDAO::getInstance()->criarTabelaTeste();
            
            $start = microtime(true);
            for($i=0;$i<$quantidade;$i++){
                MySqlDAO::getInstance()->inserirRegistroTeste();
            }
            $end = microtime(true);
            $mysqlInserir = (($start - $end)*-1);
            
            $start = microtime(true);
            MySqlDAO::getInstance()->selecionarRegistrosTeste();
            $end = microtime(true);
            $mysqlSelecionar = (($start - $end)*-1);
    
            $start = microtime(true);
            MySqlDAO::getInstance()->deletarRegistrosTeste();
            $end = microtime(true);
            $mysqlDeletarRegistros = (($start - $end)*-1);
    
            MySqlDAO::getInstance()->deletarTabelaTeste();
            
            $start = microtime(true);
            for($i=0;$i<$quantidade;$i++){
                MySqlDAO::getInstance()->criarTabelaTeste();
                MySqlDAO::getInstance()->deletarTabelaTeste();
            }
            $end = microtime(true);
            $mysqlCriarDeletar = (($start - $end)*-1);
        }
        salvarValoresTesteStress();

    }

    #ORACLE ORACLE ORACLE ORACLE ORACLE ORACLE ORACLE 
    if(array_key_exists('oracleteste',$_POST)){
        global $oraclecriardeletar;
        global $oracleInserir;
        global $oracleSelecionar;
        global $oracleDeletarRegistros;

        if(isset($_POST['oraclequantidade'])){
            $quantidade = $_POST['oraclequantidade'];
    
            OracleDAO::getInstance()->criarTabelaTeste();
            
            $start = microtime(true);
            for($i=0;$i<$quantidade;$i++){
                OracleDAO::getInstance()->inserirRegistroTeste();
            }
            $end = microtime(true);
            $oracleInserir = (($start - $end)*-1);
            
            $start = microtime(true);
            OracleDAO::getInstance()->selecionarRegistrosTeste();
            $end = microtime(true);
            $oracleSelecionar = (($start - $end)*-1);
    
            $start = microtime(true);
            OracleDAO::getInstance()->deletarRegistrosTeste();
            $end = microtime(true);
            $oracleDeletarRegistros = (($start - $end)*-1);
    
            OracleDAO::getInstance()->deletarTabelaTeste();
            
            $start = microtime(true);
            for($i=0;$i<$quantidade;$i++){
                OracleDAO::getInstance()->criarTabelaTeste();
                OracleDAO::getInstance()->deletarTabelaTeste();
            }
            $end = microtime(true);
            $oracleCriarDeletar = (($start - $end)*-1);
        }
        salvarValoresTesteStress();

    }
    
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Testes DBS</title>
</head>
<body>
    
    <div class="container">
        <h1 class="text-center">Teste Detalhado <?php echo $qtdFixo?> Registros</h1>
        <form method="post">
            <input class="btn-lg" type="submit" name="zerar" value="ZERAR TUDO">
        </form>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mysql-content">
                <h1 class="text-center">MY SQL</h1>
                <form method="post">
                    <!--CRIA AS TABELAS-->
                    <h2>Criar tabela cliente</h2>
                    <?php echo $mysqlcriarTabelaCliente?>
                    <input type="submit" name="inserirtblcliente" value="criar">
                    <h2>Criar tabela vendedor</h2>
                    <?php echo $mysqlcriarTabelaVendedor?>
                    <input type="submit" name="inserirtblvendedor" value="criar">
                    
                    
                    <!--INSERIR DADOS-->
                    <h2>Inserir Clientes</h2>
                    <?php echo $mysqlinserirCliente?>
                    <input type="submit" name="inserirclientes" value="Inserir Clientes">
                    <h2>Inserir Vendedores</h2> 
                    <?php echo $mysqlinserirVendedor?>
                    <input type="submit" name="inserirvendedores" value="Inserir Vendedores">(inserir clientes antes)
                    
                    
                    <!--ATUALIZAR DADOS-->
                    <h2>Atualizar Clientes</h2> 
                    <?php echo $mysqlatualizarCliente?> 
                    <input type="submit" name="atualizarclientes" value="Atualizar Clientes">(inserir Clientes antes)
                    <!--
                        <h2>Atualizar Vendedores</h2> 
                        <input type="submit" name="atualizarvendedores" value="Atualizar Vendedores">(inserir Vendedores antes)
                    -->
                    
                    <!--SELECIONAR DADOS-->
                    <h2>Selecionar Clientes</h2> 
                    <?php echo $mysqlselecionarClientes?>
                    <input type="submit" name="selecionarclientes" value="Selecionar Cliente">
                    <h2>Selecionar Vendedores</h2> 
                    <?php echo $mysqlselecionarVendedores?>
                    <input type="submit" name="selecionarvendedores" value="Selecionar Vendedores">
                    <h2>Selecionar Vendedores e seu cliente</h2>
                    <?php echo $mysqlselecionarVendedorCliente?>
                    <input type="submit" name="selecionarvendedoresclientes" value="Selecionar">
                    
                    
                    <!-- DELETAR REGISTROS -->
                    <h2>Deletar Clientes</h2>
                    <?php echo $mysqldeletarClientes?>
                    <input type="submit" name="deletarclientes" value="Deletar Clientes">
                    <h2>Deletar Vendedor</h2>
                    <?php echo $mysqldeletarVendedores?>
                    <input type="submit" name="deletarvendedor" value="Deletar Vendedor">
                    
                    
                    <!--DELETA AS TABELAS-->
                    <h2>Deletar tabela vendedor</h2>
                    <?php echo $mysqldeletarTabelaVendedor?>
                    <input type="submit" name="deletartblvendedor" value="deletar">
                    <h2>Deletar tabela cliente</h2>
                    <?php echo $mysqldeletarTabelaCliente?>
                    <input type="submit" name="deletartblcliente" value="deletar">
                    
                </form>
            </div>
            
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 oracle-content">
                <form method="post">
                    <h1 class="text-center">ORACLE</h1>
                    <h2>Criar tabela Cliente</h2>
                    <?php echo $oraclecriarTabelaCliente?>
                    <input type="submit" name="oracleinserirtblcliente" value="criar">
                    <h2>Criar tabela vendedor</h2>
                    <?php echo $oraclecriarTabelaVendedor?>
                    <input type="submit" name="oracleinserirtblvendedor" value="criar">
                    
                    <!--INSERIR DADOS-->
                    <h2>Inserir Clientes</h2>
                    <?php echo $oracleinserirCliente?>
                    <input type="submit" name="oracleinserirclientes" value="Inserir Clientes">
                    <h2>Inserir Vendedores</h2> 
                    <?php echo $oracleinserirVendedor?>
                    <input type="submit" name="oracleinserirvendedores" value="Inserir Vendedores">(inserir clientes antes)
                    
                    <!--ATUALIZAR DADOS-->
                    <!--
                        <h2>Atualizar Vendedores</h2> 
                        <input type="submit" name="oracleatualizarvendedores" value="Atualizar Vendedores">(inserir Vendedores antes)
                    -->
                    <h2>Atualizar Clientes</h2>
                    <?php echo $oracleatualizarCliente?>
                    <input type="submit" name="oracleatualizarclientes" value="Atualizar Clientes">(inserir Clientes antes)
                    
                    <!--SELECIONAR DADOS-->
                    <h2>Selecionar Clientes</h2> 
                    <?php echo $oracleselecionarClientes?>
                    <input type="submit" name="oracleselecionarclientes" value="Selecionar Cliente">
                    <h2>Selecionar Vendedores</h2> 
                    <?php echo $oracleselecionarVendedores?>
                    <input type="submit" name="oracleselecionarvendedores" value="Selecionar Vendedores">
                    <h2>Selecionar Vendedores e seu cliente</h2>
                    <?php echo $oracleselecionarVendedorCliente?>
                    <input type="submit" name="oracleselecionarvendedoresclientes" value="Selecionar">
                    
                    <!--DELEAÇÃO DE REGISTROS-->
                    <h2>Deletar Clientes</h2>
                    <?php echo $oracledeletarClientes?>
                    <input type="submit" name="oracledeletarclientes" value="Deletar Clientes">
                    <h2>Deletar Vendedor</h2>
                    <?php echo $oracledeletarVendedores?>
                    <input type="submit" name="oracledeletarvendedor" value="Deletar Vendedor">
                    
                    <!--DELETA AS TABELAS-->
                    <h2>Deletar tabela vendedor</h2>
                    <?php echo $oracledeletarTabelaVendedor?>
                    <input type="submit" name="oracledeletartblvendedor" value="deletar">
                    <h2>Deletar tabela cliente</h2>
                    <?php echo $oracledeletarTabelaCliente?>
                    <input type="submit" name="oracledeletartblcliente" value="deletar">
                </form>
            </div> 
        </div>
    </div>

    <div class="container">
        <h1 class="text-center">Teste de stress</h1>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <h2>ORACLE</h2>
                <form method="post">
                <input type="number" name="oraclequantidade" placeholder="Quantidade">
                    <h2>Criaçao Deleçao Tabelas</h2>
                    <p><?php echo $oracleCriarDeletar?> segundos</p>
                    <h2>Inserção de Registros</h2>
                    <p><?php echo $oracleInserir?> segundos</p>
                    <h2>Seleção de Registros</h2>
                    <p><?php echo $oracleSelecionar?> segundos</p>
                    <h2>Deleção de Registros</h2>
                    <p><?php echo $oracleDeletarRegistros?> segundos</p>
                    <input type="submit" name="oracleteste"value="Testar">
                </form>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <h2>MYSQL</h2>
                <form method="post">
                    <input type="number" name="mysqlquantidade" placeholder="Quantidade">
                    <h2>Criaçao Deleçao Tabelas</h2>
                    <p><?php echo $mysqlCriarDeletar?> segundos</p>
                    <h2>Inserção de Registros</h2>
                    <p><?php echo $mysqlInserir?> segundos</p>
                    <h2>Seleção de Registros</h2>
                    <p><?php echo $mysqlSelecionar?> segundos</p>
                    <h2>Deleção de Registros</h2>
                    <p><?php echo $mysqlDeletarRegistros?> segundos</p>
                    <input type="submit" name="mysqlteste"value="Testar">
                </form>
            </div>
            
        </div>
    </div>
    <div>
    </div>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" integrity="sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl" crossorigin="anonymous"></script>
</body>
</html>