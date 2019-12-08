<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <style>
body {
  background: #007bff;
  background: linear-gradient(to right, #0062E6, #33AEFF);
}
.container{
    background:#fff;
}
    </style>
</head>
<body>
<?php
        session_start();

        if($_SESSION["user"]==null){
            header("Location: index.php");
            if($_SESSION["admin"]!=true){
                header("Location: index.php");
            }
        }
    ?>
    <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <a class="navbar-brand" href="#">Testujsie.pl</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
        <a class="nav-link" href="logout.php">Logout
            <span class="sr-only">(current)</span>
        </a>
    </ul>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <?php
          

        ?>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="js/jquery.slim.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>