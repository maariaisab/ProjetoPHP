<?php
session_start();
include('conexao.php');

$id = $_POST['id'];

$nome = $_POST['nome'];
$nascimento = $_POST['nascimento'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cep = $_POST['cep'];
$cidade = $_POST['cidade'];
$responsavel = $_POST['responsavel'];
$tipo_responsavel = $_POST['tipo_responsavel'];
$curso = $_POST['curso'];

$sql = "UPDATE alunos SET 
        nome='$nome',
        nascimento='$nascimento',
        rua='$rua',
        numero='$numero',
        bairro='$bairro',
        cep='$cep',
        cidade='$cidade',
        responsavel='$responsavel',
        tipo_responsavel='$tipo_responsavel',
        curso='$curso'
        WHERE id = $id";

if (mysqli_query($conexao, $sql)) {
    $_SESSION['mensagem'] = "Atualizado com sucesso!";
    header("Location: tela_alunos.php");
} else {
    $_SESSION['mensagem'] = "Erro ao atualizar!";
    header("Location: editar.php?id=$id");
}
