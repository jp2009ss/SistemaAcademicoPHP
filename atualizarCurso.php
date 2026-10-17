<?php

require("conexao.php");

if(isset($_POST["atualizar"])){
    $idMatricula    = $_POST['idMatricula'];
    $nome           = $_POST['nome'];
    $curso          = $_POST['curso'];

    $atualizar = "UPDATE matricula SET nome='$nome', curso='$curso' WHERE idMatricula='$idMatricula'";

    if(mysqli_query($conexao, $atualizar)){
    echo "<script> alert('Dados atualizados com sucesso!'); window.location='atualizarCurso.php'; </script>";

    exit();

    }else{
        echo "Erro ao atualizar". mysqli_error($conexao);
    }

}

$editaAluno = null;

if(isset($_GET["editar"])){
    $idEditar = $_GET["editar"];

    $resultado = mysqli_query($conexao, "SELECT * FROM matricula WHERE idMatricula='$idEditar'");

   $editaAluno = mysqli_fetch_assoc($resultado);

}

$alunos = mysqli_query($conexao,"SELECT * FROM matricula");

?>

<!-- html -->
<!DOCTYPE html>
<html lang="pt-br">

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
                <th>Id</th>
                <th>Nome</th>
                <th>Curso</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while($aluno = mysqli_fetch_assoc($alunos)): ?>
                <tr>
                    <td><?= $aluno['idMatricula'] ?></td>
                    <td><?= $aluno['nome'] ?></td>
                    <td><?= $aluno['curso'] ?></td>
                    <td><a href="?editar=<?= $aluno["idMatricula"] ?>">Editar</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

<?php if($editaAluno):?>{
    <h3>Editar Aluno</h3>

    <form method = "POST">
        <label for ="">Nome: </label>
        <input type="text" name="nome" value="<?= $editaAluno['nome'] ?>"><br><br>

        <label for ="">Curso: </label>
        <input type="text" name="curso" value="<?= $editaAluno['curso'] ?>"><br><br>

        <button type="submit" name="atualizar">Atualizar</button>
        <button href="atualizarCurso.php">Cancelar</button>

    </form>
    <?php endif; ?>


}

</body>
</html>