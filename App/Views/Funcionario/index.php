<?
    $this->viewData["titulo"] = "Funcionario";
    $listaFuncionarios = $this->getData("listaFuncionarios");
    
?>

<div class="card">

    <div class="card-header row">
        <h4 class="card-title col">

            <?=$this->viewData["titulo"]?>
        </h4>
        <div class="text-right  col">
             <a href="@/funcionario/novo"  class="btn btn-primary btn-round btn-icon text-light">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>
    <table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Nome</th>
            <th>Papel</th>
            <th>Endereço</th>
            <th>Ações</th>

        </tr>
    </thead>
    <tbody>
   
        <?
            if($listaFuncionarios)
            {
                foreach($listaFuncionarios as $funcionario)
                {
                   
                    echo '
                    <tr>
                        <td class="text-center">'.$funcionario->getId().'</td>
                        <td>'.$funcionario->getNome().'</td>
                        <td>'.$funcionario->getArrayPapeis()[$funcionario->getPapel()].'</td>
                        <td>'.$funcionario->getEnderecoFormatado().'</td>
                        <td class="td-actions text-left">
                           
                            <a href="@/funcionario/editar/'.$funcionario->getId().'"  rel="tooltip" class="btn btn-success btn-sm btn-icon">
                                <i class="now-ui-icons ui-2_settings-90"></i>
                            </a>
                            <a href="@/funcionario/deletar/'.$funcionario->getId().'"  rel="tooltip" class="btn btn-danger btn-sm btn-icon "  onclick="popIreverssivel(event,this)">
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
