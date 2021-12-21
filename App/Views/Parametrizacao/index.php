<?
    $this->viewData["titulo"] = "Parametrizacao";
    $parametrizacao = $this->getData("parametrizacao");

?>

<div class="card">
 
   
    <div class="card-header ">
        <h4 class="card-title ">

            <?= $this->viewData["titulo"] ?>
        </h4>

    </div>

    <div class="card-body">
        <form method="post" action="@/parametrizacao" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="multaDiaAtraso">Multa por Dias de Atraso</label>
                    <input type="number" step="0.01" class="form-control" name="multaDiaAtraso" id="multaDiaAtraso" placeholder="" value="<?=$parametrizacao->getMultaDiaAtraso()?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="limiteEmprestimoSimultaneos">Limite de emprestimos simultaneos</label>
                    <input type="number" class="form-control" name="limiteEmprestimoSimultaneos" id="limiteEmprestimoSimultaneos" placeholder="" value="<?=$parametrizacao->getLimiteEmprestimoSimultaneos()?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="razaoSocial">Razao Social</label>
                    <input type="text" class="form-control" name="razaoSocial" id="razaoSocial" placeholder="" value="<?=$parametrizacao->getRazaoSocial()?>">
                </div>
                <div>
                    <label for="logo">Logo da empresa</label></br>
                    <input type="file" name="logo" accept="image/*">
                </div>
                <div>
                    <label for="logoAtual">Logo Atual</label></br>
                    <img  name="logoAtual" src="<?=$parametrizacao->getLogo(); ?>" width="150px" height="150px"/></br>
                </div>

            </div>

          
            <button type="submit" value="Enviar" name="cadastrar" class="btn btn-primary">Cadastrar</button>
            <a href="@/parametrizacao" type="submit" value="Enviar" name="cadastrar" class="btn ">Voltar</a>
        </form>
    </div>
</div>