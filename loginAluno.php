<?php
    include ("funcoes/conexao.php"); 

    // Obter dados do formulário
    $nome = $_POST['nome'];
    $CPF = $_POST['CPF'];

    // Verificar as credenciais do usuário no banco de dados
    $stmt = $conn->prepare("SELECT * FROM alunos WHERE nome = :nome");
    $stmt->execute(['nome' => $nome]);
    $usuario = $stmt->fetch();

    if ($usuario && ($CPF === $usuario['CPF'])) {
        // Login bem-sucedido, redirecionar para a página principal ou página de perfil do usuário
        header("Location:./areaAluno/listagemLoginAluno.php?nome=$nome&&CPF=$CPF");
        exit();
    } else {
        // Credenciais inválidas, redirecionar de volta para a página de login com uma mensagem de erro
        echo"Nome:". $nome. "CPF".$CPF. "tinha que ser:".$usuario['CPF'];
        exit();
    }
?>