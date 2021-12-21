
<?
  use Enkel\Controllers\Message;
  use Enkel\Controllers\Session;
  $usuarioLogado = $this->getData("login");
  $titulo = isset($this->viewData["titulo"]) ? $this->viewData["titulo"] : "";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="~/lib/now-ui/img/apple-icon.png">
  <link rel="icon" type="image/png" href="~/lib/now-ui/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    <?=$titulo?> - Sua Biblioteca
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="~/lib/now-ui/css/bootstrap.min.css" rel="stylesheet" />
  <link href="~/lib/now-ui/css/now-ui-dashboard.min.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="~/lib/now-ui/demo/demo.css" rel="stylesheet" />
  <link href="~/css/site.css" rel="stylesheet" />
  <?=$this->renderSection("styles")?>

</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="@/" class="simple-text logo-mini">
          <img src="~/imagens/logo.png" style="width: 125px;" alt="logo">
        </a>
        <a href="@/" class="simple-text logo-normal mt-2">
          Sua Blibioteca
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
            <?=$this->includeView("_Menu.php")?>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo"><?=$titulo?></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons media-2_sound-wave"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons users_single-02"></i><?=$usuarioLogado["nome"]?>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="@/logout">Logout</a>
                </div>
              </li>
             
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
      <?
        if(Message::hasMessage("sucesso"))
        {
            echo ' 
            <div class="alert alert-success">
                <button type="button" aria-hidden="true" class="close" onclick="removeAlert(this)">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </button>
                <span>'.Message::get("sucesso").'</span>
            </div>';
        }
      ?>

      <?
        if(Message::hasMessage("erro"))
        {
            echo ' 
            <div class="alert alert-danger">
                <button type="button" aria-hidden="true" class="close" onclick="removeAlert(this)">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </button>
                <span><b>Erro: </b>'.Message::get("erro").'</span>
            </div>';
        }
      ?>
          <?=$this->renderBody()?>
      </div>
      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="http://presentation.creative-tim.com">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy; <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed by <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="~/lib/now-ui/js/core/jquery.min.js"></script>
  <script src="~/lib/now-ui/js/core/popper.min.js"></script>
  <script src="~/lib/now-ui/js/core/bootstrap.min.js"></script>
  <script src="~/lib/now-ui/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="~/lib/now-ui/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="~/lib/now-ui/js/plugins/bootstrap-notify.js"></script>
  <script src="~/lib/now-ui/js/plugins/bootstrap-selectpicker.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="~/lib/now-ui/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="~/lib/now-ui/demo/demo.js"></script>
  <script src="~/lib/now-ui/js/sweetalert2.all.min.js"></script>

  <script src="~/js/site.js"></script>
  <script src="~/js/popups.js"></script>

  <?=$this->renderSection("scripts")?>
</body>

</html>