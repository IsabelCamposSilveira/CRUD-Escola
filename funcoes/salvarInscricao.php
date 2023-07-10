<!-- Cadastro de alunos no banco de dados -->
<!DOCTYPE html>
<html lang="pt-br">
<body>
    <?php 
        include("conexao.php");

        $idAluno = $_POST["idAluno"];
        $idCurso = $_POST["curso"];
        $idSemestre = $_POST["Semestre"];
        $url = $_POST["url"];
        $nomeAluno = "nome=".$_POST["nome"];
        $CPF = "CPF=".$_POST["CPF"];

        try {
            $stmt = $conn->prepare("INSERT INTO inscricao (idAluno, idCurso, semestreIngresso) VALUES (:idAluno, :idCurso, :idSemestre)");
            $stmt->bindParam(':idAluno', $idAluno);
            $stmt->bindParam(':idCurso', $idCurso);
            $stmt->bindParam(':idSemestre', $idSemestre);
            $stmt->execute();
            
            header('location: '. $url.$nomeAluno. "&" .$CPF);
        } catch (PDOException $e) {
            echo "<h1>Erro!</h1>";
            echo "<p>{$nome}, seu cadastro NÃO foi efetuado.</p>";
            echo "<p>Erro: " . $e->getMessage() . "</p>";
        }
    ?>
</body>
</html>