<?php
    function navbarProfessor() {
        $navbar = '
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand text-light" href="#">Escola tal de tal</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link text-light" href="../areaProfessor/todosAlunos.php">Alunos / Matriculas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="../cursos/todosCursos.php">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="../index">Sair</a>
                    </li>
                </ul>
            </div>
        </nav>
        ';
        return $navbar;
    }


    function navbarAlunosProfessores($pagAtual) {
        $navbar =
        '<div style="margin: 20px 0px;" class="row justify-content-center">
            <h2>'.$pagAtual.'</h2>
            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">    Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="todosAlunos.php">Alunos</a>
                <a class="dropdown-item" href="alunosSemMatricula.php">Alunos sem matrícula</a>
                <a class="dropdown-item" href="todosMatriculados.php">Matrículas</a>
            </div>
        </div>';
        return $navbar;
    }

    function theadAlunos($display) { 
        $navbar =
            '<thead>
                <tr>
                    <!---------------------------Nome--------------->
                    <th scope="col">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nome  </button>
                            <div class="dropdown-menu">
                                <form class="dropdown-item form-inline" action="'.$_SERVER['PHP_SELF'].'" method="POST">
                                    <input class="form-control mr-sm-2" type="search" name="busca" placeholder="Pesquisar" aria-label="Search">
                                    <button name="pesquisaNome" class="btn btn-secondary my-2 my-sm-0" type="submit">&asymp;</button>
                                </form>
                            </div>
                        </div>
                    </th>
                    <!---------------------------Data de Nascimento--------------->
                    <th scope="col">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nascimento  </button>
                            <div class="dropdown-menu">
                                <p class="dropdown-item">Entre as datas:</p>
                                <form class="dropdown-item form-inline" action="'.$_SERVER['PHP_SELF'].'" method="POST">
                                    <input class="form-control mr-sm-2" type="date" name="busca" aria-label="Search">
                                    <input class="form-control mr-sm-2" type="date" name="buscaBetween" aria-label="Search">
                                    <button name="pesquisaNascimento" class="btn btn-secondary my-2 my-sm-0" type="submit">&asymp;</button>
                                </form>
                            </div>
                        </div>  
                    </th>
                    <!---------------------------CPF--------------->
                    <th scope="col">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CPF  </button>
                            <div class="dropdown-menu">
                                <form class="dropdown-item form-inline" action="'.$_SERVER['PHP_SELF'].'" method="POST">
                                    <input class="form-control mr-sm-2" type="search" placeholder="CPF" name="busca" aria-label="Search">
                                    <button name="pesquisaCPF" class="btn btn-secondary my-2 my-sm-0" type="submit">&asymp;</button>
                                </form>
                            </div>
                        </div>
                    </th>   
                    <!---------------------------Limpar os filtros--------------->
                    <th scope="col" colspan="2">
                        <form style="text-align: center;" action="'.$_SERVER['PHP_SELF'].'" method="POST">
                            <button name="pesquisaAlunos" class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Limpar Filtro</button>
                            <button style="display:'.$display.';margin-left: 2em;" data-toggle="modal" data-target="#modalAdicionarAluno" type="button">&#10133;</button>
                        </form>                         
                    </th>     
                </tr>
            </thead>';
        return $navbar;
    }


    function modalSucessoEdicaoAluno() {
        $navbar =       
        '<div id="modalEditado" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editado com sucesso!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Os dados selecionados foram editados.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                    </div>
                </div>
            </div>
        </div>
        ';

        return $navbar;
    }

    function modalConfirmaExclusaoMatricula($matricula, $url) {
        $navbar = '
        <div id="modalConfirmaExclusao" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Deseja excluir a matricula ' . $matricula . '?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Não terá retorno após a exclusão.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Voltar</button>
                        <a class="btn btn-danger text-white" href="../funcoes/excluirInscritos.php?matricula=' . $matricula . '&&url=' . $url . '">Excluir</a>
                    </div>
                </div>
            </div>
        </div>
        ';

        return $navbar;
    }

    function modalMatriculaExcluida() {
        $navbar = '
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
        ';

        return $navbar;
    }

    //---------------------------------------------- Cursos
    function theadCursos($display) { 
        $navbar =
            '                        <thead>
            <tr>
                <!---------------------------Nome--------------->
                <th scope="col">
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nome  </button>
                        <div class="dropdown-menu">
                            <form class="dropdown-item form-inline" action="'.$_SERVER['PHP_SELF'].'" method="POST">
                                <input class="form-control mr-sm-2" type="search" name="busca" placeholder="Pesquisar" aria-label="Search">
                                <button name="pesquisaNome" class="btn btn-secondary my-2 my-sm-0" type="submit">&asymp;</button>
                            </form>
                        </div>
                    </div>
                </th>
                <!---------------------------Semestre--------------->
                <th scope="col">
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Duração em Semestres   </button>
                        <div class="dropdown-menu">
                            <form class="dropdown-item form-inline" action="'.$_SERVER['PHP_SELF'].'" method="POST">
                                <input class="form-control mr-sm-2" type="search" placeholder="Semestres" name="busca" aria-label="Search">
                                <button name="pesquisaSemestre" class="btn btn-secondary my-2 my-sm-0" type="submit">&asymp;</button>
                            </form>
                        </div>
                    </div>
                </th>   
                <!---------------------------Limpar os filtros--------------->
                <th scope="col" colspan="2">
                    <form style="text-align: center;" action="'.$_SERVER['PHP_SELF'].'" method="POST">
                        <button name="limpaFiltro" class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Limpar Filtro</button>
                        <button style="display:'.$display.';margin-left: 2em;" data-toggle="modal" data-target="#modalAdicionarCurso" type="button">&#10133;</button>
                    </form>                         
                </th>     
            </tr>
        </thead>
        ';
        return $navbar;
    }



?>
