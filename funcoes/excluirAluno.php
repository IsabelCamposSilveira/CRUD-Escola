<!-- Exlusão dos registros de Alunos -->
<?php 
    include_once("conexao.php");

    $idAluno = $_GET['idAluno'];
    $url = $_GET['url'];

    if (isset($idAluno)) {
        echo $idAluno;
    } else {
        echo "não";
    }

    $teste = 1;

    $sql = "DELETE FROM alunos WHERE idAluno = :idAluno";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idAluno', $idAluno);
        $stmt->execute();

        header('location: '. $url."excluir=2");
    } catch (PDOException $e) {
        echo "Erro ao deletar a idAluno: " . $idAluno;
        echo "<p>Erro: " . $e->getMessage() . "</p>";
    }

?>