<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Alunos</title>
</head>
<body>

  <!-- Barra de Navegação -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.html">Sistema Acadêmico</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.html">Início</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="cadastro.php">Cadastrar</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="atualizarCurso.php">Atualizar Cadastro</a>
        </li>

        </li>
      </ul>
    </div>
  </div>
</nav>

    


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php

require("conexao.php");

if (isset($_POST['atualizar'])) {
    $idMatricula    = $_POST['idMatricula'];
    $nome           = $_POST['nome'];
    $curso          = $_POST['curso'];

    $atualizar = "UPDATE matricula SET nome = '$nome', curso = '$curso' WHERE idMatricula = '$idMatricula'";

    if (mysqli_query($conexao, $atualizar)) {
        echo "
        <script>
            alert('Dados atualizado com sucesso');
            window.location='atualizarCurso.php';
        </script>";
        exit();
    } else {
        echo "Erro ai atualizar" . mysqli_error($conexao);
    }
}

$editaAluno = null;

if (isset($_GET['editar'])) {

    $idEditar = $_GET['editar'];

    $resultado = mysqli_query(
        $conexao,
        "SELECT * FROM matricula WHERE idMatricula = $idEditar"
    );

    $editaAluno = mysqli_fetch_assoc($resultado);
}

$alunos = mysqli_query(
    $conexao,
    "SELECT * FROM matricula"
);


if(isset($_GET['apagar'])){
    $idMatricula = $_GET['apagar'];

    $deletar = "DELETE FROM matricula WHERE idMatricula = $idMatricula";

    if (mysqli_query($conexao, $deletar)) {
        echo "
        <script>
            alert('Dado excluido com sucesso!');
            window.location='atualizarCurso.php';
        </script>";
        exit();
    } else {
        echo "Erro ao deletar." . mysqli_error($conexao);
    }
}



?>

<!DOCTYPE html>
<html lang="pt-br">
<center>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Alunos</title>
</head>

<body>
    <h2>Lista de Alunos</h2>
    <table class="">
        <thead>
            <tr>
                <th>Id </th>
                <th>Nome </th>
                <th>Curso </th>
                <th>Ações </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($aluno = mysqli_fetch_assoc($alunos)): ?>
                <tr>
                    <td><?= $aluno['idMatricula'] ?></td>
                    <td><?= $aluno['nome'] ?></td>
                    <td><?= $aluno['curso'] ?></td>
                    <td><a href="?editar=<?= $aluno['idMatricula'] ?>" class="btn btn-editar">Editar</a></td>
                    <td><a href="?apagar=<?= $aluno["idMatricula"] ?>" class="btn btn-apagar">Apagar</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php if ($editaAluno): ?>
        <h3>Editar Aluno</h3>

        <form method="POST">
            <input type="hidden" name="idMatricula"
                value="<?= $editaAluno['idMatricula'] ?>">

            <label for="">Nome: </label>
            <input type="text" name="nome"
                value="<?= $editaAluno['nome'] ?>">

            <label for="">Curso: </label>
            <input type="text" name="curso"
                value="<?= $editaAluno['curso'] ?>">

            <button type="submit" name="atualizar">Atualizar</button>
            <a href="atualizarCurso.php">Cancelar</a>
        </form>
    <?php endif; ?>

</body>
</center>
</html>