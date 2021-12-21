<?
$this->viewData["titulo"] = "Novo funcionario";
$listaCategoria = $this->getData("listaCategorias");

    $this->section("scripts",'

        <script src="~/js/util/endereco.js"></script>
        <script src="~/lib/js/jquery.inputmask.bundle.js"></script>
        <script src="~/js/Views/Funcionario/formulario.js"></script>
       
    ');
?>

<div class="card">


    <div class="card-header ">
        <h4 class="card-title ">

            <?= $this->viewData["titulo"] ?>
        </h4>

    </div>

    <div class="card-body">
        <form method="post" action="@/funcionario/novo">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="nome">Nome *</label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome Completo" required>
                </div>

      

                <div class="form-group col-md-3">
                    <label for="login">Login *</label>
                    <input type="text" class="form-control" name="login" id="login" placeholder="Login" required>
                </div>

                <div class="form-group col-md-3">
                    <label for="senha">Senha *</label>
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Sua senha" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="papel">Papel *</label>
                    <select class="selectpicker" data-style="btn btn-primary btn-round" title="Selecione Papel" name="papel" required>
                        <?
                            foreach (App\Models\Funcionario::getArrayPapeis() as $key => $papel) {

                                echo '<option value="' . $key .'">' . $papel . '</option>';
                            }
                        ?>
                    </select>

                </div>
            </div>

            <hr>
     
            <div class="form-row">
            <div class="form-group col-md-2">
                    <label for="cep">Cep *</label>
                    <input type="text" class="form-control" name="cep" id="cep" placeholder="Cep" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="logradouro">Endereço *</label>
                    <input type="text" class="form-control" name="logradouro" id="logradouro" placeholder="Nome da Rua" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="numero">Numero *</label>
                    <input type="text" class="form-control" name="numero" id="numero" placeholder="Numero do Logradouro" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="bairro">Bairro *</label>
                    <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Nome do Bairro" required> 
                </div>
            </div>
            
            <div class="form-row">
               
                <div class="form-group col-md-4">
                    <label for="cidade">Cidade *</label>
                    <input type="text" class="form-control" name="cidade" id="cidade" readonly required>
                </div>
                <div class="form-group col-md-4">
                    <label for="estado">Estado *</label>
                    <input type="text" class="form-control" name="uf" id="uf" readonly  required>
                    
                </div>
                <div class="form-group col-md-4">
                    <label for="complemento">Complemento</label>
                    <input type="text" class="form-control" name="complemento" id="complemento" placeholder="">
                </div>
               
            </div>


            <button type="submit" value="Enviar" name="cadastrar" class="btn btn-primary">Cadastrar</button>
            <a href="@/funcionario" type="submit" value="Enviar" name="cadastrar" class="btn ">Voltar</a>
        </form>
    </div>
</div>