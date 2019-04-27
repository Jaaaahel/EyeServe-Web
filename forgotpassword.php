<head>
    <link href="/assets/DB-style.css" type="text/css" rel="stylesheet">
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
                    <div class="box">

                        <figure class="avatar">
                            <h1 class="title" style = "color: #005685">
                                Forgot Password
                            </h1>
                        </figure>

                        <form method="POST" action="forgotpassword.php">
                            <div class="forgot field">
                                <div class="user">
                                    <h2>Please enter your email.</h2>
                                    <input class="input is-large" name="username" type="text" placeholder="Email" autofocus="">
                                </div>
                            </div>
                            <button class="button is-block is-info is-large is-fullwidth" type="Submit" name="Submit">Submit</button>
                                    <p class="form-text text-muted">
                                        <?php if(isset($_SESSION['Username.Error']))  {
                                            echo $_SESSION['Username.Error'];
                                            unset($_SESSION['Username.Error']); 
                                        } ?> 
                                    </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>