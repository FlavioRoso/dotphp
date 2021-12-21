<?
    $this->viewData["titulo"] = "Emprestimo";
    $situacao = $this->getData("situacao");
    $emprestimo = $this->getData("emprestimo");
    $cliente = $this->getData("cliente");
?>

<div class="card">


    <div class="card-header ">
        <h4 class="card-title ">
            Resolver situação 
        </h4>

    </div>

    <div class="card-body">
        <form method="post" action="@/emprestimo/situacao/<?=$emprestimo->getId()?>">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="papel">Tipo Resolucao *</label>
                    <select class="selectpicker" data-style="btn btn-primary btn-round" title="Selecione Tipo" name="tipo" required>
                        <?
                            foreach ($situacao->getArrayTipos() as $key => $tipo) {

                                echo '<option value="' . $key .'">' . $tipo . '</option>';
                            }
                        ?>
                    </select>

                </div>

               

           
            </div>

            <hr>
     
            <div class="form-row">
            <div class="form-group col-md-5">
                    <label for="papel">Motivo do atraso *</label>
                    <textarea name="descricao" class="form-control" id="" name="descricao" rows="6" required ></textarea>

                </div>
            </div>


            <button type="submit" value="Enviar" name="resolver" class="btn btn-primary">Resolver Situacao</button>
            <a href="@/emprestimo/cliente/<?=$cliente->getCpf()?>" type="submit" value="Enviar" name="cadastrar" class="btn ">Voltar</a>
        </form>
    </div>
</div>