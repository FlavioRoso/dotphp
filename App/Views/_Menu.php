<?

use App\Models\Funcionario;
use App\Controllers\Auth\Auth;

$titulo = isset($this->viewData["titulo"]) ? $this->viewData["titulo"] : "";


function menuAtivo($nome, $controler)
{
  return strtolower($controler) == strtolower($nome) ? "active" : "";
}

?>

<li class="<?= menuAtivo("dashboard", $titulo) ?>">
  <a href="@/dashboard">
    <i class="now-ui-icons design_app"></i>
    <p>Dashboard</p>
  </a>
</li>

<li class="<?= menuAtivo("emprestimo", $titulo) ?>">
  <a href="@/emprestimo">
    <i class="now-ui-icons location_bookmark"></i>
    <p>Emprestimo</p>
  </a>
</li>

<li class="<?= menuAtivo("categoria", $titulo) ?>">
  <a href="@/categoria">
    <i class="now-ui-icons shopping_tag-content"></i>
    <p>Categoria</p>
  </a>
</li>

<li class="<?= menuAtivo("cliente", $titulo) ?>">
  <a href="@/cliente">
    <i class="now-ui-icons users_circle-08"></i>
    <p>Cliente</p>
  </a>
</li>

<?
if (Auth::validaPermissao([Funcionario::administrador])) { ?>
  <li class="<?= menuAtivo("funcionario", $titulo) ?>">
    <a href="@/funcionario">
      <i class="now-ui-icons business_badge"></i>
      <p>Funcionario</p>
    </a>
  </li>

  <li class="<?= menuAtivo("parametrizacao", $titulo) ?>">
    <a href="@/parametrizacao">
      <i class="now-ui-icons loader_gear"></i>
      <p>Parametrizacao</p>
    </a>
  </li>
<? } ?>