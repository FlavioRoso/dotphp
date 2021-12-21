<?
    $this->viewData["titulo"] = "Categoria";
    $listaCategoria = $this->getData("listaCategorias");

?>

<div class="card">

    <div class="card-header row">
        <h4 class="card-title col">

            <?=$this->viewData["titulo"]?>
        </h4>
        <div class="text-right  col">
             <a href="@/categoria/novo"  class="btn btn-primary btn-round btn-icon text-light">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>
    <table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Nome</th>
            <th>CategoriaPai</th>
            <th>Ações</th>

        </tr>
    </thead>
    <tbody>
   
        <?
            if($listaCategoria)
            {
                foreach($listaCategoria as $categoria)
                {
                    $nomeCategoriaPai = "---";
                    if($categoria->getCategoriaPai())
                    {
                        $nomeCategoriaPai = $categoria->getCategoriaPai()->getNome();
                    }

                    echo '
                    <tr>
                        <td class="text-center">'.$categoria->getId().'</td>
                        <td>'.$categoria->getNome().'</td>
                        <td>'.$nomeCategoriaPai.'</td>
                        <td class="td-actions text-left">
                           
                            <a href="@/categoria/editar/'.$categoria->getId().'"  rel="tooltip" class="btn btn-success btn-sm btn-icon">
                                <i class="now-ui-icons ui-2_settings-90"></i>
                            </a>
                            <a href="@/categoria/deletar/'.$categoria->getId().'"  rel="tooltip" class="btn btn-danger btn-sm btn-icon "  onclick="popIreverssivel(event,this)">
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
