<?
$this->viewData["titulo"] = "Editar funcionario";
$funcionario = $this->getData("funcionario");
$listaCategoria = $this->getData("listaCategorias");

$this->section("scripts", '

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
        <form method="post" action="@/funcionario/editar/<?= $funcionario->getId() ?>">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="nome">Nome *</label>
                    <input type="text" class="form-control" value="<?= $funcionario->getNome() ?>" name="nome" id="nome" placeholder="Nome Completo" required>
                </div>



                <div class="form-group col-md-3">
                    <label for="login">Login *</label>
                    <input type="text" class="form-control" value="<?= $funcionario->getLogin() ?>" name="login" id="login" placeholder="Login" required>
                </div>

                <div class="form-group col-md-3">
                    <label for="senha">Senha *</label>
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Sua senha">
                </div>
              
                <div class="form-group col-md-3">
                    <label for="papel">Papel *</label>
                    <select class="selectpicker" data-style="btn btn-primary btn-round" title="Selecione Papel" name="papel" required>
                        <?
                            foreach ($funcionario->getArrayPapeis() as $key => $papel) {

                                $selecionado = $funcionario->getPapel() == $key ? "selected" : "";
                                echo '<option value="' . $key . '" '.$selecionado.' >' . $papel . '</option>';
                            }
                        ?>
                    </select>

                </div>
            </div>

            <hr>

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="cep">Cep *</label>
                    <input type="text" class="form-control" value="<?= $funcionario->getCep() ?>" name="cep" id="cep" placeholder="Cep" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="logradouro">Endereço *</label>
                    <input type="text" class="form-control" value="<?= $funcionario->getLogradouro() ?>" name="logradouro" id="logradouro" placeholder="Nome da Rua" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="numero">Numero *</label>
                    <input type="text" class="form-control" value="<?= $funcionario->getNumero() ?>" name="numero" id="numero" placeholder="Numero do Logradouro" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="bairro">Bairro *</label>
                    <input type="text" class="form-control" value="<?= $funcionario->getBairro() ?>" name="bairro" id="bairro" placeholder="Nome do Bairro" required>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-4">
                    <label for="cidade">Cidade *</label>
                    <input type="text" class="form-control" value="<?= $funcionario->getCidade() ?>" name="cidade" id="cidade" readonly required>
                </div>
                <div class="form-group col-md-4">
                    <label for="estado">Estado *</label>
                    <input type="text" class="form-control" value="<?= $funcionario->getUf() ?>" name="uf" id="uf" readonly required>

                </div>
                <div class="form-group col-md-4">
                    <label for="complemento">Complemento</label>
                    <input type="text" class="form-control" value="<?= $funcionario->getComplemento() ?>" name="complemento" id="complemento" placeholder="">
                </div>

            </div>


            <button type="submit" value="Enviar" name="editar" class="btn btn-primary">Editar</button>
            <a href="@/funcionario" type="submit" value="Enviar" name="cadastrar" class="btn ">Voltar</a>
        </form>
    </div>
</div>