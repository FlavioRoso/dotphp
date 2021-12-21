<?
$this->viewData["titulo"] = "Situacao";


$cliente = $this->getData("cliente");
$situacao = $this->getData("situacao");
$listaEmprestimos = $this->getData("listaEmprestimos");


$this->section("scripts", '

    <script src="~/lib/js/jquery.inputmask.bundle.js"></script>
    <script src="~/js/Views/Emprestimo/index.js"></script>

    ');
?>

<div class="card">
    <div class="card-header row">
        <h4 class="card-title col">Situação de (<?= $cliente->getNome() ?>)</h4>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Capa</th>
                <th>Exemplar</th>
                <th>Data Cadastro</th>
                <th>Data Limite</th>
                <th>Dias de Atraso</th>
                <th>Tipo</th>
                <th>Valor da Multa</th>
                <th>Acoes</th>

            </tr>
        </thead>
        <tbody>

            <?
            if ($listaEmprestimos) 
            {
                foreach ($listaEmprestimos as $emprestimo) 
                {   ?>
                        
                        <tr class="<?= $emprestimo->getAtrasado() ? "linha-pendencia" : '' ?>">
                            <td class="text-center"><?= $emprestimo->getId() ?></td>
                            <td><img style="width: 80px" src="@/<?= $emprestimo->getExemplar()->getLivro()->getImagemCapa() ?>" /></td>
                            <td><?= $emprestimo->getExemplar()->getLivro()->getNome() ?></td>
                            <td><?= date("d/m/Y", strtotime($emprestimo->getDataCadastro())) ?></td>
                            <td><?= date("d/m/Y", strtotime($emprestimo->getDataLimite())) ?></td>
                            <? $situacao->buscarPorEmprestimo($emprestimo->getId()); ?>
                            <td><?= $situacao->getDiasAtraso()?></td>
                            <td><?= $situacao->getTipo() ?></td>
                            <? $valorDaMulta = $situacao->getDiasAtraso() * $situacao->valorMulta();?>
                            <td>R$<?= $valorDaMulta ?></td>
                            <td><a href="@/situacao/regularizar/<?= $situacao->getId() ?>" title="Regularizao Situacao" rel="tooltip" class="btn btn-success btn-sm btn-icon" onclick="popIreverssivel(event,this)">
                                        <i class="now-ui-icons ui-1_check"></i>
                                    </a></td>
                        </tr>
            <? 
                }
            }

            ?>

        </tbody>
    </table>
</div>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Informações Cliente</h4>

    </div>
    <div class="card-body">
        <form method="post" action="@/cliente/editar/<?= $cliente->getId() ?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Nome</label>
                    <input type="text" class="form-control" value="<?= $cliente->getNome() ?>" name="nome" id="nome" placeholder="Nome Completo" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">CPF</label>
                    <input type="text" class="form-control" value="<?= $cliente->getCpf() ?>" name="cpf" id="cpf" placeholder="CPF" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail4">Email</label>
                <input type="text" class="form-control" value="<?= $cliente->getEmail() ?>" name="email" id="inputEmail4" placeholder="Email" disabled>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Telefone</label>
                    <input type="text" class="form-control" value="<?= $cliente->getTelefone() ?>" name="telefone" id="telefone" placeholder="(99)9999-9999" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Celular</label>
                    <input type="text" class="form-control" value="<?= $cliente->getCelular() ?>" name="celular" id="celular" placeholder="(99)99999-9999" disabled>
                </div>
            </div>
            <hr>

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="cep">Cep *</label>
                    <input type="text" class="form-control" value="<?= $cliente->getCep() ?>" name="cep" id="cep" placeholder="Cep" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="logradouro">Endereço *</label>
                    <input type="text" class="form-control" value="<?= $cliente->getLogradouro() ?>" name="logradouro" id="logradouro" placeholder="Nome da Rua" disabled>
                </div>
                <div class="form-group col-md-2">
                    <label for="numero">Numero *</label>
                    <input type="text" class="form-control" value="<?= $cliente->getNumero() ?>" name="numero" id="numero" placeholder="Numero do Logradouro" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="bairro">Bairro *</label>
                    <input type="text" class="form-control" value="<?= $cliente->getBairro() ?>" name="bairro" id="bairro" placeholder="Nome do Bairro" disabled>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-4">
                    <label for="cidade">Cidade *</label>
                    <input type="text" class="form-control" value="<?= $cliente->getCidade() ?>" name="cidade" id="cidade" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="estado">Estado *</label>
                    <input type="text" class="form-control" value="<?= $cliente->getUf() ?>" name="uf" id="uf" disabled>

                </div>
                <div class="form-group col-md-4">
                    <label for="complemento">Complemento</label>
                    <input type="text" class="form-control" value="<?= $cliente->getComplemento() ?>" name="complemento" id="complemento" placeholder="" disabled>
                </div>

            </div>

    </div>
</div>