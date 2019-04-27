<?php
  session_start();
    
   if(!isset($_SESSION['user'])){
      header("location:index.php");
   }
?>
<!DOCTYPE html>
<html>

<head>
    <link href="/assets/DB-style.css" type="text/css" rel="stylesheet">
    <link href="/assets/fontawesome/css/bulma.css" type="text/css" rel="stylesheet">
    <link href="/assets/fontawesome/css/solid.css" type="text/css" rel="stylesheet">
    <link href="/assets/fontawesome/css/fontawesome.css" type="text/css" rel="stylesheet">
    <link href="/assets/fontawesome/webfonts" type="text/css" rel="stylesheet">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EyeServe - Admin</title><link rel="shortcut icon" href="assets/Img/Logo.png" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.7.1-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css" />
</head>

<body>
    <div class="container">
        <div class="columns">

            <div class="column is-3">
                <aside class="menu">
                    <p> </p>
                    <p class="menu-label"><i class="fa fa-cog"></i>
                        General
                    </p>
                        <ul class="general menu-list">
                            <li><a  href="dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                            <li><a class="userdevices" href="devices.php"><i class="icon-phone fas fa-mobile-alt"></i> User Devices</a></li>
                        </ul>

                    <p class="menu-label">
                        <i class="fas fa-users-cog"></i> Administration
                    </p>
                        <ul class="menu-list">
                            <li>
                                <a href="manageadmin.php"><i class="fas fa-user-cog"></i> Manage Admins</a>
                                <ul>
                                    <li><a class="is-active" href="addadmin.php"><i class="fas fa-user-plus"></i> Add Account</a></li>
                                    <li><a><i class="fas fa-user-edit"></i> Edit Account</a></li>
                                    <li><a><i class="fas fa-user-times"></i> Delete Account</a></li>
                                </ul>
                            </li>
                        </ul>
                        <i class="fas fa-sign-out-alt"></i><a class= "logout" href="logout.php"> Logout</a>
                </aside>
            </div>

            <div class="column is-9">
                <section class="hero welcome is-small">
                    <div class="hero-body">
                        <div class="container">
                            <h2 class="subtitle" style = "color:white">
                                Add Admin
                            </h2>
                        </div>
                    </div>
                </section>

                <div class="container">
                    <div class="column is-4">
                        <form action="addadmin.php" method="POST">
                            <div class="field">
                                <div class="user">
                                    <p>Must be 5 or more characters</p>
                                    <input class="input is-large" name="user" type="text" placeholder="Username*" pattern="[A-Za-z].{4,}"  autofocus="">
                                    <p class="form-text text-muted">
                                        <?php if(isset($_SESSION['Username.Error']))  {
                                            echo $_SESSION['Username.Error'];
                                            unset($_SESSION['Username.Error']); 
                                        } ?> 
                                    </p>
                                </div>
                            </div>

                            <div class="field">
                                <div class="pass">
                                    <p>Must be 6 or more characters</p>
                                    <input class="input is-large" name="pass" type="password" placeholder="Password*" pattern="[A-Za-z].{5,36}">
                                </div>
                            </div>

                            <div class="field">
                                <div class="pass2">
                                    <input class="input is-large" name="pass2" type="password" placeholder="Re-Type Password*" pattern="[A-Za-z].{5,}">
                                    <p class="form-text text-muted">
                                        <?php if(isset($_SESSION['Password.Error']))  {
                                            echo $_SESSION['Password.Error'];
                                            unset($_SESSION['Password.Error']); 
                                        } ?> 
                                    </p>
                                </div>
                            </div>

                            <div class="field">
                                <div class="email">
                                    <input class="input is-large" name="email" type="Email" placeholder="Email*">
                                    <p class="form-text text-muted">
                                        <?php if(isset($_SESSION['Email.Error']))  {
                                            echo $_SESSION['Email.Error'];
                                            unset($_SESSION['Email.Error']); 
                                        } ?> 
                                    </p>
                                </div>
                            </div>

                            <div class="field">
                                <div class="firstname">
                                    <input class="input is-large" name="first" type="text" placeholder="First Name">
                                </div>
                            </div>

                            <div class="field">
                                <div class="lastname">
                                    <input class="input is-large" name="last" type="text" placeholder="Last Name">
                                </div>
                            </div>

                            <div class="field">
                                <div class="account">
                                    <select name="account" >
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                            </div>
                                <button class="button is-block is-info is-large is-fullwidth" name="submit">Submit</button>
                        </form>

                        <?php
                            require 'database.php';
                            if(isset($_POST['submit'])){
                                $pdo = Database::connect();

                                if(($_POST['user']== '') || ($_POST['pass']== '') || ($_POST['email']== '')) {
                                    echo "Please Fill-up all with asterisk(*)";
                                }else {         
                                    $sql=$pdo->prepare("SELECT COUNT(*) FROM `accounts` WHERE `username`=?");
                                    $sql->execute(array($_POST['user']));
                                    if($sql->fetchColumn()!=0){
                                        $_SESSION["Username.Error"] = "Username Already Exists.";
                                    }else {
                                        $sql=$pdo->prepare("SELECT COUNT(*) FROM `accounts` WHERE `email`=?");
                                        $sql->execute(array($_POST['email']));
                                        if($sql->fetchColumn()!=0){
                                            $_SESSION["Email.Error"] = "Email Already Exists.";
                                        }else {
                                            if(($_POST['pass']) === ($_POST['pass2'])){
                                                if(isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['email']) && isset($_POST['pass2'])){
                                                    $password=$_POST['pass'];
                                                    $hashed = password_hash($password, PASSWORD_DEFAULT);
                                                    $sql=$pdo->prepare("INSERT INTO `accounts` (`id`, `username`, `password`, `email`, `First Name`, `Last Name`, `account`) VALUES (NULL, ?, ?, ?, ?, ?, ?);");
                                                    $sql->execute(array($_POST['user'], $hashed, $_POST['email'], $_POST['first'], $_POST['last'], $_POST['account']));
                                                    echo "Successfully Registered.";
                                                }
                                            }else {
                                                $_SESSION["Password.Error"] = "You must enter the same password twice in order to confirm it.";
                                            }
                                        }
                                    } 
                                }
                            }
                        ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>