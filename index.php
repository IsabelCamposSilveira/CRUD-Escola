<!-- Página inicial para cadastro de alunos -->

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
        <?php 
            include ("funcoes/conexao.php"); 
            $url = "../areaAluno/listagemLoginAluno.php?"
        ?>

        <nav class="navbar  navbar-dark bg-dark">
            <a class="navbar-brand text-light" href="#">Escola tal de tal</a>
        </nav> <!--Nav-bar-->

        <div class="container margem-top" id="corpo">
            <div class="row justify-content-center">
                <!----------------------------- Mostrar Cursos --------------------------->
                <div class="col">
                    <div style="margin: 20px 0px;" class="row justify-content-center">
                        <h2>Cursos</h2>
                    </div>
                    <div class="row justify-content-center">  
                        <div class="col">                
                            <table class="table table-striped" style="border: 3px black solid;">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Duraçao em Semestres</th>   
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php            
                                        $listarCursos = $conn->query("SELECT * FROM cursos ORDER BY nome asc"); 

                                        while ($linha = $listarCursos->fetch(PDO::FETCH_ASSOC)) {
                                            // Declarar as variáveis
                                            $nome = $linha['nome'];
                                            $semestre = $linha['duracaoSemestres'];
                                        
                                            echo "<tr>
                                                    <td>$nome</td>
                                                    <td>$semestre</td></tr>";
                                        }                            
                                    ?>
                                </tbody> 
                            </table>

                        </div> 
                    </div>
                </div>

                <!------------------ Cadastro de alunos ---------------->
                <div class="col border-left">
                    <h1 class="text-center">Faça seu cadastro!</h1>

                    <div class="row justify-content-center">
                        <form action="./funcoes/adicionarAluno.php?url=<?php echo"$url";?>" class="formulario" id="formulario" method="post">
                            <div class="form-group">
                                <div class="form-group" style="display: none;"><!--idNome-->
                                    <input type="text" name="url" id="idUrl" readonly>
                                </div>
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="idnome" required>
                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" name="CPF" id="idcpf" maxlength="14" onkeyup="mascaraCPF(event)" required/>
                            </div>
                            <div class="form-group">
                            <label for="nascimento">Data de Nascimento</label>
                            <input type="date" name="nascimento" id="idnascimento"/>
                            </div>
                            <div class="botao">
                                <input type="submit" class="btn btn-success" value="Cadastrar"/>
                            </div>
                        </form>
                    </div>
                    <div style="margin-top: 50px;" class="row justify-content-center">
                        <h4>Já possuo conta:&nbsp&nbsp&nbsp</h4>
                        <button type="button" data-toggle="modal" data-target="#modalLoginAluno" class="btn btn-dark" style="margin-right: 2em;">Aluno</button>
                        <button type="button" data-toggle="modal" data-target="#modalLoginProfessor" class="btn btn-dark" style="margin-right: 2em;">Professor</button>
                    </div>

                </div>           
            </div>
        </div>


        <!----------------------------------Modal Entrar Aluno----------------------------------->
        <div class="modal fade" id="modalLoginAluno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login Aluno</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <form action="loginAluno.php" class="formulario" id="formulario" method="post">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="idnome" required>
                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" name="CPF" id="idcpf" maxlength="14" onkeyup="mascaraCPF(event)" required/>
                            </div>
                            <div class="botao">
                                <input type="submit" class="btn btn-primary" value="Entrar"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!----------------------------------Modal Entrar Professor----------------------------------->
        <div class="modal fade" id="modalLoginProfessor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login Professor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <form action="loginProfessor.php" class="formulario" id="formulario" method="post">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="idnome" required>
                            </div>
                            <div class="form-group">
                                <label for="CPF">CPF</label>
                                <input type="text" name="CPF" id="idcpf" maxlength="14" onkeyup="mascaraCPF(event)" required/>
                            </div>
                            <div class="botao">
                                <input type="submit" class="btn btn-primary" value="Entrar"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!----------------------------------Modal sucesso----------------------------------->
        <?php if(isset($_GET["resp"]) == '1') { ?>
            <!-- isset confirmar se o GET existe para não ocorrer erro --> 
            <div id="modalCadastrado" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cadastro efetuado!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Seja bem vindo à nossa escola.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                    </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <script>
            var modal = new bootstrap.Modal(document.getElementById('modalCadastrado'), {})
            modal.show();

            $('#modalCadastrado').on('hidden.bs.modal', function(){ // quando o modal for fechado
                window.location.href = ("index.php"); // irá enviar para a pag inicial, sem que o modao fique abrindo ao recarregar a pag
            });
        </script>
        <!----------------------------------Fim Modal sucesso----------------------------------->

    </body>
    <script src="funcoes/mascaras.js"></script>
    <script>
        var input = "<?php echo($url)?>";
        var element = document.getElementById("idUrl");
        element.value = input;
    </script>

</html>
