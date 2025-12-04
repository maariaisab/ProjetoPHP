<?php
session_start();
include('navbar.php');
include('conexao.php');

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Cadastro de Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="text-center my-5">
                    <img src="Design sem nome.png" alt="logo" width="150">
                </div>
                <div class="card shadow-lg">
                    <div class="card-body p-5">

                        <h1 class="fs-4 card-title fw-bold mb-4">Cadastro</h1>

                        <?php if(isset($_SESSION['mensagem'])): ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <?= $_SESSION['mensagem']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php unset($_SESSION['mensagem']); endif; ?>

                        <!-- FORM COMEÇA AQUI -->
                        <form action="alunos.php" method="POST">
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control" name="nome" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Data de Nascimento</label>
                                    <input type="date" class="form-control" name="nascimento" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Rua</label>
                                    <input type="text" class="form-control" name="rua" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Número</label>
                                    <input type="text" class="form-control" name="numero" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Bairro</label>
                                    <input type="text" class="form-control" name="bairro" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">CEP</label>
                                    <input type="text" class="form-control" name="cep" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Cidade</label>
                                    <input type="text" class="form-control" name="cidade" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Nome do Responsável</label>
                                    <input type="text" class="form-control" name="responsavel" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Tipo Responsável</label>
                                    <select class="form-select" name="tipo_responsavel" required>
                                        <option disabled selected value="">Selecione...</option>
                                        <option>Mãe</option>
                                        <option>Pai</option>
                                        <option>Avô/Avó</option>
                                        <option>Tio/Tia</option>
                                        <option>Outro</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Curso</label>
                                    <select class="form-select" name="curso" required>
                                        <option disabled selected value="">Selecione o curso</option>
                                        <option>Desenvolvimento de Sistemas</option>
                                        <option>Enfermagem</option>
                                        <option>Informática</option>
                                        <option>Administração</option>
                                    </select>
                                </div>

                                <div class="col-md-6 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                                </div>

                            </div>
                        </form>
                        <!-- FORM TERMINA AQUI -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
