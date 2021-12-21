<?
    $this->viewData["titulo"] = "Editar categoria"; 
    $listaCategoria = $this->getData("listaCategorias");
    $categoria = $this->getData("categoria");

?>


<div class="card">

   
    <div class="card-header ">
        <h4 class="card-title ">

            <?= $this->viewData["titulo"] ?>
        </h4>

    </div>

    <div class="card-body">
        <form method="post" action="@/categoria/editar/<?=$categoria->getId()?>">
            <div class="form-row">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" value="<?=$categoria->getNome()?>" class="form-control" name="nome" id="nome" placeholder="">
                </div>
                <div class="form-group col-md-4">
                    <label for="categoriaPai">CategoriaPai</label>
                    <select id="categoriaPai" name="categoriaPai" class="form-control">
                        <option  value="">--</option>
                        <?
                            if($listaCategoria)
                            {
                                
                                foreach($listaCategoria as $cat)
                                {
                                    $selected = $categoria->getCategoriaPaiId() != null && $cat->getId() == $categoria->getCategoriaPaiId();
                                    echo '<option 
                                            '.($selected  ? "selected" : "").'  
                                            value="'.$cat->getId().'">'.$cat->getNome().'
                                        </option>';
                                }
                            }
                        
                        ?>
                    </select>
                </div>

            </div>

          
            <button type="submit" value="Enviar" name="editar" class="btn btn-primary">Editar</button>
            <a href="@/categoria" type="submit" value="Enviar" name="cadastrar" class="btn ">Voltar</a>
        </form>
    </div>
</div>