<?php

require("conexao.php");

// ATUALIZAR
if (isset($_POST['atualizar'])) {
    $idMatricula = (int) $_POST['idMatricula'];
    $nome        = mysqli_real_escape_string($conexao, $_POST['nome']);
    $curso       = mysqli_real_escape_string($conexao, $_POST['curso']);

    $atualizar = "UPDATE matricula SET nome = '$nome', curso = '$curso' WHERE idMatricula = $idMatricula";

    if (mysqli_query($conexao, $atualizar)) {
        echo "
        <script>
            alert('Dados atualizados com sucesso');
            window.location='atualizarCurso.php';
        </script>";
        exit();
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conexao);
    }
}

// BUSCAR ALUNO PARA EDITAR
$editaAluno = null;

if (isset($_GET['editar'])) {
    $idEditar = (int) $_GET['editar'];

    $resultado = mysqli_query(
        $conexao,
        "SELECT * FROM matricula WHERE idMatricula = $idEditar"
    );

    $editaAluno = mysqli_fetch_assoc($resultado);
}

// APAGAR
if (isset($_GET['apagar'])) {
    $idApagar = (int) $_GET['apagar'];

    $deletar = "DELETE FROM matricula WHERE idMatricula = $idApagar";

    if (mysqli_query($conexao, $deletar)) {
        echo "
        <script>
            alert('Dado excluído com sucesso!');
            window.location='atualizarCurso.php';
        </script>";
        exit();
    } else {
        echo "Erro ao deletar: " . mysqli_error($conexao);
    }
}

// LISTAR ALUNOS
$alunos = mysqli_query($conexao, "SELECT * FROM matricula");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Barra de Navegação -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="">Sistema Acadêmico</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro.php">Cadastrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="atualizarCurso.php">Atualizar Cadastro</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h2>Lista de Alunos</h2>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Curso</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($aluno = mysqli_fetch_assoc($alunos)): ?>
                <tr>
                    <td><?= $aluno['idMatricula'] ?></td>
                    <td><?= htmlspecialchars($aluno['nome']) ?></td>
                    <td><?= htmlspecialchars($aluno['curso']) ?></td>
                    <td>
                        <a href="?editar=<?= $aluno['idMatricula'] ?>" class="btn btn-editar">Editar</a>
                    </td>
                    <td>
                        <a href="?apagar=<?= $aluno['idMatricula'] ?>"
                           class="btn btn-apagar"
                           onclick="return confirm('Deseja realmente apagar este aluno?');">Apagar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php if ($editaAluno): ?>
        <h3>Editar Aluno</h3>

        <form method="POST">
            <input type="hidden" name="idMatricula"
                value="<?= $editaAluno['idMatricula'] ?>">

            <label>Nome: </label>
            <input type="text" name="nome"
                value="<?= htmlspecialchars($editaAluno['nome']) ?>">

            <label>Curso: </label>
            <input type="text" name="curso"
                value="<?= htmlspecialchars($editaAluno['curso']) ?>">

            <button type="submit" name="atualizar">Atualizar</button>
            <a href="atualizarCurso.php">Cancelar</a>
        </form>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>