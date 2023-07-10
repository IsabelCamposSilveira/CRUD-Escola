<!-- Edição dos registros de Alunos -->
<?php 
    include_once("conexao.php");

    $idAluno = $_POST["idAluno"];
    $nome = $_POST["nome"]; 
    $CPF = $_POST["CPF"];
    $nascimento = $_POST["nascimento"]; 
    $url = $_POST["url"]; 

    $sql = "UPDATE alunos 
            SET nome = :nome,
            CPF = :CPF,
            nascimento = :nascimento,
            idAluno = :idAluno
            WHERE idAluno = :idAluno";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idAluno', $idAluno);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':CPF', $CPF);
        $stmt->bindParam(':nascimento', $nascimento);;
        $stmt->execute();
    
        header('Location:'.$url . "nome=" . $nome. "&&CPF=". $CPF. "&editar=1");
        
    } catch (PDOException $e) {
        echo "Erro ao atualizar a idAluno: " . $idAluno;
        echo "<p>Erro: " . $e->getMessage() . "</p>";
    }

?>