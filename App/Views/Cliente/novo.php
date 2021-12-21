<?
$this->viewData["titulo"] = "Cadastrar Cliente";
$this->section("scripts", '

<script src="~/js/util/endereco.js"></script>
<script src="~/lib/js/jquery.inputmask.bundle.js"></script>
<script src="~/js/Views/Cliente/formulario.js"></script>


');

?>

<div class="card">
    <div class="card-header">
        <h4 class="card-title"> Novo Cliente</h4>

    </div>
    <div class="card-body">
            <form method="post" action="@/cliente/novo">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Nome *</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome Completo" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">CPF *</label>
                        <input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Email *</label>
                    <input type="text" class="form-control" name="email" id="inputEmail4" placeholder="Email" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Telefone</label>
                        <input type="text" class="form-control" name="telefone" id="telefone" placeholder="(99)9999-9999" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Celular *</label>
                        <input type="text" class="form-control" name="celular" id="celular" placeholder="(99)99999-9999" required>
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
                        <input type="text" class="form-control" name="uf" id="uf" readonly required>

                    </div>
                    <div class="form-group col-md-4">
                        <label for="complemento">Complemento</label>
                        <input type="text" class="form-control" name="complemento" id="complemento" placeholder="">
                    </div>

                </div>
                <button type="submit" name="cadastrar" class="btn btn-primary">Cadastrar</button>
                <a href="@/cliente" type="submit" value="Enviar" name="cadastrar" class="btn ">Voltar</a>
            </form>
        </div>
    </div>