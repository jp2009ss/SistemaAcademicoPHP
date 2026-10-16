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
    <meta charset="UTF-8">
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
</body>
</html>