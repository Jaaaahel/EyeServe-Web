<?php

require 'database.php';
session_start();
    
if (!isset($_SESSION['user'])) {
    header("location:index.php");
}

$hasError = false;

$errors = [];

if(isset($_POST['submit'])){
    $pdo = Database::connect();

    if (strlen($_POST['user']) < 5) {
        $errors['user'] = 'Username must be at least 5 characters.';
    }

    if (strlen($_POST['pass']) < 6) {
        $errors['pass'] = 'Password must be at least 6 characters.';
    }

    if ($_POST['pass'] != $_POST['pass2']) {
        $errors['pass2'] = 'Confirm password must match the password field';
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email address is not valid';
    }

    if (strlen(trim($_POST['first'])) == 0) {
        $errors['first'] = 'First name must not be empty.';
    }

    if (strlen(trim($_POST['last'])) == 0) {
        $errors['last'] = 'Last name must not be empty.';
    }

    $sql=$pdo->prepare("SELECT COUNT(*) FROM `accounts` WHERE `username`=?");
    $sql->execute(array($_POST['user']));
    
    if($sql->fetchColumn()!=0){
        $errors['user'] ='Username Already Exists.';
    }

    $sql=$pdo->prepare("SELECT COUNT(*) FROM `accounts` WHERE `email`=?");
    $sql->execute(array($_POST['email']));
    if($sql->fetchColumn()!=0){
        $errors['email'] = "Email Already Exists.";
    }

    if(count($errors) == 0) {
        $password=$_POST['pass'];
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql=$pdo->prepare("INSERT INTO `accounts` (`id`, `username`, `password`, `email`, `First Name`, `Last Name`) VALUES (NULL, ?, ?, ?, ?, ?);");
        $sql->execute(array($_POST['user'], $hashed, $_POST['email'], $_POST['first'], $_POST['last']));
        echo "Successfully Registered.";
    }
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
                            <li><a class="messages" href="messages.php"><i class="fas fa-envelope"></i> User Requests</a></li>
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
                                    <p><?php echo @$errors['user']; ?></p>
                                    <input class="input is-large" name="user" type="text" placeholder="Username*" pattern="[A-Za-z].{4,}"  autofocus="">
                                    <p class="form-text text-muted">
                                    </p>
                                </div>
                            </div>

                            <div class="field">
                                <div class="pass">
                                    <p><?php echo @$errors['pass']; ?></p>
                                    <input class="input is-large" name="pass" type="password" placeholder="Password*" pattern="[A-Za-z].{5,36}">
                                </div>
                            </div>

                            <div class="field">
                                <div class="pass2">
                                    <p><?php echo @$errors['pass2']; ?></p>
                                    <input class="input is-large" name="pass2" type="password" placeholder="Re-Type Password*" pattern="[A-Za-z].{5,}">
                                    <p class="form-text text-muted">
                                    </p>
                                </div>
                            </div>

                            <div class="field">
                                <div class="email">
                                    <p><?php echo @$errors['email']; ?></p>
                                    <input class="input is-large" name="email" type="Email" placeholder="Email*">
                                    <p class="form-text text-muted">
                                    </p>
                                </div>
                            </div>

                            <div class="field">
                                <div class="firstname">
                                    <p><?php echo @$errors['first']; ?></p>
                                    <input class="input is-large" name="first" type="text" placeholder="First Name">
                                </div>
                            </div>

                            <div class="field">
                                <div class="lastname">
                                    <p><?php echo @$errors['last']; ?></p>
                                    <input class="input is-large" name="last" type="text" placeholder="Last Name">
                                </div>
                            </div>
                                <button class="button is-block is-info is-large is-fullwidth" name="submit">Submit</button>
                        </form>


                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>