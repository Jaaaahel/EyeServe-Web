<?php
    require 'database.php';
    session_start();
    
   if(!isset($_SESSION['user'])){
      header("location:index.php");
   }
?>

<style>
    td {
        border: 1px solid black;
    }
      tr:nth-child(even) {
        background-color: #eee;
      }
      tr:nth-child(odd) {
        background-color: #fff;
      } 
      table.roundedCorners { 
      border: 1px solid black;
      border-radius: 13px; 
      border-spacing: 0;
      }
    table.roundedCorners td, 
    table.roundedCorners th { 
      padding: 10px; 
      }
    table.roundedCorners tr:last-child > td {
        border-bottom: 1px solid black;
        margin-left:auto; 
        margin-right:auto;
    }
    th {
        background-color: #005685;
        color: white;
    }
    th, td {
        width: 141px;
    }
    .btnUpd {
        background-color: #4CAF50; /* Green */
        color: white;
        padding: 13px 25px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        border-radius: 12px;

    }
    .btnDel {
        background-color: #f44336; /* Red */
        color: white;
        padding: 13px 27.3px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        border-radius: 12px;
        margin-top: 5px;
    }

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
    <link href="assets/DB-style.css" type="text/css" rel="stylesheet">
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
                            <li><a href="dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                            <li><a class="userdevices is-active" href="devices.php"><i class="icon-phone fas fa-mobile-alt"></i></i> User Devices</a></li>
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
                                    <li><a><i class="fas fa-user-times"></i> Delete Account</a></li>
                                </ul>
                            </li>
                        </ul>
                        <i class="fas fa-sign-out-alt"></i><a class= "logout" href="logout.php"> Logout</a>
                </aside>
            </div>

            <div class="column is-9">
                <section class="bar hero welcome is-small">
                    <div class="hero-body">
                        <div class="container">
                            <h2 class="subtitle" style = "color:white">
                                User Devices
                            </h2>
                        </div>
                    </div>
                </section>   

                <div class="container">
                    <div class="row"> 
                        <table class = "roundedCorners" border="1">
                            <thead>
                                <tr>
                                    <th style="color: white;">Device Name</th>
                                    <th style="color: white;">API Level</th>
                                    <th style="color: white;">Model</th>
                                    <th style="color: white;">Brand</th>
                                    <th style="color: white;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $pdo = Database::connect();
                                        $sql = 'SELECT * FROM devices ORDER BY id ASC';
                                        foreach ($pdo->query($sql) as $row) {
                                            echo '<tr>';
                                                echo '<td border="1">'. htmlspecialchars($row['device_name']) . '</td>';
                                                echo '<td>'. htmlspecialchars($row['api_level']) . '</td>';
                                                echo '<td>'. htmlspecialchars($row['model']) . '</td>';
                                                echo '<td>'. htmlspecialchars($row['brand']) . '</td>';
                                                echo '<td>';
                                                    echo '<a class="btnUpd" href="/zip.php?secure_id=' . $row['secure_id'] . '">Download Recordings</a>';
                                                echo '</td>';
                                            echo '</tr>';   
                                        }
                                    
                                    Database::disconnect();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>