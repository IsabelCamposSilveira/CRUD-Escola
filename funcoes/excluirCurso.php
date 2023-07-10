<!-- Exlusão dos registros de Alunos -->
<?php 
    include_once("../funcoes/conexao.php");

    $idCurso = $_GET['idCurso'];

    if (isset($idAluno)) {
        echo $idCurso;
    } else {
        echo "não";
    }

    $teste = 1;

    $sql = "DELETE FROM cursos WHERE idCurso = :idCurso";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idCurso', $idCurso);
        $stmt->execute();

        header('location: ../cursos/cursosSemMatricula.php?excluir=2');
    } catch (PDOException $e) {
        echo "Erro ao deletar a idCurso: " . $idCurso;
        echo "<p>Erro: " . $e->getMessage() . "</p>";
    }

?>