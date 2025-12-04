<?php
session_start();
include('conexao.php');

// Validação dos campos obrigatórios
$campos = ['id', 'nome','nascimento','rua','numero','bairro','cep','cidade','responsavel','tipo_responsavel','curso'];

foreach ($campos as $campo) {
    if (empty($_POST[$campo])) {
        $_SESSION['mensagem'] = "Preencha todos os campos!";
        header('Location: telacadastro.php');
        exit();
    }
}

// Coletando dados
$id  = mysqli_real_escape_string($conexao, $_POST['id']);
$nome  = mysqli_real_escape_string($conexao, $_POST['nome']);
$nascimento = $_POST['nascimento'];
$rua = mysqli_real_escape_string($conexao, $_POST['rua']);
$numero = mysqli_real_escape_string($conexao, $_POST['numero']);
$bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
$cep = mysqli_real_escape_string($conexao, $_POST['cep']);
$cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
$responsavel = mysqli_real_escape_string($conexao, $_POST['responsavel']);
$tipo_responsavel = mysqli_real_escape_string($conexao, $_POST['tipo_responsavel']);
$curso = mysqli_real_escape_string($conexao, $_POST['curso']);

// INSERT
$sql = "INSERT INTO alunos 
(id, nome, nascimento, rua, numero, bairro, cep, responsavel, tipo_responsavel, curso, cidade)
VALUES 
('$id', '$nome', '$nascimento', '$rua', '$numero', '$bairro', '$cep', '$responsavel', '$tipo_responsavel', '$curso', '$cidade')";

if (mysqli_query($conexao, $sql)) {
    $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
    header('Location: painel.php');
    exit();
} else {
    $_SESSION['mensagem'] = "Erro ao cadastrar: " . mysqli_error($conexao);
    header('Location: telacadastro.php');
    exit();
}
?>
