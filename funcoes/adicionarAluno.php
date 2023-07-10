<!-- Cadastro de alunos no banco de dados -->
<!DOCTYPE html>
<html lang="pt-br">
<body>
    <?php 
        include("conexao.php");

        $nome = $_POST["nome"];
        $CPF = $_POST["CPF"];
        $nascimento = $_POST["nascimento"];
        $url = $_POST["url"];

        try {
            $stmt = $conn->prepare("INSERT INTO alunos (nome, CPF, nascimento) VALUES (:nome, :CPF, :nascimento)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':CPF', $CPF);
            $stmt->bindParam(':nascimento', $nascimento);
            $stmt->execute();

            $nome = "nome=".$_POST["nome"];
            $CPF = "CPF=".$_POST["CPF"];
            
            header('location:'. $url.$nome."&".$CPF);
        } catch (PDOException $e) {
            echo "<h1>Erro!</h1>";
            echo "<p>{$nome}, seu cadastro NÃO foi efetuado.</p>";
            echo "<p>Erro: " . $e->getMessage() . "</p>";
        }
    ?>
</body>
</html>


