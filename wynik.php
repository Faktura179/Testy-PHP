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
    overflow:auto;
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
.good{
    background:#0f0;
}
.highscores{
    margin:20px 0;
}
.topka{
    padding: 15px 0;
}
    </style>
</head>
<body>
<?php
        session_start();
        function createAnswer($question,$A,$B,$C,$D,$answer,$i,$zazn){
            $question = htmlspecialchars($question);
            $A = htmlspecialchars($A);
            $B = htmlspecialchars($B);
            $C = htmlspecialchars($C);
            $D = htmlspecialchars($D);
            $item = "<div class='caly'><div class='pytanie text-center'>".$question."</div>";
            $item .= "<div class='A form-check ".($answer=="A"? "good":null)."'><label><input type='radio' name='".$i."odp' value='A' disabled ".($zazn=="A"? "checked":null)."/>".$A."</label></div>";
            $item .= "<div class='B form-check ".($answer=="B"? "good":null)."'><label><input type='radio' name='".$i."odp' value='B' disabled ".($zazn=="B"? "checked":null)."/>".$B."</label></div>";
            $item .= "<div class='C form-check ".($answer=="C"? "good":null)."'><label><input type='radio' name='".$i."odp' value='C' disabled ".($zazn=="C"? "checked":null)."/>".$C."</label></div>";
            $item .= "<div class='D form-check ".($answer=="D"? "good":null)."'><label><input type='radio' name='".$i."odp' value='D' disabled ".($zazn=="D"? "checked":null)."/>".$D."</label></div>";
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

<?php
    $wynik=0;
    $mysqli = @new mysqli("localhost", "root", "", "stadnik");
    if ($mysqli->connect_errno) {
        echo("Nie udało się zalogować");
    }else{
        $mysqli->set_charset('utf8');
        for ($i=0; $i < 10; $i++) { 
            if(isset($_POST[$i])){
                $query = $mysqli->query("SELECT * FROM pytania WHERE ID='".$_POST[$i]."'");
                $row = $query->fetch_assoc();
                echo(createAnswer($row["pytanie"],$row["A"],$row["B"],$row["C"],$row["D"],$row["dobra"],$i,$_POST[$i."odp"]));
                if($row["dobra"]==$_POST[$i."odp"]){
                    $wynik++;
                    $query = $mysqli->query("UPDATE pytania SET poprawne=poprawne+1 WHERE ID=".$row["ID"]);
                    $query = $mysqli->query("UPDATE users SET poprawne=poprawne+1 WHERE username='".$_SESSION["user"]."'");
                }else{
                    $query = $mysqli->query("UPDATE pytania SET niepoprawne=niepoprawne+1 WHERE ID=".$row["ID"]);
                    $query = $mysqli->query("UPDATE users SET niepoprawne=niepoprawne+1 WHERE username='".$_SESSION["user"]."'");
                }
            }
        }
        $query = $mysqli->query("INSERT INTO wyniki VALUES (null, '".$_SESSION["user"]."','".$wynik."')");
        echo("<div class='gAns text-center'>Dobre odpowiedzi: ".$wynik."</div>      <div class='precent text-center'>Procent: ".($wynik*10)."%</div>");
        $query = $mysqli->query("SELECT * FROM wyniki ORDER BY wynik DESC LIMIT 10");
        echo("<div class='highscores text-center'><h2>Ranking</h2>");
        $j=1;
        while($row = $query->fetch_assoc()){
            echo("<div class='topka'><div class='position'>Lp. ".$j."</div><div class='username'>Login: ".$row["username"]."</div><div class='score'> Poprawne odp: ".$row["wynik"]."</div></div>");
            $j++;
        }
        echo("</div>");
    }
?>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="js/jquery.slim.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>