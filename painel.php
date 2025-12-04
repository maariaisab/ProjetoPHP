<?php
session_start();
include('verifica_login.php');
include('conexao.php');
include('navbar.php');

$qtdAlunos = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(*) AS total FROM alunos"))['total'];

function contarCurso($conexao, $nome){
    return mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(*) AS total FROM alunos WHERE curso = '$nome'"))['total'];
}

$cursoInfo = contarCurso($conexao, 'Informática');
$cursoEnf = contarCurso($conexao, 'Enfermagem');
$cursoDS = contarCurso($conexao, 'Desenvolvimento de Sistemas');
$cursoAdm = contarCurso($conexao, 'Administração');

$cursoQuery = mysqli_query($conexao, "SELECT curso, COUNT(*) AS total FROM alunos GROUP BY curso");
$cursos = [];
$cursosQtd = [];
while($row = mysqli_fetch_assoc($cursoQuery)){
    $cursos[] = $row['curso'];
    $cursosQtd[] = $row['total'];
}

$cidadeQuery = mysqli_query($conexao, "SELECT cidade, COUNT(*) AS total FROM alunos GROUP BY cidade");
$cidades = [];
$cidadesQtd = [];
while($row = mysqli_fetch_assoc($cidadeQuery)){
    $cidades[] = $row['cidade'];
    $cidadesQtd[] = $row['total'];
}

$idMediaCursoQuery = mysqli_query($conexao, "
    SELECT curso, AVG(TIMESTAMPDIFF(YEAR, nascimento, CURDATE())) AS media 
    FROM alunos 
    GROUP BY curso
");
$idadeCursos = [];
$idadeValores = [];
while($row = mysqli_fetch_assoc($idMediaCursoQuery)){
    $idadeCursos[] = $row['curso'];
    $idadeValores[] = round($row['media']);
}

$bairroCidadeQuery = mysqli_query($conexao, "
    SELECT cidade, COUNT(DISTINCT bairro) AS total 
    FROM alunos 
    GROUP BY cidade
");
$bcCidades = [];
$bcTotais = [];
while($row = mysqli_fetch_assoc($bairroCidadeQuery)){
    $bcCidades[] = $row['cidade'];
    $bcTotais[] = $row['total'];
}

$cidadeTotal = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(DISTINCT cidade) AS total FROM alunos"))['total'];
$bairroTotal = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(DISTINCT bairro) AS total FROM alunos"))['total'];

$cursoTop = mysqli_fetch_assoc(mysqli_query($conexao, "
    SELECT curso, COUNT(*) AS total 
    FROM alunos 
    GROUP BY curso 
    ORDER BY total DESC 
    LIMIT 1
"))['curso'];

$tabelaQuery = mysqli_query($conexao, "SELECT nome, cidade, bairro, curso FROM alunos ORDER BY nome ASC");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Painel</title>

    <style>
        body {
            background-color: #f5f7fb;
        }
        .card-dashboard {
            background: white;
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            height: 100%;
        }
        .titulo-card {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 6px;
        }
        .valor-card {
            font-size: 34px;
            font-weight: bold;
            color: #a368f0;
        }
        .section-title{
            font-size: 22px;
            font-weight: 700;
            margin-top: 40px;
            margin-bottom: 20px;
            text-align:center;
        }
        .spaced-row {
            margin-bottom: 25px;
        }
        canvas {
            max-height: 250px !important;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="section-title">Visão Geral</div>
    <div class="row g-4 spaced-row">
        <div class="col-md-3"><div class="card-dashboard"><div class="titulo-card">Informática</div><div class="valor-card"><?= $cursoInfo ?></div></div></div>
        <div class="col-md-3"><div class="card-dashboard"><div class="titulo-card">Enfermagem</div><div class="valor-card"><?= $cursoEnf ?></div></div></div>
        <div class="col-md-3"><div class="card-dashboard"><div class="titulo-card">Desenv. Sistemas</div><div class="valor-card"><?= $cursoDS ?></div></div></div>
        <div class="col-md-3"><div class="card-dashboard"><div class="titulo-card">Administração</div><div class="valor-card"><?= $cursoAdm ?></div></div></div>
    </div>

    <div class="section-title">Estatísticas</div>
    <div class="row g-4 spaced-row">
        <div class="col-md-3"><div class="card-dashboard"><div class="titulo-card">Total Alunos</div><div class="valor-card"><?= $qtdAlunos ?></div></div></div>
        <div class="col-md-3"><div class="card-dashboard"><div class="titulo-card">Cidades</div><div class="valor-card"><?= $cidadeTotal ?></div></div></div>
        <div class="col-md-3"><div class="card-dashboard"><div class="titulo-card">Bairros</div><div class="valor-card"><?= $bairroTotal ?></div></div></div>
        <div class="col-md-3"><div class="card-dashboard"><div class="titulo-card">Curso Popular</div><div class="valor-card"><?= $cursoTop ?></div></div></div>
    </div>

    <div class="section-title">Distribuições</div>
    <div class="row g-4 spaced-row">
        <div class="col-md-6"><div class="card-dashboard"><div class="titulo-card">Alunos por Curso</div><canvas id="graficoCurso"></canvas></div></div>
        <div class="col-md-6"><div class="card-dashboard"><div class="titulo-card">Alunos por Cidade</div><canvas id="graficoCidade"></canvas></div></div>
    </div>

    <div class="row g-4 spaced-row">
        <div class="col-md-6"><div class="card-dashboard"><div class="titulo-card">Idade Média por Curso</div><canvas id="graficoIdadeCurso"></canvas></div></div>
        <div class="col-md-6"><div class="card-dashboard"><div class="titulo-card">Bairros por Cidade</div><canvas id="graficoBairroCidade"></canvas></div></div>
    </div>

    <div class="section-title">Relatório Completo</div>
    <div class="row g-4 mb-5">
        <div class="col-12">
            <div class="card-dashboard">
                <table class="table table-bordered table-striped text-center mt-2">
                    <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th>Cidade</th>
                            <th>Bairro</th>
                            <th>Curso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($tabelaQuery)): ?>
                        <tr>
                            <td><?= $row['nome'] ?></td>
                            <td><?= $row['cidade'] ?></td>
                            <td><?= $row['bairro'] ?></td>
                            <td><?= $row['curso'] ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
new Chart(document.getElementById('graficoCurso'), {
    type: 'doughnut',
    data: {
        labels: <?= json_encode($cursos) ?>,
        datasets: [{
            data: <?= json_encode($cursosQtd) ?>,
            backgroundColor: ['#c8a2ff','#a368f0','#7a3bd3','#532097','#39156a']
        }]
    }
});

new Chart(document.getElementById('graficoCidade'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($cidades) ?>,
        datasets: [{
            label: 'Alunos',
            data: <?= json_encode($cidadesQtd) ?>,
            backgroundColor: '#7a3bd3'
        }]
    },
    options: { scales: { y: { beginAtZero: true } } }
});

new Chart(document.getElementById('graficoIdadeCurso'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($idadeCursos) ?>,
        datasets: [{
            label: 'Idade Média',
            data: <?= json_encode($idadeValores) ?>,
            backgroundColor: '#a368f0'
        }]
    },
    options: { scales: { y: { beginAtZero: true } } }
});

new Chart(document.getElementById('graficoBairroCidade'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($bcCidades) ?>,
        datasets: [{
            label: 'Bairros',
            data: <?= json_encode($bcTotais) ?>,
            backgroundColor: '#7a3bd3'
        }]
    },
    options: { scales: { y: { beginAtZero: true } } }
});
</script>

</body>
</html>
