<?
$this->viewData["titulo"] = "Editar Cliente";

$listaCliente = $this->getData("listaCliente");
$cliente = $this->getData("cliente");
$this->section("scripts", '

    <script src="~/js/util/endereco.js"></script>
    <script src="~/lib/js/jquery.inputmask.bundle.js"></script>
    <script src="~/js/Views/Cliente/formulario.js"></script>

    ');
?>

<div class="card">
    <div class="card-header">
        <h4 class="card-title"> <?= $this->viewData["titulo"] ?></h4>

    </div>
    <div class="card-body">
        <form method="post" action="@/cliente/editar/<?= $cliente->getId() ?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Nome</label>
                    <input type="text" class="form-control" value="<?= $cliente->getNome() ?>" name="nome" id="nome" placeholder="Nome Completo">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">CPF</label>
                    <input type="text" class="form-control" value="<?= $cliente->getCpf() ?>" name="cpf" id="cpf" placeholder="CPF">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail4">Email</label>
                <input type="text" class="form-control" value="<?= $cliente->getEmail() ?>" name="email" id="inputEmail4" placeholder="Email">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Telefone</label>
                    <input type="text" class="form-control" value="<?= $cliente->getTelefone() ?>" name="telefone" id="telefone" placeholder="(99)9999-9999">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Celular</label>
                    <input type="text" class="form-control" value="<?= $cliente->getCelular() ?>" name="celular" id="celular" placeholder="(99)99999-9999">
                </div>
            </div>
            <hr>

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="cep">Cep *</label>
                    <input type="text" class="form-control" value="<?= $cliente->getCep() ?>" name="cep" id="cep" placeholder="Cep" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="logradouro">Endereço *</label>
                    <input type="text" class="form-control" value="<?= $cliente->getLogradouro() ?>" name="logradouro" id="logradouro" placeholder="Nome da Rua" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="numero">Numero *</label>
                    <input type="text" class="form-control" value="<?= $cliente->getNumero() ?>" name="numero" id="numero" placeholder="Numero do Logradouro" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="bairro">Bairro *</label>
                    <input type="text" class="form-control" value="<?= $cliente->getBairro() ?>" name="bairro" id="bairro" placeholder="Nome do Bairro" required>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-4">
                    <label for="cidade">Cidade *</label>
                    <input type="text" class="form-control" value="<?= $cliente->getCidade() ?>" name="cidade" id="cidade" readonly required>
                </div>
                <div class="form-group col-md-4">
                    <label for="estado">Estado *</label>
                    <input type="text" class="form-control" value="<?=$cliente->getUf() ?>" name="uf" id="uf" readonly required>

                </div>
                <div class="form-group col-md-4">
                    <label for="complemento">Complemento</label>
                    <input type="text" class="form-control" value="<?= $cliente->getComplemento() ?>" name="complemento" id="complemento" placeholder="">
                </div>

            </div>
            <button type="submit" name="editar" class="btn btn-primary">Editar</button>
            <a href="@/cliente" type="submit" value="Enviar" name="cadastrar" class="btn ">Voltar</a>
        </form>
    </div>
</div>