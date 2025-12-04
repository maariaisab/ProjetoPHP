<?php
session_start();
include('conexao.php');
include('navbar.php'); 

if (!isset($_GET['id'])) {
    $_SESSION['mensagem'] = "Aluno não encontrado!";
    header("Location: tela_alunos.php");
    exit();
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM alunos WHERE id = $id";
$result = mysqli_query($conexao, $sql);
$aluno = mysqli_fetch_assoc($result);

if (!$aluno) {
    $_SESSION['mensagem'] = "Aluno não existe!";
    header("Location: tela_alunos.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Editar Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #fff !important;
        }

        .btn-primary {
            background-color: #6a0dad;
            border-color: #6a0dad;
        }

        .btn-primary:hover {
            background-color: #500b9c;
            border-color: #500b9c;
        }

        .card {
            border-radius: 15px;
        }

        .card-title {
            color: #6a0dad;
        }
    </style>
</head>

<body>

<section class="h-100 mt-4">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-6 col-xl-7 col-lg-7 col-md-8 col-sm-10">

                <div class="card shadow-lg">
                    <div class="card-body p-5">

                        <h1 class="fs-4 card-title fw-bold mb-4">Editar Aluno</h1>

                        <form action="editar_salvar.php" method="POST">
                     
                            <input type="hidden" name="id" value="<?= $aluno['id'] ?>">

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control" name="nome" value="<?= $aluno['nome'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Data de Nascimento</label>
                                    <input type="date" class="form-control" name="nascimento" value="<?= $aluno['nascimento'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Rua</label>
                                    <input type="text" class="form-control" name="rua" value="<?= $aluno['rua'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Número</label>
                                    <input type="text" class="form-control" name="numero" value="<?= $aluno['numero'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Bairro</label>
                                    <input type="text" class="form-control" name="bairro" value="<?= $aluno['bairro'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">CEP</label>
                                    <input type="text" class="form-control" name="cep" value="<?= $aluno['cep'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Cidade</label>
                                    <input type="text" class="form-control" name="cidade" value="<?= $aluno['cidade'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Nome do Responsável</label>
                                    <input type="text" class="form-control" name="responsavel" value="<?= $aluno['responsavel'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Tipo Responsável</label>
                                    <select class="form-select" name="tipo_responsavel" required>
                                        <option <?= $aluno['tipo_responsavel'] == 'Mãe' ? 'selected' : '' ?>>Mãe</option>
                                        <option <?= $aluno['tipo_responsavel'] == 'Pai' ? 'selected' : '' ?>>Pai</option>
                                        <option <?= $aluno['tipo_responsavel'] == 'Avô/Avó' ? 'selected' : '' ?>>Avô/Avó</option>
                                        <option <?= $aluno['tipo_responsavel'] == 'Tio/Tia' ? 'selected' : '' ?>>Tio/Tia</option>
                                        <option <?= $aluno['tipo_responsavel'] == 'Outro' ? 'selected' : '' ?>>Outro</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Curso</label>
                                    <select class="form-select" name="curso" required>
                                        <option <?= $aluno['curso'] == 'Desenvolvimento de Sistemas' ? 'selected' : '' ?>>Desenvolvimento de Sistemas</option>
                                        <option <?= $aluno['curso'] == 'Enfermagem' ? 'selected' : '' ?>>Enfermagem</option>
                                        <option <?= $aluno['curso'] == 'Informática' ? 'selected' : '' ?>>Informática</option>
                                        <option <?= $aluno['curso'] == 'Administração' ? 'selected' : '' ?>>Administração</option>
                                    </select>
                                </div>

                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-4">Salvar Alterações</button>
                                </div>

                            </div>
                        </form>
                    

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

</body>
</html>
