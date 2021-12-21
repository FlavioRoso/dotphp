<?
    $this->layout = null;
    use Enkel\Controllers\Message;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="~/lib/now-ui/css/bootstrap.min.css">
    <link rel="stylesheet" href="~/css/site.css">
    <title>login</title>
    <style>
   
    </style>
</head>
<body>
    
    <main>
    
        <section class="h-100 gradient-form" style="background-color: #eee;">
        <?
          if(Message::hasMessage("erro"))
          {
              echo ' 
              <div class="alert alert-danger">
                  <span><b>Erro: </b>'.Message::get("erro").'</span>
              </div>';
          }
        ?>
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                  <div class="card rounded-3 text-black">
                    <div class="row g-0">
                      <div class="col-lg-6">
                        <div class="card-body p-md-5 mx-md-4">
          
                          <div class="text-center">
                            <img src="~/imagens/logo.png" style="width: 125px;" alt="logo">
                            <h4 class="mt-1 mb-5 pb-1">Sua biblioteca</h4>
                          </div>
          
                          <form action="@/auth" method="POST">
                            <p>Faça seu login</p>
          
                            <div class="form-outline mt-1">
                              <input type="text" id="login" class="form-control" name="login" placeholder="Login" required />
                              <label class="form-label" for="login">Login</label>
                            </div>
          
                            <div class="form-outline mt-1">
                              <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha"  required />
                              <label class="form-label" for="senha">Senha</label>
                            </div>
          
                            <div class="text-center pt-1 mb-5 pb-1">
                              <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="btnLogin" value="login">Log in</button>
                              <a class="text-muted" href="#!">Esqueceu a senha?</a>
                            </div>
          
                            <div class="d-flex align-items-center justify-content-center pb-4">

                            </div>
          
                          </form>
          
                        </div>
                      </div>
                      <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                        <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                          <h4 class="mb-4">Não é apenas um sistema de biblioteca.</h4>
                          <p class="small mb-0">O sistema “Sua Biblioteca” tem como principal objetivo facilitar o máximo possível a independência do funcionário de papéis e cadernos de anotações, minimizando o tempo de trabalho e maximizando o número de clientes atendidos. Com sua interface intuitiva e eficaz, o software garante uma boa experiência tanto para o funcionário , quanto para o cliente. </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </main>
</body>
</html>

