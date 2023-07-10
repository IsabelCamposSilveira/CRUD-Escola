<!-- Pagina para edição dos dados do Aluno-->
<?php 
    include_once("../funcoes/conexao.php");

    $idAluno = $_GET['idAluno'];
    $nome = $_GET['nome']; 
    $nascimento = $_GET['nascimento']; 
    $CPF = $_GET['CPF'];
    $url = $_GET['url'];
?>


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

    <title>Editar Aluno</title>
  </head>  

    <body class="bg-light">
        <div class="container" id="corpo" style="border-left: 1px dashed black; border-right: 1px dashed black; margin-top: 50px;">

            <div style="margin: 30px 0px;" class="row justify-content-center"> <!-- Titulo -->
                    <h2>Realize a matricula:</h2>
                
            </div>
            <!-- Formulário para edição dos dados -->
            <div class="row justify-content-center">
                <form action="../funcoes/salvarInscricao.php" class="formulario" id="formulario" method="post">
                    <div class="form-group" style="display: none;"><!--idNome-->
                        <input type="text" name="url" id="idUrl" readonly>
                    </div>
                    <div class="form-group" style="display: none;"><!--idNome-->
                        <input type="text" name="idAluno" id="idAluno" readonly>
                    </div>
                    <div class="form-group"><!--Nome-->
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="idnome" readonly>
                    </div>
                    <div class="form-group"> <!--CPF-->
                        <label for="CPF">CPF</label>
                        <input type="text" name="CPF" id="idCPF" maxlength="14" onkeyup="mascaraCPF(event)" readonly/>
                    </div>
                    <div class="form-group"> <!--Nascimento -->
                        <label for="nascimento">Data de Nascimento</label>
                        <input type="date" name="nascimento" id="idnascimento" readonly/>
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
            <div class="row" style="margin-left: 50px; margin-top: 30px;">    <!-- Botão voltar -->      
                <button onclick="history.back()" class="btn btn-dark">Voltar</button>
            </div>
        </div>   
    </body>


    <script>  // Colocar dados dentro dos inputs
        var input = "<?php echo($url)?>";
        var element = document.getElementById("idUrl");
        element.value = input;
        //input idAluno
        var input = "<?php echo($idAluno)?>";
        var element = document.getElementById("idAluno");
        element.value = input;

        //input nome
        var input = "<?php echo($nome)?>";
        var element = document.getElementById("idnome");
        element.value = input;

        //input CPF
        var input = "<?php echo($CPF)?>";
        var element = document.getElementById("idCPF");
        element.value = input;

        //input data de nascimento
        var input = "<?php echo($nascimento)?>";
        var element = document.getElementById("idnascimento");
        element.value = input;
    </script>
</html>
