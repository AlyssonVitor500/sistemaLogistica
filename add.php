<?php 
    include_once '_sqlC/checkNivel.php';
    @include_once '_includes/arqCima.php';
    include_once '_sqlC/conexao.php';
   
    $sql = $conn->query("SELECT * FROM produtos");
    $lastID = 0;

    while ($dados = $sql->fetch_assoc()) {
        $id = $dados ['id'];
        if ($lastID < $id) {
            $lastID = $id;
        }
    }

    $lastID++;
?>

    <style>
        label,small {
            font-size: 1.2em;
        }
        input[type="text"],select {
            font-weight: bold;
        }
        body{
            overflow-x: hidden;
 
        }
        #apagar{
            background-color:deepskyblue; 
            width: 100%;
            color: white;
        }
        #enviar {
            background-color:midnightblue;
            color: white;
            width: 100%;
        }
        #mandar {
            
            color: white;
            width: 100%;
            background-color: #177dc1;
        }
        #voltar {
            color: white;
            width:100%;
            background-color: #427fbc;
        }
        
        @media only screen and (max-width: 600px) {
            input[type="text"]{
                margin-left: 10%;
                width: 80%;
            } 
            select {
                margin-left: 5%;
                
            }
            textarea{
                padding-right: 10%;
                margin-left: 10%;
                
                
            }
            #apagar{
                margin-top: 1%
                
            }
            #enviar{
                margin-top: 1%
            }
            #mandar {
                margin-top: 1%
            }
            #apagar, #enviar, #mandar,#voltar {
                margin-left: 8%;
                width: 55vh;
            }
            form input{
                text-align: center;
            }
        }
    </style>
    <?php if (@$_SESSION['ADDS']){ ?>
        <div class="alert alert-success fixed-top text-center alert-dismissible fade show" role="alert">
            <strong>Produto cadastrado com Sucesso!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php unset($_SESSION['ADDS']); } ?>
    <?php if (@$_SESSION['ADDD']){ ?>
        <div class="alert alert-danger fixed-top text-center alert-dismissible fade show" role="alert">
            <strong>Produto não cadastrado! (Evite caracteres como ')</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php unset($_SESSION['ADDD']); } ?>
    <div id="conteudo"  style="height: 100vh;" class="container">
        <form class="form form-group" action="_sqlC/addProd.php" method="post"> 
            <div class="container-fluid text-center mt-4">
                <div class="row">
                    <div class="col-md-12"><h1><i class="fas fa-plus-circle "></i> Cadastrar Produtos </div>
                </div>
                <div class="row mt-3">
                    <?php if ($lastID > 0 && $lastID < 10) { ?>
                        <div class="col-md-4">
                            <label for="ident"><strong>Identificador</strong></label>
                            <input type="text" style="text-align: center" class="form-control" required value="000<?php  echo $lastID; ?>" name="" disabled id="ident">
                            
                        </div>
                    <?php }else if($lastID >= 10 && $lastID < 100){ ?>
                        <div class="col-md-4">
                            <label for="ident"><strong>Identificador</strong></label>
                            <input type="text" style="text-align: center" class="form-control" required value="00<?php  echo $lastID; ?>" name="" disabled id="ident">
                        
                        </div>

                    <?php }else if($lastID >= 100 && $lastID < 1000){ ?>
                        <div class="col-md-4">
                            <label for="ident"><strong>Identificador</strong></label>
                            <input type="text" style="text-align: center" class="form-control" required value="0<?php  echo $lastID; ?>" name="" disabled id="ident">
                        
                        </div>

                    <?php }else if($lastID >= 1000){ ?>
                        <div class="col-md-4">
                            <label for="ident"><strong>Identificador</strong></label>
                            <input type="text" style="text-align: center" class="form-control" required value="<?php  echo $lastID; ?>" name="" disabled id="ident">
                        
                        </div>

                    <?php } ?>
                    <div class="col-md-4">
                        <label for="nome"><strong>Nome do Produto</strong></label>
                        <input type="text" class="form-control" name="nome" required id="nome">
                        <small><strong>Ex.: Biscoito</strong></small>
                    </div>
                    <div class="col-md-4">
                        <label for="nome"><strong>Fornecedor do Produto</strong></label>
                        <select class=" mx-auto custom-select" name="fabricante" style="width:100%;" id="">
                            <option value="0" selected disabled>Escolha um Fornecedor</option>
                            <?php 
                                $sql = mysqli_query($conn,"SELECT * FROM fornecedor ORDER BY nomeForn");

                                $value = 0;

                                while ($dados = $sql->fetch_assoc()){
                                    $id = $dados['idForn'];
                                    $nome = $dados['nomeForn'];

                                    $nome = mb_convert_case($nome, MB_CASE_TITLE, 'UTF-8');

                                    echo "
                                        <option value='$id'> 
                                            $nome
                                        </option>
                                    ";

                                }
                                
                            ?>
                        </select>
                        
                    </div>
                    
                </div>
            </div>
            <hr>
            <div class="row mt-3 text-center">
                    <div class="col-md-4">
                        <label for="ident"><strong>Peso do Produto (em Quilogramas/Litros)</strong></label>
                        <input type="text" class="form-control" name="peso" required id="ident">
                        <small><strong>Ex.: 1kg ou 1.5L (Utilize ponto como vírgula)</strong></small>
                        
                    </div>
                    <div class="col-md-4">
                        <label for="tipo"><strong>Tipo do Produto</strong></label>
                        <select style="font-weight: bold; width:80%" class="custom-select  mx-auto" required name="tipo" id="tipo">
                            <option value="0" selected disabled>Escolha o tipo do Produto</option>
                            <option value="1" >Perecível</option>
                            <option value="2">Não Perecível</option>
                        </select>
                      
                    </div>
                        
                        <div class="col-md-4">
                    
                           
                            <label for="value"><strong>Valor do Produto</strong></label>
                            <input type="text" class="form-control" name="valor" required id="value">
                            <small><strong>Ex.: 100.00 (Utilize ponto como vírgula)</strong></small>
                      
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 text-center">
                            
                                
                            <label for="desc"><strong>Descrição do Produto</strong></label>
                            <textarea   style="font-weight: bold; resize: none; " class="form-control mx-auto" required name="desc"  id="value"> </textarea>
                            
                    
                        </div>
                        
                    </div>
                    <div class="row mt-3">

                        <div class="col-md-2 text-center">
                            <a href="menuAdd.php" class="btn btn-lg mx-auto" id="voltar" style="width: 100%;" ><i class="far fa-hand-point-left"></i> Voltar  </a>
                        </div>
                        <div class="col-md-4 text-center">
                            <a href="listProd.php" class="btn btn-lg mx-auto" id="mandar" style="width: 100%;" > Listar Produtos <i class="fas fa-list"></i> </a>
                        </div>
                        

                        <div class="col-md-4 text-center">
                            <button type="reset" class="btn btn-lg mx-auto" id="apagar" style="width: 100%;" >Apagar Valores <i class="fas fa-backspace"></i> </button>
                        </div>
                        <div class="col-md-2 text-center">
                        <button type="submit" id="enviar" class="btn mx-auto btn-lg" style="width: 100%;" >Enviar <i class="far fa-paper-plane"></i> </button>

                        </div>
                        
                    </div>

                </div>
                
            </div>
            
            
        </form>
    </div>
<?php 
    include_once '_includes/arqBaixo.php';
?>