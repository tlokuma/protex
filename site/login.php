<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Login</title>
  </head>
  <body id="bodylogin">
    <div class="card" id="telalogin">
        <!-- <img class="card-img-top" src=".../100px180/" alt="Imagem de capa do card"> -->
        <div class="card-body ">
            <form action="testelogin.php" method="POST">
                <div class="form-group ">
                  <input type="username" name="login" style="color:#308a9c;" class="form-control lgnbtn" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" id="" aria-describedby="emailHelp" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name ="senha" style="color:#308a9c;"  class="form-control lgnbtn" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" id="" placeholder="Password">
                </div>
                <div class="form-group form-check">
                </div>
                <button type="submit" name="submit" id="submit" class="btn btn-outline-login btnlogin">Enviar</button>
            </form>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
 
  </body>
</html>