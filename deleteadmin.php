<?php
    require 'database.php';
    $id = null;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM `accounts`  WHERE `id` =?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));
            Database::disconnect();
            header("Location: manageadmin.php");
    }
?>

<style>
    .control-group{
        font-size: 20px;
        <!--text-align: center; --!>
    }

    .centerButtons {
        margin: 0 auto;
    }
    .row{
    }

    .btnUpd {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 13px 25px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        border-radius: 12px;

    }
    .btnDel {
        background-color: #f44336; /* Green */
        border: none;
        color: white;
        padding: 13px 25px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        border-radius: 12px;
    }

</style>

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
                        <ul class="menu-list">
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
                                    <li><a href="addadmin.php"><i class="fas fa-user-plus"></i> Add Account</a></li>
                                    <li><a><i class="fas fa-user-edit"></i> Edit Account</a></li>
                                    <li><a class="is-active"><i class="fas fa-user-times"></i> Delete Account</a></li>
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
                                Manage Admins
                            </h2>
                        </div>
                    </div>
                </section>   

                <div class="container">
                    <div class="row">
                        <h3>Delete Account</h3>
                    </div>
                     
                    <form class="form-horizontal" action="deleteadmin.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btnDel">Yes</button>
                          <a class="btnUpd" href="manageadmin.php">No</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>