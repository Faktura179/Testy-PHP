<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Testujsie.pl</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <style>
:root {
  --input-padding-x: 1.5rem;
  --input-padding-y: .75rem;
}

body {
  background: #007bff;
  background: linear-gradient(to right, #0062E6, #33AEFF);
}

.card-signin {
  border: 0;
  border-radius: 1rem;
  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

.card-signin .card-title {
  margin-bottom: 2rem;
  font-weight: 300;
  font-size: 1.5rem;
}

.card-signin .card-img-left {
  width: 45%;
  /* Link to your background image using in the property below! */
  background: scroll center url('https://source.unsplash.com/WEQbe2jBg40/414x512');
  background-size: cover;
}

.card-signin .card-body {
  padding: 2rem;
}

.form-signin {
  width: 100%;
}

.form-signin .btn {
  font-size: 80%;
  border-radius: 5rem;
  letter-spacing: .1rem;
  font-weight: bold;
  padding: 1rem;
  transition: all 0.2s;
}

.form-label-group {
  position: relative;
  margin-bottom: 1rem;
}

.form-label-group input {
  height: auto;
  border-radius: 2rem;
}

.form-label-group>input,
.form-label-group>label {
  padding: var(--input-padding-y) var(--input-padding-x);
}

.form-label-group>label {
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 100%;
  margin-bottom: 0;
  /* Override default `<label>` margin */
  line-height: 1.5;
  color: #495057;
  border: 1px solid transparent;
  border-radius: .25rem;
  transition: all .1s ease-in-out;
}

.form-label-group input::-webkit-input-placeholder {
  color: transparent;
}

.form-label-group input:-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-moz-placeholder {
  color: transparent;
}

.form-label-group input::placeholder {
  color: transparent;
}

.form-label-group input:not(:placeholder-shown) {
  padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
  padding-bottom: calc(var(--input-padding-y) / 3);
}

.form-label-group input:not(:placeholder-shown)~label {
  padding-top: calc(var(--input-padding-y) / 3);
  padding-bottom: calc(var(--input-padding-y) / 3);
  font-size: 12px;
  color: #777;
}

.btn-google {
  color: white;
  background-color: #ea4335;
}

.btn-facebook {
  color: white;
  background-color: #3b5998;
}
    </style>
</head>
<body>
<?php
        session_start();
        if(isset($_SESSION["user"])){
            header("Location: index.php");
        }
        
    ?>
    <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
             <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">Register</h5>
            <form class="form-signin" id="form" method="post" action="#">
              <div class="form-label-group">
                <input type="text" id="inputUserame" class="form-control" placeholder="Username" name="username" autofocus>
                <label for="inputUserame">Username</label>
              </div>
              
              <hr>

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password">
                <label for="inputPassword">Password</label>
              </div>
              
              <div class="form-label-group">
                <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Password" >
                <label for="inputConfirmPassword">Confirm password</label>
              </div>

                <div id="label" class="d-block text-center mt-2 small">
                <?php
                    if(isset($_POST['username']) && isset($_POST['password'])){
                        $mysqli = @new mysqli("localhost", "root", "", "stadnik");
                        if ($mysqli->connect_errno) {
                            echo("Nie udało się zalogować");
                        }else{
                            $mysqli->set_charset('utf8');

                            $stmt = $mysqli->prepare("SELECT username, hash, admin FROM users WHERE username = ?");
                            $stmt->bind_param("s", $_POST['username']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if($result->num_rows === 0){
                                $stmt = $mysqli->prepare("INSERT INTO users VALUES(?, ?, ?,0,0)");
                                $hashed = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 6,]);
                                $admin =0;
                                $stmt->bind_param("ssi", $_POST['username'], $hashed,$admin);
                                $stmt->execute();
                                $stmt->close();
                                $mysqli->close();
                                echo("Stworzono użytkownika");
                            }
                        }
                    }
                    ?>
                </div>
                <hr>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Register</button>
              <a class="d-block text-center mt-2 small" href="login.php">Sign In</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var form = document.getElementById("form")
    var email = document.getElementById("inputUserame")
    var passwd = document.getElementById("inputPassword")
    var passwdConfirm = document.getElementById("inputConfirmPassword")
    var label = document.getElementById("label")
    form.addEventListener( "submit", (e)=>{
        
        
        if(email.value.length<6){
            label.innerText="Login jest zbyt krótki!"
            e.preventDefault();
        }
        if(passwd.value.length<6){
            label.innerText="Hasło jest zbyt krótkie!"
            e.preventDefault();
        }
        if(passwd.value!=passwdConfirm.value){
            label.innerText="Hasła nie pokrywają się!"
            e.preventDefault();
        }
    })

  </script>
</body>
</html>