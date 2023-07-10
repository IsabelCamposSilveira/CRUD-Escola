<!-- Cadastro de alunos no banco de dados -->
<!DOCTYPE html>
<html lang="pt-br">
<body>
    <?php 
        include("conexao.php");
        $nome = $_POST["nome"];
        $duracaoSemestres = $_POST["semestre"];

        try {
            $stmt = $conn->prepare("INSERT INTO cursos (nome, duracaoSemestres) VALUES (:nome, :duracaoSemestres)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':duracaoSemestres', $duracaoSemestres);
            $stmt->execute();
            
            header('location: ../cursos/todosCursos.php');
        } catch (PDOException $e) {
            echo "<h1>Erro!</h1>";
            echo "<p>{$nome}, seu cadastro NÃO foi efetuado.</p>";
            echo "<p>Erro: " . $e->getMessage() . "</p>";
        }
    ?>
</body>
</html>