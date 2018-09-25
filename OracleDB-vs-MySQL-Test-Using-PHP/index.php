<?php
require_once "classes/Conexao.php";
require_once "classes/Usuario.php";
require_once "dao/UsuarioDAO.php";

set_time_limit(0);

function insertData(){
    $start = microtime(true);
    for($i=0;$i<3000;$i++){
        $usuario = new Usuario();
        $usuario->setNome("Usuario".$i);
        UsuarioDAO::getInstance()->inserir($usuario);
    }
    $end = microtime(true);
    echo "<h1>Esta operação levou".($start - $end)."Segundos.</h1>";
}



if(array_key_exists('test',$_POST)){
    insertData();
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <h1><?php echo "Page Is Working."?></h1>
    <form method="post">
        <input type="submit" name="test" id="button" value="inserir">
    </form>

    <a href="testes.php">Ir Para Testes</a>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" integrity="sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl" crossorigin="anonymous"></script>
</body>
</html>