<?php
    require_once dirname(__DIR__) . '/database.php';
    session_start();
    
   if(!isset($_SESSION['user'])){
      header("location:index.php");
   }

    $id = null;
    if ( !empty($_GET['secure_id'])) {
        $id = $_REQUEST['secure_id'];
    }
     
    if ( null==$id ) {
        header("Location: manageadmin.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $EmailError = null;
        $FirstNameError = null;
        $LastNameError = null;
         
        // keep track post values
        $email = $_POST['email'];
        $FirstName= $_POST['FirstName'];
        $LastName = $_POST['LastName'];
         
        // validate input
        $valid = true;
        if (empty($email)) {
            $EmailError = 'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $EmailError = 'Please enter a valid Email Address';
            $valid = false;
        }

        if (empty($FirstName)) {
            $FirstNameError = 'Please enter First Name';
            $valid = false;
        }
         
        if (empty($LastName)) {
            $LastNameError = 'Please enter Last Name';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE `accounts`  SET `Email` = ?, `First Name` = ?, `Last Name` =? WHERE `id` = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($email,$FirstName,$LastName,$id));
            Database::disconnect();
            header("Location: manageadmin.php");
        }

    } else {
        /*$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM `accounts` where `id` = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if ($data['account'] == 'Admin' || $data['account'] == 'User'){
            $email = $data['Email'];
            $FirstName = $data['First Name'];
            $LastName = $data['Last Name'];
            Database::disconnect();
        }else {
            header("Location: manageadmin.php");
        }*/
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
                            <li><a href="dashboard-user.php"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                        </ul>
                        <p class="menu-label">
                        <i class="fas fa-user-cog"></i> Account Settings
                    </p>
                        <ul class="menu-list">
                            <li>
                                <ul>
                                    <?php
                                        $pdo = Database::connect();
                                        $sql = 'SELECT * FROM devices ';
                                        /*$sql=$pdo->prepare("SELECT * FROM devices WHERE secure_id=?");
                                         $sql->execute(array($id));
                                         $r = $sql->fetch();
                                         $data = $r['secure_id'];*/
                                            foreach ($pdo->query($sql) as $row);
                                        Database::disconnect();
                                    ?>
                                    <li><a><i class="is-active fas fa-user-edit" href="/updateadmin.php?secure_id='.$row['secure_id'].'"></i> Edit Account</a></li>
                                </ul>
                            </li>
                        </ul>
                        <i class="fas fa-sign-out-alt"></i><a class= "logout" href="/logout.php"> Logout</a>
                </aside>
            </div>

            <div class="column is-9">
                <section class="hero welcome is-small">
                    <div class="hero-body">
                        <div class="container">
                            <h2 class="subtitle" style = "color:white">
                                Edit Account
                            </h2>
                        </div>
                    </div>
                </section>   


                <div class="container">
                    <div class="span10 offset1">
                        <form class="form-horizontal" action="updateadmin.php?id=<?php echo $id?>" method="POST">
                            <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                                <label class="control-label">Email Address</label>
                                <div class="controls">
                                    <input name="email" type="text"  placeholder="Email" value="<?php echo !empty($email)?$email:'';?>">
                                        <?php if (!empty($EmailError)): ?>
                                        <span class="help-inline"><?php echo $EmailError;?></span>
                                        <?php endif; ?>
                                </div>
                            </div>
                            <div class="control-group <?php echo !empty($FirstNameError)?'error':'';?>">
                                <label class="control-label">First Name</label>
                                <div class="controls">
                                    <input name="FirstName" type="text" placeholder="First Name" value="<?php echo !empty($FirstName)?$FirstName:'';?>">
                                        <?php if (!empty($FirstNameError)): ?>
                                        <span class="help-inline"><?php echo $FirstNameError;?></span>
                                        <?php endif;?>
                                </div>
                            </div>
                            <div class="control-group <?php echo !empty($messageError)?'error':'';?>">
                                <label class="control-label">Last Name</label>
                                <div class="controls">
                                    <input name="LastName" type="text"  placeholder="Last Name" value="<?php echo !empty($LastName)?$LastName:'';?>">
                                        <?php if (!empty($LastNameError)): ?>
                                        <span class="help-inline"><?php echo $LastNameError;?></span>
                                        <?php endif;?>
                                </div>
                            </div>
                          <div class="form-actions">
                              <button type="submit" class="btn btn-success">Update</button>
                              <a class="btn" href="manageadmin.php">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>