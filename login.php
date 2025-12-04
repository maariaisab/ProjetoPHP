<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    if (empty($email) || empty($senha)) {
        $_SESSION['erro'] = "Preencha todos os campos!";
        header("Location: index.php");
        exit();
    }

    $query = "SELECT user_id, user_email FROM users WHERE user_email = '$email' AND user_password = MD5('$senha')";
    $result = mysqli_query($conexao, $query);

    if (!$result) {
        die("Erro na consulta: " . mysqli_error($conexao));
    }

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['id']    = $user['user_id'];
        $_SESSION['email'] = $user['user_email'];
        header("Location: painel.php");
        exit();
    } else {
        $_SESSION['nao_autenticado'] = true;
        header("Location: index.php");
        exit();
    }
}
?>
