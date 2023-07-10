<!-- Pagina para listar as matriculas -->

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

    <title>Escola - Matriculas</title>
  </head>  

  <body class="bg-light">
    <?php  //variáveis para pesquisa de alunos
        
        $pesquisa = $_POST['busca'] ?? ''; 
        include ("../funcoes/conexao.php"); //puxando a conexão com o banco de dados
        include '../partesSeparadas/funcoesCodigo.php'; //puxa os codigos repetidos
        $excluir = 0;
        $url = "../areaProfessor/todosMatriculados.php?";
    ?>
    <?php  //-------------------------------NAVBAR
        echo navbarProfessor();
    ?>


    <div class="container" id="corpo">
        <?php  //-------------------------------NAVBAR Matricula/Alunos
            $pagAtual = "Matriculas&nbsp&nbsp&nbsp&nbsp";
            echo navbarAlunosProfessores($pagAtual);
        ?>
        <!--Mostrando a tabela matriculados -->
        <div class="row justify-content-center">  
            <div class="col">                
                <table class="table table-striped" style="border: 3px black solid;">
                    <thead>
                        <tr>
                            <!---------------------------Matricula--------------->
                            <th scope="col">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Matricula</button>
                                    <div class="dropdown-menu">
                                        <form class="dropdown-item form-inline" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                                            <input class="form-control mr-sm-2" type="search" placeholder="Matrícula" name="busca" aria-label="Search">
                                            <button name="pesquisaMatricula" class="btn btn-secondary my-2 my-sm-0" type="submit">&asymp;</button>
                                        </form>
                                    </div>
                                </div>
                            </th>  
                            <!---------------------------Nome--------------->
                            <th scope="col">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nome  </button>
                                    <div class="dropdown-menu">
                                        <form class="dropdown-item form-inline" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                                            <input class="form-control mr-sm-2" type="search" name="busca" placeholder="Pesquisar" aria-label="Search">
                                            <button name="pesquisaNome" class="btn btn-secondary my-2 my-sm-0" type="submit">&asymp;</button>
                                        </form>
                                    </div>
                                </div>
                            </th>
                            <!---------------------------Semestre de Ingresso--------------->
                            <th scope="col">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Semestre Ingresso</button>
                                    <div class="dropdown-menu">
                                        <form class="dropdown-item form-inline" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                                            <input class="form-control mr-sm-2" type="search" placeholder="Semestre" name="busca" aria-label="Search">
                                            <button name="pesquisaSemestre" class="btn btn-secondary my-2 my-sm-0" type="submit">&asymp;</button>
                                        </form>
                                    </div>
                                </div>
                            </th>  
                            <!---------------------------Curso--------------->
                            <th scope="col">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Curso</button>
                                    <div class="dropdown-menu">
                                        <form class="dropdown-item form-inline" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                                            <input class="form-control mr-sm-2" type="text" name="busca" aria-label="Search" placeholder="Curso">
                                            <button name="pesquisaCurso" class="btn btn-secondary my-2 my-sm-0" type="submit">&asymp;</button>
                                        </form>
                                    </div>
                                </div>  
                            </th> 
                            <!---------------------------Limpar os filtros--------------->
                            <th scope="col" colspan="2">
                                <form style="text-align: center;" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                                    <button name="pesquisaAlunos" class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Limpar Filtro</button>
                                </form>                         
                            </th>    <!-- Excluir e Editar -->
                        </tr>
                    </thead>

                    <!--Mostrando o registro da busca das matriculas -->
                    <tbody>
                    <?php
                        // Criando os filtros quando os botões forem clicados
                        $pesquisaAlunos = $conn->query("SELECT alunos.nome AS nome_aluno, cursos.nome AS nome_curso, inscricao.matricula, inscricao.semestreIngresso
                            FROM inscricao
                            JOIN cursos ON cursos.idCurso = inscricao.idCurso
                            JOIN alunos ON alunos.idAluno = inscricao.idAluno
                            ORDER BY cursos.nome asc;");

                        if(array_key_exists('pesquisaMatricula', $_POST)) {
                            $pesquisaAlunos = $conn->query("SELECT alunos.nome AS nome_aluno, cursos.nome AS nome_curso, inscricao.matricula, inscricao.semestreIngresso
                            FROM inscricao
                            JOIN cursos ON cursos.idCurso = inscricao.idCurso
                            JOIN alunos ON alunos.idAluno = inscricao.idAluno
                            WHERE matricula LIKE '%$pesquisa%'
                            ORDER BY cursos.nome asc;");
                        } 
                        elseif(array_key_exists('pesquisaNome', $_POST)) {  
                            $pesquisaAlunos = $conn->query("SELECT alunos.nome AS nome_aluno, cursos.nome AS nome_curso, inscricao.matricula, inscricao.semestreIngresso
                            FROM inscricao
                            JOIN cursos ON cursos.idCurso = inscricao.idCurso
                            JOIN alunos ON alunos.idAluno = inscricao.idAluno
                            WHERE alunos.nome LIKE '$pesquisa%'
                            ORDER BY alunos.nome, cursos.nome asc;");
                        } 
                        elseif(array_key_exists('pesquisaSemestre', $_POST)) {
                            $pesquisaAlunos = $conn->query("SELECT alunos.nome AS nome_aluno, cursos.nome AS nome_curso, inscricao.matricula, inscricao.semestreIngresso
                            FROM inscricao
                            JOIN cursos ON cursos.idCurso = inscricao.idCurso
                            JOIN alunos ON alunos.idAluno = inscricao.idAluno
                            WHERE semestreIngresso LIKE '%$pesquisa%'
                            ORDER BY cursos.nome asc;");
                        }
                        elseif(array_key_exists('pesquisaCurso', $_POST)) {
                            $pesquisaAlunos = $conn->query("SELECT alunos.nome AS nome_aluno, cursos.nome AS nome_curso, inscricao.matricula, inscricao.semestreIngresso
                            FROM inscricao
                            JOIN cursos ON cursos.idCurso = inscricao.idCurso
                            JOIN alunos ON alunos.idAluno = inscricao.idAluno
                            WHERE cursos.nome LIKE '$pesquisa%'
                            ORDER BY cursos.nome asc;");
                        }

                        while ($linha = $pesquisaAlunos->fetch(PDO::FETCH_ASSOC)) {
                            // Declarar as variáveis
                            $matricula = $linha['matricula'];
                            $nomeAluno = $linha['nome_aluno'];
                            $nomeCurso = $linha['nome_curso'];
                            $semestre = $linha['semestreIngresso'];

                            echo "<tr>
                                    <td>$matricula</td>   
                                    <td>$nomeAluno</td>                        
                                    <td>$semestre</td>
                                    <td>$nomeCurso</td>
                                    <td><a class='btn btn-danger text-white' href='todosMatriculados.php?matricula=$linha[matricula]&&excluir=1'>Excluir</a></td>
                                  </tr>";
                        }
                    ?>
                    </tbody> 
                </table>
            </div> 
        </div>
    </div>
    <!----------------------------------Modal Confirmar Exclusão----------------------------------->
    <?php
        if (isset($_GET["excluir"])) {
            $excluir = $_GET["excluir"];
        }
        if ($excluir == '1') {
            $matricula = $_GET['matricula'];
            echo modalConfirmaExclusaoMatricula($matricula, $url);
        }
    ?>
    
    <script>
        var modal = new bootstrap.Modal(document.getElementById('modalConfirmaExclusao'), {})
        modal.show();

        $('#modalConfirmaExclusao').on('hidden.bs.modal', function(){ // quando o modal for fechado
            window.location.href = ("todosMatriculados.php"); // irá enviar para a pag inicial, sem que o modal fique abrindo ao recarregar a página
        });
    </script>

    <!----------------------------------Modal Excluido----------------------------------->
    <?php
        if (isset($_GET["excluir"])) {
            $excluir = $_GET["excluir"];
            if ($excluir == '2') {
                echo modalMatriculaExcluida();
            }
        }
    ?>
    <script>
        var modal = new bootstrap.Modal(document.getElementById('modalEcluido'), {})
        modal.show();

        $('#modalEcluido').on('hidden.bs.modal', function(){ // quando o modal for fechado
            window.location.href = ("todosMatriculados.php"); // irá enviar para a pag inicial, sem que o modao fique abrindo ao recarregar a pag
        });
    </script>

  </body>
</html> <!-- 280-->
