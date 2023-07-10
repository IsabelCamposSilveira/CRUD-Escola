<!-- Pagina para listar todos os alunos -->

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style1.css">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <title>Escola - Todos Alunos</title>
    </head>  

    <body class="bg-light">
    
    <?php  //---------------------------Variaveis  
        include ("../funcoes/conexao.php"); //puxando a conexão com o banco de dados
        include '../partesSeparadas/funcoesCodigo.php'; //puxa os codigos repetidos
        $url = "../areaProfessor/todosAlunos.php?";     
        $pesquisa = $_POST['busca'] ?? ''; 
        $pesquisaBetween = $_POST['buscaBetween'] ?? ''; // Para pesquisar entre as datas
    ?>
    
    <?php  //-------------------------------NAVBAR
        echo navbarProfessor();
    ?>

    <div class="container" id="corpo">
        <?php  //-------------------------------NAVBAR Matricula/Alunos
            $pagAtual = "Todos Alunos&nbsp&nbsp&nbsp&nbsp";
            echo navbarAlunosProfessores($pagAtual);
        ?>
        <!--Mostrando a tabela alunos -->
        <div class="row justify-content-center">  
            <div class="col">                
                <table class="table table-striped" style="border: 3px black solid;">
                    <?php  //-------------------------------Thead da tabela alunos
                        $display = '';
                        echo theadAlunos($display);
                    ?>

                    <!--Mostrando o registro da busca da tabela alunos -->
                    <tbody>
                        <?php                                     
                            // ---------------------- Filtros
                            $pesquisaAlunos = $conn->query("SELECT alunos.nome AS nome_aluno, alunos.nascimento AS nascimento_aluno, alunos.CPF AS CPF_aluno, alunos.idAluno AS idAluno_aluno, inscricao.matricula, inscricao.semestreIngresso
                            FROM inscricao
                            RIGHT JOIN alunos ON alunos.idAluno = inscricao.idAluno
                            ORDER BY alunos.nome ASC;");
                        
                            if (array_key_exists('pesquisaNome', $_POST)) {  
                                $pesquisaAlunos = $conn->query("SELECT alunos.nome AS nome_aluno, alunos.nascimento AS nascimento_aluno, alunos.CPF AS CPF_aluno, inscricao.matricula, alunos.idAluno AS idAluno_aluno, inscricao.semestreIngresso
                                    FROM inscricao
                                    RIGHT JOIN alunos ON alunos.idAluno = inscricao.idAluno
                                    WHERE alunos.nome LIKE '$pesquisa%'
                                    ORDER BY alunos.nome ASC;");
                            } 
                            elseif (array_key_exists('pesquisaNascimento', $_POST)) {
                                $pesquisaBetween = $_POST['pesquisaBetween']; // Valor digitado pelo usuário no campo de pesquisaBetween
                                $pesquisaAlunos = $conn->query("SELECT alunos.nome AS nome_aluno, alunos.nascimento AS nascimento_aluno, alunos.CPF AS CPF_aluno, alunos.idAluno AS idAluno_aluno, inscricao.matricula, inscricao.semestreIngresso
                                    FROM inscricao
                                    RIGHT JOIN alunos ON alunos.idAluno = inscricao.idAluno
                                    WHERE AND alunos.nascimento BETWEEN '$pesquisa' AND '$pesquisaBetween'
                                    ORDER BY alunos.nome ASC;");
                            } 
                            elseif (array_key_exists('pesquisaCPF', $_POST)) {
                                $pesquisaAlunos = $conn->query("SELECT alunos.nome AS nome_aluno, alunos.nascimento AS nascimento_aluno, alunos.CPF AS CPF_aluno, alunos.idAluno AS idAluno_aluno, inscricao.matricula, inscricao.semestreIngresso
                                    FROM inscricao
                                    RIGHT JOIN alunos ON alunos.idAluno = inscricao.idAluno
                                    WHERE alunos.CPF LIKE '$pesquisa%'
                                    ORDER BY alunos.nome ASC;");
                            }

                            while ($linha = $pesquisaAlunos->fetch(PDO::FETCH_ASSOC)) {
                                // Declarar as variáveis
                                $nome = $linha['nome_aluno'];
                                $nascimento = $linha['nascimento_aluno'];
                                $CPF = $linha['CPF_aluno'];
                            
                                echo "<tr>
                                        <td>$nome</td>
                                        <td>$nascimento</td>
                                        <td>$CPF</td>
                                        <td style= 'width: 10%'><a class='btn btn-success text-white' href='pagAdicionarMatricula.php?idAluno=$linha[idAluno_aluno]&&nome=$linha[nome_aluno]&&nascimento=$linha[nascimento_aluno]&&CPF=$linha[CPF_aluno]&&url=$url'>Matricular</a></td>
                                        <td style= 'width: 10%'><a class='btn btn-warning text-white' href='pagEditarAluno.php?idAluno=$linha[idAluno_aluno]&&nome=$linha[nome_aluno]&&nascimento=$linha[nascimento_aluno]&&CPF=$linha[CPF_aluno]&&url=$url'>Editar</a></td>
                                        </tr>";
                            }                            
                        ?>
                    </tbody> 
                </table>

            </div> 
        </div>
    </div>

    <!--------------------------Modal Adicionar Aluno------------------->
    <div class="modal fade" id="modalAdicionarAluno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novo Aluno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form action="../funcoes/adicionarAluno.php" class="formulario" id="formulario" method="post">
                        <div class="form-group" style="display: none;">
                            <input type="text" name="url" id="idUrl">
                        </div>
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" id="idnome" required>
                        </div>
                        <div class="form-group">
                            <label for="nascimento">Data de Nascimento</label>
                            <input type="date" name="nascimento" id="idNascimento"required/>
                        </div>
                        <div class="form-group">
                            <label for="CPF">CPF</label>
                            <input type="text" onkeyup="mascaraCPF(event)" name="CPF" id="idCPF" maxlength="14" required/>
                        </div>
                        <div class="botao">
                            <input type="submit" class="btn btn-primary" value="Entrar"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        //input idCurso
        var input = "<?php echo($url)?>";
        var element = document.getElementById("idUrl");
        element.value = input;
    </script>
    <!----------------------------------Modal sucesso edição----------------------------------->
    <?php 
        if (isset($_GET["editar"]) && $_GET["editar"] == '1') {
            echo modalSucessoEdicaoAluno();
        }
    ?>

    <script>
        var modal = new bootstrap.Modal(document.getElementById('modalEditado'), {})
        modal.show();

        $('#modalEditado').on('hidden.bs.modal', function(){ // quando o modal for fechado
            window.location.href = ("todosAlunos.php"); // irá enviar para a pag inicial, sem que o modal fique abrindo ao recarregar a pag
        });
    </script>


  </body>
  <script src="../funcoes/mascaras.js"></script>
</html> 
