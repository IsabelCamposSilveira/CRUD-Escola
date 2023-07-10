<!-- Exlusão dos registros de Alunos -->
<?php 
    include_once("../funcoes/conexao.php");

    $matricula = $_GET['matricula'];
    $url = $_GET['url'];
    if(isset($_GET["nome"])){
    $nome = "nome=" .$_GET['nome'];
    $CPF = "CPF=".$_GET['CPF'];
    }

    if (isset($matricula)) {
        echo $matricula;
    } else {
        echo "não";
    }

    $teste = 1;

    $sql = "DELETE FROM inscricao WHERE matricula = :matricula";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->execute();

        header('location:'. $url. "excluir=2&". $nome. "&". $CPF);
    } catch (PDOException $e) {
        echo "Erro ao deletar a matricula: " . $matricula;
        echo "<p>Erro: " . $e->getMessage() . "</p>";
    }

?>