<!-- Pagina para listar os alunos -->

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

    <title>Escola - Cursos sem Matricula</title>
  </head>  

  <body class="bg-light">
    <?php  //variáveis para pesquisa de alunos 
        $pesquisa = $_POST['busca'] ?? ''; 
        include ("../funcoes/conexao.php"); //puxando a conexão com o banco de dados
        include '../partesSeparadas/funcoesCodigo.php';
        $url = "../cursos/cursosSemMatricula.php";
        $excluir = '0';
    ?>

    <?php  //-------------------------------NAVBAR
        echo navbarProfessor();
    ?>

    <div class="container" id="corpo">
    <div style="margin: 20px 0px;" class="row justify-content-center">
            <h2>Cursos Sem Matrícula&nbsp&nbsp&nbsp&nbsp</h2>
            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">    Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="todosCursos.php">Todos Cursos</a>
            </div>
        </div>
        <!--Mostrando a tabela alunos -->
        <div class="row justify-content-center">  
            <div class="col">                
                <table class="table table-striped" style="border: 3px black solid;">
                    <?php  //-------------------------------Thead da tabela cursos
                        $display = 'none';
                        echo theadCursos($display);
                    ?>

                    <!--Mostrando o registro da busca da tabela alunos -->
                    <tbody>
                        <?php                                     
                            // Criando os filtros quando os botões forem clicados
                            $pesquisaAlunos = $conn->query("SELECT cursos.nome AS nome_curso, cursos.duracaoSemestres AS duracaoSemestres_cursos, cursos.idCurso AS idCurso_cursos
                            FROM inscricao
                            RIGHT JOIN cursos ON cursos.idCurso = inscricao.idCurso
                            WHERE inscricao.matricula IS NULL
                            ORDER BY cursos.nome ASC;");

                            
                            if(array_key_exists('limpaFiltro', $_POST)) {
                                $pesquisaAlunos = $conn->query("SELECT cursos.nome AS nome_curso, cursos.duracaoSemestres AS duracaoSemestres_cursos, cursos.idCurso AS idCurso_cursos
                                FROM inscricao
                                RIGHT JOIN cursos ON cursos.idCurso = inscricao.idCurso
                                WHERE inscricao.matricula IS NULL
                                ORDER BY cursos.nome ASC;");
                            } 
                            elseif(array_key_exists('pesquisaNome', $_POST)) {  
                                $pesquisaAlunos = $conn->query("SELECT cursos.nome AS nome_curso, cursos.duracaoSemestres AS duracaoSemestres_cursos, cursos.idCurso AS idCurso_cursos
                                FROM inscricao
                                RIGHT JOIN cursos ON cursos.idCurso = inscricao.idCurso
                                WHERE inscricao.matricula IS NULL AND cursos.nome LIKE '$pesquisa%' 
                                ORDER BY cursos.nome asc");
                            } 
                            elseif(array_key_exists('pesquisaSemestre', $_POST)) {  
                                $pesquisaAlunos = $conn->query("SELECT cursos.nome AS nome_curso, cursos.duracaoSemestres AS duracaoSemestres_cursos, cursos.idCurso AS idCurso_cursos
                                FROM inscricao
                                RIGHT JOIN cursos ON cursos.idCurso = inscricao.idCurso
                                WHERE inscricao.matricula IS NULL AND cursos.duracaoSemestres LIKE '$pesquisa%' 
                                ORDER BY cursos.nome asc");
                            } 

                            while ($linha = $pesquisaAlunos->fetch(PDO::FETCH_ASSOC)) {
                                // Declarar as variáveis
                                $nome = $linha['nome_curso'];
                                $semestre = $linha['duracaoSemestres_cursos'];
                                $idCurso = $linha['idCurso_cursos'];
                            
                                echo "<tr>
                                        <td>$nome</td>
                                        <td>$semestre</td>
                                        <td style= 'width: 10%'><a class='btn btn-danger text-white' href='cursosSemMatricula.php?excluir=1&&nome=$nome&&idCurso=$idCurso'>Excluir</a></td>
                                        <td style= 'width: 10%'><a class='btn btn-warning text-white' href='pagEditarCursos.php?idCurso=$idCurso&&nome=$nome&&duracaoSemestres=$semestre&&url=$url'>Editar</a></td>
                                        </tr>";
                                        
                            }                            
                        ?>
                    </tbody> 
                </table>

            </div> 
        </div>
    </div>

    <!---------------------Modal Adicionar Curso--------------------->
    <?php  
        echo modalAdicionarCurso();
    ?>
    <!------------------------Modal Confirmar Exclusão Curso----------------------------->
    <?php if (isset($_GET["excluir"])) {
            $excluir = $_GET["excluir"];
        } if($excluir == '1'){  ?>
            <div id="modalConfirmaExclusao" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Deseja excluir o aluno 
                            <?php $nome = $_GET['nome']; 
                            echo"$nome";?>?
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Não terá retorno após a exclusão.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Voltar</button>

                        <!-- enviar para o excluir.php-->
                        <?php 
                            $idCurso = $_GET['idCurso'];
                            echo"<a class='btn btn-danger text-white' href='../funcoes/excluirCurso.php?idCurso=$idCurso'>Excluir</a>";
                        ?>
                    </div>
                    </div>
                </div>
            </div>
    <?php } ?>
    
    <script>
        var modal = new bootstrap.Modal(document.getElementById('modalConfirmaExclusao'), {})
        modal.show();

        $('#modalConfirmaExclusao').on('hidden.bs.modal', function(){ // quando o modal for fechado
            window.location.href = ("cursosSemMatricula.php"); // irá enviar para a pag inicial, sem que o modao fique abrindo ao recarregar a pag
        });
    </script>


    <!----------------------------------Modal Excluido Curso----------------------------------->
    <?php if (isset($_GET["excluir"])) {
            $excluir = $_GET["excluir"];
        } if($excluir == '2'){  ?>
        <div id="modalExcluido" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluido com sucesso!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Os dados selecionados foram excluidos.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                </div>
                </div>
            </div>
        </div>
    <?php } ?>


    <script>
        var modal = new bootstrap.Modal(document.getElementById('modalExcluido'), {})
        modal.show();

        $('#modalEcluido').on('hidden.bs.modal', function(){ // quando o modal for fechado
            window.location.href = ("cursosSemMatricula.php"); // irá enviar para a pag inicial, sem que o modao fique abrindo ao recarregar a pag
        });
    </script>


  </body>
</html>
