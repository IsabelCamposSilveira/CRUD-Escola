<!-- Pagina para edição dos dados do Aluno-->
<?php 
    include_once("../funcoes/conexao.php");

    $idCurso = $_GET['idCurso'];
    $nome = $_GET['nome']; 
    $duracaoSemestres = $_GET['duracaoSemestres']; 
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

    <title>Editar Curso</title>
  </head>  

    <body class="bg-light">
        <div class="container" id="corpo" style="border-left: 1px dashed black; border-right: 1px dashed black; margin-top: 50px;">

            <div class="row"> <!-- Titulo -->
                <div class="col offset-md-3" style=" margin-top: 50px;">
                    <h1>Edite os dados necessários:</h1>
                </div>
            </div>
            <!-- Formulário para edição dos dados -->
            <div class="row justify-content-center">
                <form action="../funcoes/editarCursos.php" class="formulario" id="formulario" method="post">
                    <div class="form-group" style="display: none;">
                        <input type="text" name="url" id="idUrl">
                    </div>
                    <div class="form-group" style="display: none;"><!--idNome-->
                        <input type="text" name="idCurso" id="idCurso" required>
                    </div>
                    <div class="form-group"><!--Nome-->
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="idnome" required>
                    </div>
                    <div class="form-group"> <!--CPF-->
                        <label for="Semestre">Duração em Semestres</label>
                        <input type="text" name="duracaoSemestres" id="idSemestre" maxlength="2" required/>
                    </div>                   
                    <div class="col"> <!--Enviar -->  
                        <div class="botao">
                            <input style="margin-top: 30px;" type="submit" class="btn btn-success"   value="Editar"/>
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
        //input idCurso
        var input = "<?php echo($url)?>";
        var element = document.getElementById("idUrl");
        element.value = input;
        //input idCurso
        var input = "<?php echo($idCurso)?>";
        var element = document.getElementById("idCurso");
        element.value = input;

        //input nome
        var input = "<?php echo($nome)?>";
        var element = document.getElementById("idnome");
        element.value = input;

        //input Semestre
        var input = "<?php echo($duracaoSemestres)?>";
        var element = document.getElementById("idSemestre");
        element.value = input;
    </script>
</html>
