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

        <title>Formulário</title>
    </head>  

    <body class="bg-light">
        <?php  //variáveis para pesquisa de alunos 
            $pesquisa = $_POST['busca'] ?? ''; 
            include ("../funcoes/conexao.php"); //puxando a conexão com o banco de dados
            include '../partesSeparadas/funcoesCodigo.php'; //puxa os codigos repetidos
            $url = "../cursos/todosCursos.php";   
        ?>

        <?php  //-------------------------------NAVBAR
            echo navbarProfessor();
        ?>

        <div class="container" id="corpo">
            <div style="margin: 20px 0px;" class="row justify-content-center">
                <h2>Todos Cursos &nbsp&nbsp&nbsp&nbsp</h2>
                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">    Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="cursosSemMatricula.php">Cursos sem matrícula</a>
                </div>
            </div>
            <!--Mostrando a tabela alunos -->
            <div class="row justify-content-center">  
                <div class="col">                
                    <table class="table table-striped" style="border: 3px black solid;">

                        <?php  //-------------------------------Thead da tabela cursos
                            $display = '';
                            echo theadCursos($display);
                        ?>
                        <!--Mostrando o registro da busca da tabela alunos -->
                        <tbody>
                            <?php                                     
                                // Criando os filtros quando os botões forem clicados
                                $pesquisaAlunos = $conn->query("SELECT * FROM cursos ORDER BY nome asc");
                                if(array_key_exists('limpaFiltro', $_POST)) {
                                    $pesquisaAlunos = $conn->query("SELECT * FROM cursos ORDER BY nome asc");
                                } 
                                elseif(array_key_exists('pesquisaNome', $_POST)) {  
                                    $pesquisaAlunos = $conn->query("SELECT * FROM cursos WHERE nome LIKE '$pesquisa%' ORDER BY nome asc");
                                } 
                                elseif(array_key_exists('pesquisaSemestre', $_POST)) {  
                                    $pesquisaAlunos = $conn->query("SELECT * FROM cursos WHERE duracaoSemestres LIKE '$pesquisa%' ORDER BY nome asc");
                                } 

                                while ($linha = $pesquisaAlunos->fetch(PDO::FETCH_ASSOC)) {
                                    // Declarar as variáveis
                                    $nome = $linha['nome'];
                                    $semestre = $linha['duracaoSemestres'];
                                    $idCurso = $linha['idCurso'];
                                
                                    echo "<tr>
                                            <td>$nome</td>
                                            <td>$semestre</td>
                                            <td></td>
                                            <td style= 'width: 10%'><a class='btn btn-warning text-white' href='pagEditarCursos.php?idCurso=$idCurso&&nome=$nome&&duracaoSemestres=$semestre&&url=$url'>Editar</a></td>
                                            </tr>";
                                            
                                }                            
                            ?>
                        </tbody> 
                    </table>

                </div> 
            </div>
        </div>

        <!-------------------------- Modal Adicionar Curso-------------------------------------->
        <div id="modalAdicionarCurso" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Novo curso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="../funcoes/adicionarCurso.php" class="formulario" id="formulario" method="post">
                            <div class="form-group" style="display: none;">
                                <input type="text" name="url" id="idUrl">
                            </div>
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="idnome" required>
                            </div>
                            <div class="form-group">
                                <label for="semestre">Duração em Semestres</label>
                                <input type="text" name="semestre" id="idSemestre"required/>
                            </div>
                            <div class="botao">
                                <input type="submit" class="btn btn-primary" value="Salvar"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
