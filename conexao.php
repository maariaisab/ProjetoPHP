<?php
define('HOST', 'localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'loginphp');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB);

if (!$conexao) {
    die('Erro ao conectar ao banco: ' . mysqli_connect_error());
}
?>

