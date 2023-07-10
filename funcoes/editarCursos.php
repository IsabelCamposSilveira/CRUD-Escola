<!-- Edição dos registros de Alunos -->
<?php 
    include_once("../funcoes/conexao.php");

    $idCurso = $_POST["idCurso"];
    $nome = $_POST["nome"]; 
    $duracaoSemestres = $_POST["duracaoSemestres"];
    $url = $_POST["url"];

    $sql = "UPDATE cursos 
            SET nome = :nome,
            duracaoSemestres = :duracaoSemestres,
            idCurso = :idCurso
            WHERE idCurso = :idCurso";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idCurso', $idCurso);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':duracaoSemestres', $duracaoSemestres);
        $stmt->execute();
    
        header('location: '. $url);
    } catch (PDOException $e) {
        echo "Erro ao atualizar a idAluno: " . $idCurso;
        echo "<p>Erro: " . $e->getMessage() . "</p>";
    }

?>