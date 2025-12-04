<?php
session_start();
include('conexao.php');
include('navbar.php');

$busca = isset($_GET['buscar']) ? mysqli_real_escape_string($conexao, $_GET['buscar']) : "";
$filtro_curso = isset($_GET['curso']) ? mysqli_real_escape_string($conexao, $_GET['curso']) : "";
$filtro_cidade = isset($_GET['cidade']) ? mysqli_real_escape_string($conexao, $_GET['cidade']) : "";

$sql = "SELECT id, nome, cidade, curso FROM alunos WHERE 1=1";

if ($busca != "") {
    $sql .= " AND (nome LIKE '%$busca%' 
            OR cidade LIKE '%$busca%'
            OR curso LIKE '%$busca%')";
}

if ($filtro_curso != "") {
    $sql .= " AND curso = '$filtro_curso'";
}

if ($filtro_cidade != "") {
    $sql .= " AND cidade = '$filtro_cidade'";
}

$result = mysqli_query($conexao, $sql);

$cursos = mysqli_query($conexao, "SELECT DISTINCT curso FROM alunos");
$cidades = mysqli_query($conexao, "SELECT DISTINCT cidade FROM alunos");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Alunos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #ffffff !important; }

        .navbar { background-color: #8a2be2 !important; }
        .navbar a { color: white !important; font-weight: 400; }
        .navbar a:hover { opacity: .8; }

        h2 { text-align: center; margin-top: 40px; margin-bottom: 25px; font-weight: 600; }

        .table thead {
            background-color: #8a2be2;
            color: white;
            font-weight: bold;
        }
        .table tbody tr:hover { background-color: #f2e6ff; }

        .btn-roxo { background-color: #8a2be2; color: white; border: none; }
        .btn-roxo:hover { background-color: #6a0dad; }

        .box {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
    </style>

</head>
<body>

<div class="box mt-4">

    <h2>Lista de Alunos</h2>

  
    <form method="GET" class="row g-2 mb-3">


        <div class="col-md-4">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar aluno..."
                   value="<?= $busca ?>">
        </div>

        <div class="col-md-3">
            <select name="curso" class="form-select">
                <option value="">Filtrar por curso</option>
                <?php while($c = mysqli_fetch_assoc($cursos)): ?>
                    <option value="<?= $c['curso'] ?>" 
                        <?= ($filtro_curso == $c['curso']) ? "selected" : "" ?>>
                        <?= $c['curso'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>


        <div class="col-md-3">
            <select name="cidade" class="form-select">
                <option value="">Filtrar por cidade</option>
                <?php while($cid = mysqli_fetch_assoc($cidades)): ?>
                    <option value="<?= $cid['cidade'] ?>" 
                        <?= ($filtro_cidade == $cid['cidade']) ? "selected" : "" ?>>
                        <?= $cid['cidade'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="col-md-2 d-flex gap-2">
            <button class="btn btn-roxo w-50">Buscar</button>

            <a href="tela_alunos.php" class="btn btn-secondary w-50">Limpar</a>
        </div>

    </form>


    <?php if (mysqli_num_rows($result) > 0): ?>
    
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cidade</th>
                <th>Curso</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php while($aluno = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $aluno['id'] ?></td>
                <td><?= $aluno['nome'] ?></td>
                <td><?= $aluno['cidade'] ?></td>
                <td><?= $aluno['curso'] ?></td>

                <td>
                    <a href="editar.php?id=<?= $aluno['id'] ?>" class="btn btn-roxo btn-sm">Editar</a>
                    <a href="excluir.php?id=<?= $aluno['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php else: ?>

        <div class="alert alert-warning text-center mt-4">
            Nenhum aluno encontrado com esses critérios.
        </div>

    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
