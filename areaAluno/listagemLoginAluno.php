<!-- Pagina para listar os alunos logados-->

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

    <title>Formulário</title>
  </head>  

  <body class="bg-light">
    <nav class="navbar  navbar-dark bg-dark">
        <a class="navbar-brand text-light" href="#">Escola tal de tal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link text-light" href="../index.php">Sair</a>
                </li>
            </ul>
        </div>
    </nav> <!--Nav-bar-->


    <?php  //variáveis para pesquisa de alunos
        include ("../funcoes/conexao.php"); //puxando a conexão com o banco de dados

        $nome = $_GET['nome'] ?? ''; 
        $CPF = $_GET['CPF'] ?? ''; 
        $url = "../areaAluno/listagemLoginAluno.php?";  
        $excluir = '0';
    ?>

    <div class="container" id="corpo">
        <div style="margin: 30px 0px;" class="row justify-content-center">
            <h2>Bem vindo(a) <?php echo"$nome";?>!</h2>
        </div>
        <!--Mostrando a tabela matricula -->
        <div class="row justify-content-center" style="border-top: 1px solid black; padding-top: 3em;">  

            <div class="col">
                <h3  style="margin-bottom: 1em;">Cursos Matrículados&nbsp;&nbsp;&nbsp;<button type="button" data-toggle="modal" data-target="#modalMatricula">&#10133;</button></h3> 
                <table class="table table-striped" style="border: 3px black solid; margin-bottom: 4em;">
                    <thead>
                        <tr>
                            <th scope="col"><button type="button" class="btn btn-secondary">Matricula</button></th>  
                            <th scope="col"><button type="button" class="btn btn-secondary">Semestre de Ingresso</button></th>  
                            <th scope="col"><button type="button" class="btn btn-secondary">Curso</button></th>  
                        </tr>
                    </thead>

                    <!--Mostrando o registro da busca das matriculas -->
                    <tbody>
                        <?php
                            // Criando os filtros quando os botões forem clicados
                            $pesquisaAluno = $conn->query("SELECT alunos.nome AS nome_aluno, alunos.idAluno AS id_aluno, cursos.nome AS nome_curso, inscricao.matricula, inscricao.semestreIngresso
                            FROM inscricao
                            JOIN cursos ON cursos.idCurso = inscricao.idCurso
                            JOIN alunos ON alunos.idAluno = inscricao.idAluno
                            WHERE alunos.nome LIKE '$nome' and alunos.CPF LIKE '$CPF'
                            ORDER BY cursos.nome asc;");

                            while ($linha = $pesquisaAluno->fetch(PDO::FETCH_ASSOC)) {
                                // Declarar as variáveis
                                $matricula = $linha['matricula'];
                                $semestre = $linha['semestreIngresso'];
                                $nomeCurso = $linha['nome_curso'];

                                echo "<tr>
                                        <td>$matricula</td>                        
                                        <td>$semestre</td>
                                        <td>$nomeCurso</td>
                                        <td><a class='btn btn-danger text-white' href='listagemLoginAluno.php?excluir=1&matricula=$linha[matricula]&nome=$nome&CPF=$CPF'>Excluir</a></td>
                                    </tr>";
                            }
                        ?>
                    </tbody> 
                </table>
            </div>
        </div>
        <div class="row" style="border-top: 1px solid black;padding-top: 3em; margin-bottom: 3em;" >
            <div class="col" style="text-align: center;">   
                <?php 
                $dadosPessoais = $conn->query("SELECT * FROM alunos WHERE nome LIKE '$nome' AND CPF LIKE '$CPF'");

                while ($linha = $dadosPessoais->fetch(PDO::FETCH_ASSOC)) {
                    // Declarar as variáveis
                    $nascimento = $linha['nascimento'];
                    $idAluno = $linha['idAluno'];
                }  
                ?>
                   
                <h3>Seus Dados Pessoais</h3> 
                <br> 
                <p>Nome: <strong><?php echo"$nome";?></strong></p>  
                <p>CPF: <strong><?php echo"$CPF";?></strong></p>
                <p>Data de Nascimento: <strong><?php echo"$nascimento";?></strong></p>  
                <a href="../areaProfessor/pagEditarAluno.php?idAluno=<?php echo"$idAluno";?>&&nome=<?php echo"$nome";?>&&nascimento=<?php echo"$nascimento";?>&&CPF=<?php echo"$CPF";?>&&url=<?php echo"$url";?>" class="btn btn-primary">Editar</a>    

            </div> 
        </div>
    </div>
    <!----------------------------------Modal Adicionar Matricula----------------------------------->
    <?php 
        $stmt = $conn->prepare("SELECT idAluno FROM alunos WHERE CPF = :CPF");
        $stmt->bindParam(':CPF', $CPF);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Atribua o valor do banco de dados à variável
        $idAluno = $resultado['idAluno'];
    ?>

    <div class="modal fade" id="modalMatricula" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nova Matricula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form action="../funcoes/salvarInscricao.php" class="formulario" id="formulario" method="post">
                        <div class="form-group"><!--idNome-->
                            <input type="text" name="idAluno" style="display: none;" id="idAluno" value="<?php echo $idAluno; ?>" readonly>
                        </div>
                        <div class="form-group" style="display: none;"><!--idNome-->
                            <input type="text" name="url" id="idUrl" readonly>
                        </div> 
                        <div class="form-group" style="display: none;"><!--idNome-->
                            <input type="text" name="nome" id="idNome" readonly>
                        </div> 
                        <div class="form-group" style="display: none;"><!--idNome-->
                            <input onkeyup="mascaraCPF(event)" type="text" name="CPF" id="idCPF" readonly>
                        </div> 
                        <div class="form-group">
                            <label for="curso">Curso</label>
                            <select name="curso" id="idCurso">
                                <?php
                                // Executar a consulta SQL para obter os dados do banco de dados usando PDO
                                $query = $conn->query("SELECT idCurso, nome FROM cursos");
                                while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
                                $idCurso = $linha['idCurso'];
                                $nomeCurso = $linha['nome'];
                                echo "<option value='$idCurso'>$nomeCurso</option>";
                                }
                                ?>
                            </select>
                        </div>   
                        <div class="form-group"> <!--Semestre -->
                            <label for="nascimento">Semestre de Ingresso</label>
                            <input type="text" name="Semestre" id="idSemestre"/>
                        </div>                 
                        <div class="col"> <!--Enviar -->  
                            <div class="botao">
                                <input style="margin-top: 30px;" type="submit" class="btn btn-success"   value="Salvar"/>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
            var input = "<?php echo($url)?>";
            var element = document.getElementById("idUrl");
            element.value = input;

            var input = "<?php echo($nome)?>";
            var element = document.getElementById("idNome");
            element.value = input;

            var input = "<?php echo($CPF)?>";
            var element = document.getElementById("idCPF");
            element.value = input;
    </script>

    <!----------------------------------Modal Confirmar Exclusão----------------------------------->
    <?php if(isset($_GET["excluir"])){
        $excluir = $_GET["excluir"];
    } if ($excluir == '1'){ ?>
        <div id="modalConfirmaExclusao" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deseja excluir a matricula
                        <?php  if(isset($_GET['matricula'])){
                            $matricula = ($_GET['matricula']);
                        echo"$matricula";}?>?
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
                        echo"<a class='btn btn-danger text-white' href='../funcoes/excluirInscritos.php?matricula=$matricula&url=$url&nome=$nome&CPF=$CPF'>Excluir</a>";
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
            window.location.href = ("listagemLoginAluno.php?nome=<?php echo"$nome";?>&CPF=<?php echo"$CPF";?>"); // irá enviar para a pag inicial, sem que o modao fique abrindo ao recarregar a pag
        });
    </script>

    <!----------------------------------Modal Ecluido----------------------------------->
    <?php if(isset($_GET["excluir"])){
        $excluir = $_GET["excluir"];
    } if ($excluir == '2') { ?>
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
            window.location.href = ("listagemLoginAluno.php?nome=<?php echo"$nome";?>&CPF=<?php echo"$CPF";?>"); // irá enviar para a pag inicial, sem que o modao fique abrindo ao recarregar a pag
        });
    </script>

  </body>
</html>
