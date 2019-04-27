<?php
    require_once dirname(__DIR__) . '/database.php';
    session_start();
    
    if(!isset($_SESSION['user'])){
        header("location: ../index.php");
    }else {
        if ($_SESSION['type'] == 'Super Admin') {
            header("Location:../dashboard.php"); 
        }
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
    <title>EyeServe - User</title><link rel="shortcut icon" href="/assets/Img/Logo.png" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.7.1-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css" />
</head>

<body>

    <div class="container">
        <div class="columns">
            <div class="column is-2.5">
                <aside class="menu">
                    <p> </p>
                    <p class="menu-label"><i class="fa fa-cog"></i>
                        General
                    </p>
                        <ul class="menu-list">
                            <li><a class="is-active" href="dashboard-user.php"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                        </ul>
                        <p class="menu-label">
                        <i class="fas fa-user-cog"></i> Account Settings
                    </p>
                        <ul class="menu-list">
                            <li>
                                <ul>
                                    <?php
                                        $pdo = Database::connect();
                                        $sql = 'SELECT * FROM objects ORDER BY object ASC LIMIT 0, 6';
                                            foreach ($pdo->query($sql) as $row);
                                        Database::disconnect();
                                    ?>
                                    <li><a><i class="fas fa-user-edit" href="editaccount.php?secure_id='.$row['secure_id'].'"></i> Edit Account</a></li>
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
                            <h1 class="title" style = "color:white">

                                Hello,  <?php
                                            $pdo = Database::connect();
                                            $sql=$pdo->prepare("SELECT * FROM accounts WHERE id=?");
                                            $sql->execute(array($_SESSION['user']));
                                            while($r=$sql->fetch()) {
                                            echo $r['username'];
                                            }
                                        ?> 
                            </h1>
                            <h2 class="subtitle" style = "color:white">
                                I hope you are having a great day!
                            </h2>
                        </div>
                    </div>
                </section>
                <section class="info-tiles">
                    <div class="tile is-ancestor has-text-centered">
                        <div class="tile is-parent">
                            <article class="tile is-child box">
                                <p class="title"><i class="fas fa-search"></i> Object</p>
                                <p class="subtitle">Most Common Detected Object</p>
                            </article>
                        </div>
                        <div class="tile is-parent">
                            <article class="tile is-child box">
                                <p class="title"><i class="fas fa-stopwatch"></i> 7.5Hrs</p>
                                <p class="subtitle">Average Daily Usage Time</p>
                            </article>
                        </div>
                    </div>
                </section>
                <div class="columns">
                    <div class="column is-6">
                        <div class="card events-card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Record Logs
                                </p>
                                <a href="#" class="card-header-icon" aria-label="more options">
                                    <span class="icon">
                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </span>
                                </a>
                            </header>
                            <div class="card-table">
                                <div class="content">
                                    <table class = "table is-fullwidth is-striped">
                                        <tbody>
                                            <?php
                                                $pdo = Database::connect();
                                                $sql = 'SELECT * FROM objects ORDER BY object ASC LIMIT 0, 6';
                                                    foreach ($pdo->query($sql) as $row) {
                                                        echo '<tr>';
                                                        echo '<td width="5%"><i class="fa fa-bell-o"></i></td><td>'. htmlspecialchars($row['object']) . '</td>';
                                                        echo '</tr>';
                                                    }
                                                Database::disconnect();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <footer class="card-footer">
                                <a href="dashboard-viewall.php" class="card-footer-item">View All</a>
                            </footer>
                        </div>
                    </div>
                    <div class="column is-6">
                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Record Logs Search
                                </p>
                                <a href="#" class="card-header-icon" aria-label="more options">

                                  <span class="icon">
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                  </span>
                                </a>
                            </header>
                            <div class="card-content">
                                <div class="content">
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input is-large" type="text" placeholder="">
                                        <span class="icon is-medium is-left">
                      <i class="fa fa-search"></i>
                    </span>
                                        <span class="icon is-medium is-right">
                      <i class="fa fa-check"></i>
                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    <script async type="text/javascript" src="../js/bulma.js"></script>
</body>

</html>