<?
$this->layout = "_LayoutConfiguracao";
$this->section("scripts", '

<script src="~/js/util/endereco.js"></script>
<script src="~/lib/js/jquery.inputmask.bundle.js"></script>
<script src="~/js/Views/Funcionario/formulario.js"></script>

');

?>
<div class="wrapper wrapper-full-page ">

    <div class="full-page lock-page section-image" filter-color="black" data-image="../../assets/img/bg13.jpg">
        <!--   you can change the color of the filter page using: data-color="blue | green | orange | red | purple" -->

        <div class="content text-center">
            <img src="~/imagens/logo.png" class="m-3" alt="logo">
            <div class="container">
                <div class="ml-auto mr-auto">


                    <div class="card card-lock text-left">

                        <div class="card-header text-center" style="font-size: 16px;">
                            <h1>Bem Vindo ao Sua Biblioteca</h1>
                            <p>Realize o Cadastro do primeiro usuario e parametrizações do sistema</p>
                        </div>

                        <div class="card-body ">
                            <form method="post" action="@/configuracao/novo">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
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
                                    </div></br>
                                     <hr>
                                   
                                        <div class="form-group col-md-4">
                                            <label for="multaDiaAtraso">Multa por Dias de Atraso</label>
                                            <input type="number" step="0.01" class="form-control" name="multaDiaAtraso" id="multaDiaAtraso" placeholder="" value="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="limiteEmprestimoSimultaneos">Limite de emprestimos simultaneos</label>
                                            <input type="number" class="form-control" name="limiteEmprestimoSimultaneos" id="limiteEmprestimoSimultaneos" placeholder="" value="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="razaoSocial">Razao Social</label>
                                            <input type="text" class="form-control" name="razaoSocial" id="razaoSocial" placeholder="" value="">
                                        </div>
                        
                                    <div class="card-footer ">
                                        <button type="submit" name="cadastrar" class="btn btn btn-primary btn-round btn-lg">Cadastrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>