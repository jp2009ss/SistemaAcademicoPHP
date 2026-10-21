<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Alunos</title>
</head>
<body>

 <!-- Barra de Navegação -->
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
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include "conexao.php";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $curso = $_POST["curso"];
 
    require("conexao.php");
 
    $inserir = "INSERT INTO matricula (nome, curso) VALUES ('$nome', '$curso')";
   
    if (mysqli_query($conexao, $inserir)) {
       
        echo "
        <script>
           
        alert('Cadastro realizado com sucesso: " . mysqli_insert_id($conexao) . "');
        window.location.href = 'cadastro.php';
       
        </script>";
        exit();
    } else {
        echo "
        <script>
           
        alert('Erro ao realizar cadastro: " . mysqli_error($conexao) . "');
        window.history.back();
       
        </script>";
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <center>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Cadastro de Alunos</h2>
 
    <form method="POST" action="">
        <label>Nome: </label>
        <input type="text" name="nome"><br><br>
 
        <label>Curso: </label>
        <input type="text" name="curso"><br><br>
 
        <button type="reset">Limpar</button>
        <button type="submit">Cadastrar</button>
    </form>
    </center>
</body>
</html>

