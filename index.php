<?php
    require 'database.php';
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    session_start();
   
    if(isset($_SESSION['user']) && $_SESSION['user']!='') {
            header('Location: dashboard.php');
    }
      
    $username= '';
    $password= '';
    $error= '';

      if(isset($_POST['username']) && isset($_POST['pass'])) {
         
        $username=$_POST['username'];
        $password=$_POST['pass'];

        $sql=$pdo->prepare("SELECT id,password,account FROM accounts WHERE username=?");
        $sql->execute(array($username));
         
         if ($r = $sql->fetch()) {
            
            $check = password_verify($password, $r['password']);
            $account = $r['account'];

            if ($check) {
                    $_SESSION['user'] = $r['id'];
                    $_SESSION['type'] = $r['account']
                    header('Location: dashboard.php');
                    exit;
            }
         }
         $_SESSION["Username.Error"] = "Username or Password is incorrect";
      }
?>
<!DOCTYPE html>
<html>

<head>
    <link href="/assets/index-style.css" type="text/css" rel="stylesheet">
    <link href="/assets/fontawesome/css/bulma.css" type="text/css" rel="stylesheet">
    <link href="/assets/fontawesome/css/solid.css" type="text/css" rel="stylesheet">
    <link href="/assets/fontawesome/css/fontawesome.css" type="text/css" rel="stylesheet">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EyeServe</title><link rel="shortcut icon" href="assets/Img/Logo.png" type="image/png">

</head>

<body>
    <section class="hero is-fullheight">
        <div class="hero">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <p class="subtitle has-text-white">Please login to proceed.</p>
                    <div class="box">

                        <figure class="avatar">
                            <h1 class="title" style = "color: #005685">
                                EyeServe
                            </h1>
                            <img src="assets/Img/Logo.png">
                        </figure>
                                    <p class="form-text text-muted">
                                        <?php if(isset($_SESSION['Username.Error']))  {
                                            echo $_SESSION['Username.Error'];
                                            unset($_SESSION['Username.Error']); 
                                        } ?> 
                                    </p>
                        <form method="POST" action="index.php">
                            <div class="field">
                                <div class="user">
                                    <input class="input is-large" name="username" type="text" placeholder="Username" autofocus="">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" name="pass" type="password" placeholder="Password">
                                </div>
                            </div>
                            <button class="button is-block is-info is-large is-fullwidth" type="Submit" name="Submit">Login</button>
                        </form>
                    </div>
                        <a href="/forgotpassword.php" class = "has-text-white">Forgot Password?</a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>