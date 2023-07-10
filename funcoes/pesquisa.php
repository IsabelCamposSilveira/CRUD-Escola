<?php  
    //------------------------------
    function pesquisaAlunos() {
        include ("conexao.php"); // puxando a conexão com o banco de dados
    
        try {
            $stmt = $conn->query("SELECT * FROM alunos ORDER BY matricula asc");
            return $stmt;
        } catch(PDOException $e) {
            echo "Erro na consulta: " . $e->getMessage();
        }
        
    }
    //------------------------------ Por nome
    function pesquisaNome($pesquisa) {
        include ("conexao.php"); // puxando a conexão com o banco de dados
    
        $dados = "SELECT * FROM alunos 
        WHERE nome LIKE '%$pesquisa%'
        ORDER BY matricula asc";
    
        try {
            $stmt = $conn->query($dados);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stmt;
        } catch(PDOException $e) {
            echo "Erro na consulta: " . $e->getMessage();
        }
    }

    //----------------------- Curso
    function pesquisaCursoIgual($pesquisa) {
        include ("conexao.php"); // puxando a conexão com o banco de dados
    
        $dados = "SELECT * FROM alunos 
        WHERE curso LIKE '%$pesquisa%'
        ORDER BY nome asc";
    
        try {
            $stmt = $conn->query($dados);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stmt;
        } catch(PDOException $e) {
            echo "Erro na consulta: " . $e->getMessage();
        }
    }
    function pesquisaCursoDiferente($pesquisa) {
        include ("conexao.php"); // puxando a conexão com o banco de dados
    
        $dados = "SELECT * FROM alunos 
        WHERE curso NOT LIKE '%$pesquisa%'
        ORDER BY nome asc";
    
        try {
            $stmt = $conn->query($dados);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stmt;
        } catch(PDOException $e) {
            echo "Erro na consulta: " . $e->getMessage();
        }
    }
    
    //----------------------- Semestre
    function pesquisaSemestre($pesquisa) {
        include ("conexao.php"); // puxando a conexão com o banco de dados
    
        $dados = "SELECT * FROM alunos 
        WHERE semestre LIKE '%$pesquisa%'
        ORDER BY semestre asc ,nome asc";
    
        try {
            $stmt = $conn->query($dados);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stmt;
        } catch(PDOException $e) {
            echo "Erro na consulta: " . $e->getMessage();
        }
    }
    
    //----------------------- pesquisaNascimento
    function pesquisaNascimento($pesquisa) {
        include ("conexao.php"); // puxando a conexão com o banco de dados
    
        $dados = "SELECT * FROM alunos 
        WHERE nascimento BETWEEN '$pesquisa' AND '$pesquisaBetween'
        ORDER BY nome asc";
    
        try {
            $stmt = $conn->query($dados);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stmt;
        } catch(PDOException $e) {
            echo "Erro na consulta: " . $e->getMessage();
        }
    }

    //----------------------- pesquisaMatricula
    function pesquisaMatricula($pesquisa) {
        include ("conexao.php"); // puxando a conexão com o banco de dados
    
        $dados = "SELECT * FROM alunos 
        WHERE matricula LIKE '%$pesquisa%'
        ORDER BY nome asc";
    
        try {
            $stmt = $conn->query($dados);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stmt;
        } catch(PDOException $e) {
            echo "Erro na consulta: " . $e->getMessage();
        }
    }

    //----------------------- CPF
    function pesquisaCPF($pesquisa) {
        include ("conexao.php"); // puxando a conexão com o banco de dados
    
        $dados = "SELECT * FROM alunos 
        WHERE CPF LIKE '%$pesquisa%'
        ORDER BY nome asc";
    
        try {
            $stmt = $conn->query($dados);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stmt;
        } catch(PDOException $e) {
            echo "Erro na consulta: " . $e->getMessage();
        }
    }

?>