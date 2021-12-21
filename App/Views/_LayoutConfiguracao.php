
<?
  use Enkel\Controllers\Message;
  use Enkel\Controllers\Session;
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

    <?=$this->renderBody()?>

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