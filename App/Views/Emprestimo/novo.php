<?
$this->viewData["titulo"] = "Emprestimo";
$cliente = $this->getData("cliente");
$this->section("scripts", '

    <script src="~/clientapp/dist/views/emprestimo/novo.js"></script>

    ');

?>
<script >
var clienteId = <?=$cliente->getId()?>;
</script>

<div id="root"></div>