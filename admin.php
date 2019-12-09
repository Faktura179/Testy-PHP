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
.good{
  background:#67CC8E;
}
.pyt{
  margin: 20px 30px;
}
h1{
  padding:30px 0;
}
.odp{
  display:flex;
  justify-content:space-around;
  margin:10px;
}
.popr{
  color:#67CC8E;
}
.niepopr{
  color:#f44336;
}
.xd{
  margin:0 30px;
  padding:6px 30px;
}
.user{
  margin-bottom:30px;
  background:#eee;
  padding:10px;
  border-radius:5px;
}
.uname{
  margin-bottom:10px;
}
#formAdd{
  padding:20px;
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

        function pytanie($pyt, $A,$B,$C,$D, $answer,$popr,$niepopr, $ID){
          $pyt = htmlspecialchars($pyt);
          $A = htmlspecialchars($A);
          $B = htmlspecialchars($B);
          $C = htmlspecialchars($C);
          $D = htmlspecialchars($D);

          $item = "<div class='card pyt'><div class='card-header text-center'>".$pyt."</div>";
          $item .= "<ul class='list-group list-group-flush'>";
          $item .= "<li class='list-group-item ".($answer=="A"? "good":null)."'><label>".$A."</label></li>";
          $item .= "<li class='list-group-item ".($answer=="B"? "good":null)."'><label>".$B."</label></li>";
          $item .= "<li class='list-group-item ".($answer=="C"? "good":null)."'><label>".$C."</label></li>";
          $item .= "<li class='list-group-item ".($answer=="D"? "good":null)."'><label>".$D."</label></li>";
          $item .= "</ul>";          
          $item .= "</div>";
          $item .= "<div class='odp'><div class='popr'>Poprawne odpowiedzi: ".$popr."</div><div class='niepopr'>Niepoprawne odpowiedzi: ".$niepopr."</div></div>";
          $item .= "<div class=''><a href='admin.php?nav=editQue&ID=".$ID."' class='btn btn-primary xd'>Edytuj</a><a href='delete.php?item=question&ID=".$ID."' class='btn btn-primary xd'>Usuń</a></div>";
          $item .= "<hr/>";
          return $item;
        }
    ?>
    <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <a class="navbar-brand" href="admin.php">Testujsie.pl</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="admin.php?nav=pyt">Pytania</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="admin.php?nav=users">Użytkownicy</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="admin.php?nav=stats">Rankingi</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="admin.php?nav=addQue">Dodaj pytanie</a>
      </li>
    </ul>
    <div class="nav-item active">
        <a class="nav-link btn" style="color:#fff;" href="logout.php">Logout
        </a>
    </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <?php
        $nav = (isset($_GET["nav"])? $_GET["nav"]:"pyt");
        switch ($nav) {
          case "pyt":
            $mysqli = @new mysqli("localhost", "root", "", "stadnik");
            if ($mysqli->connect_errno) {
                echo("Nie udało się zalogować");
            }else{
              $mysqli->set_charset('utf8');
              $query = $mysqli->query("SELECT * FROM pytania");
              echo("<h1>Pytania</h1>");
              while($row = $query->fetch_assoc()){
                echo(pytanie($row["pytanie"],$row["A"],$row["B"],$row["C"],$row["D"],$row["dobra"],$row["poprawne"],$row["niepoprawne"],$row["ID"]));
              }
              $mysqli->close();
            }
          break;
          case "users":
            $mysqli = @new mysqli("localhost", "root", "", "stadnik");
            if ($mysqli->connect_errno) {
                echo("Nie udało się zalogować");
            }else{
              $mysqli->set_charset('utf8');
              $query = $mysqli->query("SELECT * FROM users");
              echo("<h1>Użytkownicy</h1>");
              while($row = $query->fetch_assoc()){
                $str = "<div class='odp'><div class='popr'>Poprawne odpowiedzi: ".$row["poprawne"]."</div><div class='niepopr'>Niepoprawne odpowiedzi: ".$row["niepoprawne"]."</div></div>";
                echo("<div class='user'><div class='uname'>Nazwa użytkownika:<br> <b>".$row["username"]."</b></div>".$str."<div><a href='delete.php?item=user&username=".$row["username"]."' class='btn btn-primary xd'>Usuń</a></div></div>");
              }
              echo("<hr>");
              $mysqli->close();
            }
          break;
          case "stats":
            $mysqli = @new mysqli("localhost", "root", "", "stadnik");
            if ($mysqli->connect_errno) {
                echo("Nie udało się zalogować");
            }else{
              $mysqli->set_charset('utf8');
              $query = $mysqli->query("SELECT * FROM pytania ORDER BY niepoprawne DESC LIMIT 10");
              echo("<h1>Rankingi</h1>");
              echo("<div class='card pyt'><div class='card-header text-center'>Top najtrudniejszych odpowiedzi (liczbowo)</div><ul class='list-group list-group-flush'>");
              while($row = $query->fetch_assoc()){
                echo("<li class='list-group-item'><div>Pytanie: ".$row["pytanie"]."</div>"."<div>ID: ".$row["ID"]."</div>"."<div class='niepopr'> Złe odpowiedzi: ".$row["niepoprawne"]."</div></li>");
              }
              echo("</ul></div>");

              $query = $mysqli->query("SELECT * FROM pytania ORDER BY (niepoprawne/(niepoprawne+poprawne)) DESC LIMIT 10");
              echo("<div class='card pyt'><div class='card-header text-center'>Top najtrudniejszych odpowiedzi (procentowo)</div><ul class='list-group list-group-flush'>");
              while($row = $query->fetch_assoc()){
                echo("<li class='list-group-item'><div>Pytanie: ".$row["pytanie"]."</div>"."<div>ID: ".$row["ID"]."</div>"."<div class='niepopr'>Procent złych odpowiedzi: ".($row["niepoprawne"]/($row["poprawne"]+$row["niepoprawne"])*100)."%</div></li>");
              }
              echo("</ul></div>");

              $query = $mysqli->query("SELECT * FROM users ORDER BY poprawne DESC LIMIT 10");
              echo("<div class='card pyt'><div class='card-header text-center'>Top najlepszych użytkowników (liczbowo)</div><ul class='list-group list-group-flush'>");
              while($row = $query->fetch_assoc()){
                echo("<li class='list-group-item'><div>Nazwa użytkownika: ".$row["username"]."</div><div class='popr'>Dobre odpowiedzi: ".$row["poprawne"]."</div></li>");
              }
              echo("</ul></div>");

              $query = $mysqli->query("SELECT * FROM users ORDER BY (poprawne/(niepoprawne+poprawne)) DESC LIMIT 10");
              echo("<div class='card pyt'><div class='card-header text-center'>Top najlepszych użytkowników (procentowo)</div><ul class='list-group list-group-flush'>");
              while($row = $query->fetch_assoc()){
                if($row["poprawne"]+$row["niepoprawne"]==0){
                  echo("<li class='list-group-item'><div>Nazwa użytkownika: ".$row["username"]."</div><div class='popr'>Procent dobrych odpowiedzi: 0%</div></li>");
                }else{
                  echo("<li class='list-group-item'><div>Nazwa użytkownika: ".$row["username"]."</div><div class='popr'>Procent dobrych odpowiedzi: ".($row["poprawne"]/($row["poprawne"]+$row["niepoprawne"])*100)."%</div></li>");
                }
              }
              echo("</ul></div>");

              echo("<hr>");
              $mysqli->close();
            }
          break;
          case "addQue":
            ?>
            <h1>Dodaj pytanie</h1>
              <form action="addQuestion.php" method="post" id="formAdd">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" >Pytanie</span>
                  </div>
                  <input type="text" name="pytanie" class="form-control">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" >A</span>
                  </div>
                  <input type="text" name="A" class="form-control">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" >B</span>
                  </div>
                  <input type="text" name="B" class="form-control">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" >C</span>
                  </div>
                  <input type="text" name="C" class="form-control">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" >D</span>
                  </div>
                  <input type="text" name="D" class="form-control">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Dobra odpowiedź</span>
                  </div>  
                  <select class="custom-select" name="dobre">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                  <select>
                </div>
                <input type="submit" value="Dodaj" class="btn btn-primary">
              </form>
            <?php
          break;
          case "editQue":
            $mysqli = @new mysqli("localhost", "root", "", "stadnik");
            if ($mysqli->connect_errno) {
                echo("Nie udało się zalogować");
            }else{
              $mysqli->set_charset('utf8');
              $query = $mysqli->query("SELECT * FROM pytania WHERE ID='".$_GET["ID"]."'");
              while($row = $query->fetch_assoc()){
            ?>
            <h1>Edytuj pytanie</h1>
              <form action="edit.php" method="post" id="formAdd">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" >Pytanie</span>
                  </div>
                  <input type="text" name="pytanie" class="form-control" value="<?php echo(htmlspecialchars($row["pytanie"])); ?>">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" >A</span>
                  </div>
                  <input type="text" name="A" class="form-control" value="<?php echo(htmlspecialchars($row["A"])); ?>">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" >B</span>
                  </div>
                  <input type="text" name="B" class="form-control" value="<?php echo(htmlspecialchars($row["B"])); ?>">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" >C</span>
                  </div>
                  <input type="text" name="C" class="form-control" value="<?php echo(htmlspecialchars($row["C"])); ?>">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" >D</span>
                  </div>
                  <input type="text" name="D" class="form-control" value="<?php echo(htmlspecialchars($row["D"])); ?>">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Dobra odpowiedź</span>
                  </div>  
                  <select class="custom-select" name="dobre">
                    <option value="A" <?php echo($row["dobra"]=="A"?"selected":null); ?>>A</option>
                    <option value="B" <?php echo($row["dobra"]=="B"?"selected":null); ?>>B</option>
                    <option value="C" <?php echo($row["dobra"]=="C"?"selected":null); ?>>C</option>
                    <option value="D" <?php echo($row["dobra"]=="D"?"selected":null); ?>>D</option>
                  <select>
                </div>
                <input type="submit" value="Zaktualizuj" class="btn btn-primary">
                <input type="hidden" value="<?php echo($row["ID"]); ?>" name="ID">
              </form>
            <?php
            }
            $mysqli->close();
            }
          break;
        }
        ?>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="js/jquery.slim.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>