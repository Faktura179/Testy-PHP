<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Testujsie.pl</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <style>
body {
  background: #007bff;
  background: linear-gradient(to right, #0062E6, #33AEFF);
}
.container{
    background:#fff;
}
form{
  padding:30px 0;
}
.caly{
  margin:20px 0;
  padding:0 10px;
}
.pytanie{
  background:#ddd;
  padding:5px;
  margin-bottom:5px;
  border-radius:5px;
}
input[type=radio]{
  padding:5px;
  margin-right:10px;
}
h1{
  margin-top:10px;
}
    </style>
</head>
<body>
    <?php
        session_start();

        if($_SESSION["user"]==null){
            header("Location: login.php");  
        }
        if($_SESSION["admin"]==1){
          header("Location: admin.php");
      }
      function createQuestion($question,$A,$B,$C,$D,$id,$i){
        $question = htmlspecialchars($question);
        $A = htmlspecialchars($A);
        $B = htmlspecialchars($B);
        $C = htmlspecialchars($C);
        $D = htmlspecialchars($D);
        $item = "<div class='caly'><div class='pytanie text-center'>".$question."</div>";
        $item .= "<div class='A form-check'><label><input type='radio' name='".$i."odp' value='A'/>".$A."</label></div>";
        $item .= "<div class='B form-check'><label><input type='radio' name='".$i."odp' value='B'/>".$B."</label></div>";
        $item .= "<div class='C form-check'><label><input type='radio' name='".$i."odp' value='C'/>".$C."</label></div>";
        $item .= "<div class='D form-check'><label><input type='radio' name='".$i."odp' value='D'/>".$D."</label></div>";
        $item .= "<input hidden value='".$id."' name='".$i."'>";
        $item .= "</div><hr/>";
        return $item;
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
      <div class="col">
        <h1 class="text-center">Test 10 pytań</h1>
      </div>
    </div>
  <form action="wynik.php" method="post">
    <?php 
    $mysqli = @new mysqli("localhost", "root", "", "stadnik");
    if ($mysqli->connect_errno) {
        echo("Nie udało się zalogować");
    }else{
        $mysqli->set_charset('utf8');
        $query = $mysqli->query("SELECT * FROM pytania ORDER BY RAND() LIMIT 10");
        $i=0;
        while($row = $query->fetch_assoc()){
          echo(createQuestion($row["pytanie"],$row["A"],$row["B"],$row["C"],$row["D"],$row["ID"],$i));
          $i++;
        }
    }
    
    ?>
    <div class="text-center">
      <button type="submit" class="btn btn-primary">Zatwierdź odpowiedzi</button>
    </div>
    </form>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="js/jquery.slim.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>