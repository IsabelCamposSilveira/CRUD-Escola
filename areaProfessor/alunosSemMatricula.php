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

    <title>Escula - Alunos Sem Matricula</title>
  </head>  

  <body class="bg-light">
  <body class="bg-light">
    <?php  //variáveis para pesquisa de alunos
        
        $pesquisa = $_POST['busca'] ?? ''; 
        include '../partesSeparadas/funcoesCodigo.php'; //puxa os codigos repetidos
        include ("../funcoes/conexao.php"); //puxando a conexão com o banco de dados
        $url = "../areaProfessor/alunosSemMatricula.php?";
        $excluir = '0';
        
    ?>

    <?php  //-------------------------------NAVBAR
        echo navbarProfessor();
    ?>

    <div class="container" id="corpo">
        <?php  //-------------------------------NAVBAR Matricula/Alunos
            $pagAtual = "Alunos sem matricula&nbsp&nbsp&nbsp&nbsp";
            echo navbarAlunosProfessores($pagAtual);
        ?>
        <!--Mostrando a tabela matriculados -->
        <div class="row justify-content-center">  
            <div class="col">                
                <table class="table table-striped" style="border: 3px black solid;">
                    <?php  //-------------------------------Thead da tabela alunos
                        $display = 'none';
                        echo theadAlunos($display);
                    ?>
                    <!--Mostrando o registro da busca da tabela alunos -->
                    <tbody>
                        <?php                                     
                            // Criando os filtros quando os botões forem clicados
                            $pesquisaAlunos = $conn->query("SELECT alunos.nome AS nome_aluno, alunos.nascimento AS nascimento_aluno, alunos.CPF AS CPF_alunos, alunos.idAluno AS idAluno_aluno, inscricao.matricula, inscricao.semestreIngresso
                            FROM inscricao
                            RIGHT JOIN alunos ON alunos.idAluno = inscricao.idAluno
                            WHERE inscricao.matricula IS NULL
                            ORDER BY alunos.nome ASC;");
                                                   
                            if (array_key_exists('pesquisaNome', $_POST)) {  
                                $pesquisaAlunos = $conn->query("SELECT alunos.nome AS nome_aluno, alunos.nascimento AS nascimento_aluno, alunos.CPF AS CPF_alunos, inscricao.matricula, alunos.idAluno AS idAluno_aluno, inscricao.semestreIngresso
                                    FROM inscricao
                                    RIGHT JOIN alunos ON alunos.idAluno = inscricao.idAluno
                                    WHERE inscricao.matricula IS NULL AND alunos.nome LIKE '$pesquisa%'
                                    ORDER BY alunos.nome ASC;");
                            } 
                            elseif (array_key_exists('pesquisaNascimento', $_POST)) {
                                $pesquisaBetween = $_POST['pesquisaBetween']; // Valor digitado pelo usuário no campo de pesquisaBetween
                                $pesquisaAlunos = $conn->query("SELECT alunos.nome AS nome_aluno, alunos.nascimento AS nascimento_aluno, alunos.CPF AS CPF_alunos, alunos.idAluno AS idAluno_aluno, inscricao.matricula, inscricao.semestreIngresso
                                    FROM inscricao
                                    RIGHT JOIN alunos ON alunos.idAluno = inscricao.idAluno
                                    WHERE inscricao.matricula IS NULL AND alunos.nascimento BETWEEN '$pesquisa' AND '$pesquisaBetween'
                                    ORDER BY alunos.nome ASC;");
                            } 
                            elseif (array_key_exists('pesquisaCPF', $_POST)) {
                                $pesquisaAlunos = $conn->query("SELECT alunos.nome AS nome_aluno, alunos.nascimento AS nascimento_aluno, alunos.CPF AS CPF_alunos, alunos.idAluno AS idAluno_aluno, inscricao.matricula, inscricao.semestreIngresso
                                    FROM inscricao
                                    RIGHT JOIN alunos ON alunos.idAluno = inscricao.idAluno
                                    WHERE inscricao.matricula IS NULL AND alunos.CPF LIKE '$pesquisa%'
                                    ORDER BY alunos.nome ASC;");
                            }

                            while ($linha = $pesquisaAlunos->fetch(PDO::FETCH_ASSOC)) {
                                // Declarar as variáveis
                                $nome = $linha['nome_aluno'];
                                $nascimento = $linha['nascimento_aluno'];
                                $CPF = $linha['CPF_alunos'];
                            
                                echo "<tr>
                                        <td>$nome</td>
                                        <td>$nascimento</td>
                                        <td>$CPF</td>
                                        <td style= 'width: 10%'><a class='btn btn-success text-white' href='pagAdicionarMatricula.php?idAluno=$linha[idAluno_aluno]&&nome=$linha[nome_aluno]&&nascimento=$linha[nascimento_aluno]&&CPF=$linha[CPF_alunos]&&url=$url'>Matricular</a></td>
                                        <td style= 'width: 10%'><a class='btn btn-warning text-white' href='pagEditarAluno.php?idAluno=$linha[idAluno_aluno]&&nome=$linha[nome_aluno]&&nascimento=$linha[nascimento_aluno]&&CPF=$linha[CPF_alunos]&&url=$url'>Editar</a></td>
                                        <td style= 'width: 10%'><a class='btn btn-danger text-white' href='alunosSemMatricula.php?idAluno=$linha[idAluno_aluno]&&nome=$linha[nome_aluno]&&excluir=1'>Excluir</a></td>
                                        </tr>";
                            }                            
                        ?>
                    </tbody> 
                </table>

            </div> 
        </div>
    </div>
    <!----------------------------------Modal Confirmar Exclusão Aluno----------------------------------->
    <?php if (isset($_GET["excluir"])) {
            $excluir = $_GET["excluir"];
        } if($excluir == '1'){?>
            <div id="modalConfirmaExclusao" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Deseja excluir o aluno
                            <?php 
                            $idAluno = $_GET['idAluno']; 
                            $nome = $_GET['nome']; 
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
                            echo"<a class='btn btn-danger text-white' href='../funcoes/excluirAluno.php?idAluno=$idAluno&url=$url'>Excluir</a>";
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
            window.location.href = ("alunosSemMatricula.php"); // irá enviar para a pag inicial, sem que o modao fique abrindo ao recarregar a pag
        });
    </script>

    <!----------------------------------Modal Aluno Excluido----------------------------------->
    <?php if (isset($_GET["excluir"])) {
            $excluir = $_GET["excluir"];
        } if($excluir == '2'){ ?>
        <div id="modalEcluido" class="modal" tabindex="-1" role="dialog">
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
        var modal = new bootstrap.Modal(document.getElementById('modalEcluido'), {})
        modal.show();

        $('#modalEcluido').on('hidden.bs.modal', function(){ // quando o modal for fechado
            window.location.href = ("alunosSemMatricula.php"); // irá enviar para a pag inicial, sem que o modao fique abrindo ao recarregar a pag
        });
    </script>


  </body>
</html>
