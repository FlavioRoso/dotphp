<?
$this->viewData["titulo"] = "Emprestimo";

$this->section("scripts", '

    <script src="~/lib/js/jquery.inputmask.bundle.js"></script>
    <script src="~/js/Views/Emprestimo/index.js"></script>

    ');
?>

<div class="card">
    <div class="card-header row">
        <h4 class="card-title col">

            <?= $this->viewData["titulo"] ?>
        </h4>
        <div class="col float-right">
            <form action="@/emprestimo" id="formBuscaCliente">
                <div class="input-group no-border">
                    <input type="text" value="" class="form-control" placeholder="Buscar" id="cpf" name="cpf">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <button type="submit" class="bg-transparent border border-light">
                                <i class="now-ui-icons ui-1_zoom-bold"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>