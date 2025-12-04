<?php
session_start();
include('conexao.php');
include('navbar.php');

if (!isset($_GET['id'])) {
    $_SESSION['mensagem'] = "ID não informado!";
    header("Location: tela_alunos.php");
    exit();
}

$id = intval($_GET['id']);

$sql = "SELECT nome FROM alunos WHERE id = $id";
$result = mysqli_query($conexao, $sql);
$aluno = mysqli_fetch_assoc($result);


if (!$aluno) {
    $_SESSION['mensagem'] = "Aluno não encontrado!";
    header("Location: tela_alunos.php");
    exit();
}

if (isset($_POST['confirmar'])) {

    $delete = "DELETE FROM alunos WHERE id = $id";

    if (mysqli_query($conexao, $delete)) {
        $_SESSION['mensagem'] = "Aluno excluído com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Erro ao excluir!";
    }

    header("Location: tela_alunos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Aluno</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #ffffff !important; /* FUNDO BRANCO */
        }

        .navbar {
            background-color: #6a0dad !important; /* ROXO */
        }
        .navbar a, .navbar-brand {
            color: #fff !important;
        }

        .box {
            max-width: 500px;
            margin: 60px auto;
            padding: 25px;
            border-radius: 12px;
            border: 2px solid #6a0dad;
            background: #ffffff;
            text-align: center;
        }

        .btn-roxo {
            background-color: #6a0dad;
            color: #fff;
            border: none;
            margin-right: 10px;
        }
        .btn-roxo:hover {
            background-color: #520a9e;
            color: #fff;
        }

        .btn-cancelar {
            background-color: #ccc;
            border: none;
        }
        .btn-cancelar:hover {
            background-color: #b5b5b5;
        }
    </style>
</head>

<body>

<div class="box">
    <h3>Excluir Aluno</h3>
    <p>Tem certeza que deseja excluir o aluno:</p>
    <h4><strong><?php echo $aluno['nome']; ?></strong></h4>

    <form method="POST">
        <button type="submit" name="confirmar" class="btn btn-roxo">Excluir</button>
        <a href="index.php" class="btn btn-cancelar">Cancelar</a>
    </form>
</div>

</body>
</html>
