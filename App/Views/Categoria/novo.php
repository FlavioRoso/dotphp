<?
    $this->viewData["titulo"] = "Novo categoria";
    $listaCategoria = $this->getData("listaCategorias");
?>


<div class="card">
 
   
    <div class="card-header ">
        <h4 class="card-title ">

            <?= $this->viewData["titulo"] ?>
        </h4>

    </div>

    <div class="card-body">
        <form method="post" action="@/categoria/novo">
            <div class="form-row">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="" value="<?=$this->getData("nome")?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="categoriaPai">CategoriaPai</label>
                    <select id="categoriaPai" name="categoriaPai" class="form-control">
                        <option selected value="">--</option>
                        <?
                            if($listaCategoria)
                            {
                               
                                foreach($listaCategoria as $categoria)
                                {
                                    echo '<option  value="'.$categoria->getId().'">'.$categoria->getNome().'</option>';
                                }
                            }
                        
                        ?>
                    </select>
                </div>

            </div>

          
            <button type="submit" value="Enviar" name="cadastrar" class="btn btn-primary">Cadastrar</button>
            <a href="@/categoria" type="submit" value="Enviar" name="cadastrar" class="btn ">Voltar</a>
        </form>
    </div>
</div>