<?
$this->viewData["titulo"] = "Cliente";
$listaCliente = $this->getData("listaCliente");



$this->section("styles", '

    ');

$this->section("scripts", '
    <script src="~/js/Views/Cliente/FuncDatatable.js"></script>
    <script src="~/lib/now-ui/js/datatables/jquery.dataTables.min.js"></script>
    ');

?>

<div class="card">

    <div class="card-header row">
        <h4 class="card-title col">

            <?= $this->viewData["titulo"] ?>
        </h4>
        <div class="text-right  col">
            <a href="@/cliente/novo" class="btn btn-primary btn-round btn-icon text-light">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

    <div class="card-body">
        <table  id="tabelaCliente" class="table table-striped table-bordered dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable_info" style="width: 100%;">
            <thead>
                <tr role="row">
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 254px;" aria-label="Position: activate to sort column ascending">Nome</th>
                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Office: activate to sort column ascending">Email</th>
                    <th class="disabled-sorting text-right" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 0px;" aria-label="Age: activate to sort column ascending">Ações</th>
                </tr>
            </thead>
            <tfoot>

            </tfoot>
            <tbody>

                <?
                if ($listaCliente) {
                    foreach ($listaCliente as $cliente) {

                        echo '
                    <tr>
                        <td class="">' . $cliente->getId() . '</td>
                        <td>' . $cliente->getNome() . '</td>
                        <td>' . $cliente->getEmail() . '</td>
                        <td class="td-actions text-right">
                           
                            <a href="@/cliente/editar/' . $cliente->getId() . '"  rel="tooltip" class="btn btn-success btn-sm btn-icon">
                                <i class="now-ui-icons ui-2_settings-90"></i>
                            </a>
                            <a href="@/cliente/deletar/' . $cliente->getId() . '"  rel="tooltip" class="btn btn-danger btn-sm btn-icon "  onclick="popIreverssivel(event,this)">
                                <i class="now-ui-icons ui-1_simple-remove"></i>
                            </a>
                        </td>
                    </tr>
                    
                    ';
                    }
                }

                ?>
            </tbody>
        </table>
    </div>
</div>