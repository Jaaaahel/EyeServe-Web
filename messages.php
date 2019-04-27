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
        width: 131px;
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
                            <li><a  href="dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                            <li><a class="userdevices" href="devices.php"><i class="icon-phone fas fa-mobile-alt"></i> User Devices</a></li>
                            <li><a class="messages is-active" href="messages.php"><i class="fas fa-envelope"></i> User Requests</a></li>
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
                                User Requests
                            </h2>
                        </div>
                    </div>
                </section>   

                <div class="container">
                    <div class="row"> 
                        <table class = "roundedCorners" border="1">
                            <thead>
                                <tr>
                                    <th style="color: white;">Secure ID</th>
                                    <th style="color: white;">Email</th>
                                    <th style="color: white;">Status</th>
                                    <th style="color: white;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $pdo = Database::connect();
                                        $sql = 'SELECT * FROM request';
                                        foreach ($pdo->query($sql) as $row) {
                                            echo '<tr>';
                                                echo '<td border="1">'. htmlspecialchars($row['secure_id']) . '</td>';
                                                echo '<td>'. htmlspecialchars($row['email']) . '</td>';
                                                echo '<td>'. htmlspecialchars($row['status']) . '</td>';
                                                echo '<td>';
                                                    echo '<p style="margin-bottom: 10px;"><a class="btnDel" href="zip.php?secure_id='.$row['secure_id'].'">Delete Request</a></p>';

                                                    echo '<p style="margin-bottom: 10px;"><a class="btnUpd" href="/zip.php?secure_id=' . $row['secure_id'] . '">Download Recordings</a></p>';

                                                    if ($row['status'] == 'Pending') {
                                                        echo '<p><a class="btnUpd" href="/markascomplete.php?id=' . $row['id'] . '">Mark as Complete</a></p>';
                                                    }

                                                    if ($row['status'] == 'Complete') {
                                                        echo '<p><a class="btnUpd" href="/markaspending.php?id=' . $row['id'] . '">Mark as Pending</a></p>';
                                                    }
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