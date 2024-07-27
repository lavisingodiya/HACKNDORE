<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');
ob_start();
// if(!isset($_SESSION['system'])){

$system = $conn->query("SELECT * FROM system_settings")->fetch_array();
foreach ($system as $k => $v) {
    $_SESSION['system'][$k] = $v;
}
// }
ob_end_flush();
?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login | <?php echo $_SESSION['system']['name'] ?></title>


    <?php include('./header.php'); ?>
    <?php
    if (isset($_SESSION['login_id']))
        header("location:index.php?page=home");

    ?>

</head>
<style>
    body {
        width: 100%;
        height: calc(100%);
        position: fixed;
        top: 0;
        left: 0;
        align-items: center !important;
    }

    main#main {
        width: 100%;
        height: calc(100%);
        display: flex;

    }

    .footer {
        background-color: #2c3e50;
        color: white;
        /* Text color */
        padding: 1rem;
        border-top: 1px solid #34495e;
        /* Subtle border */
        text-align: center;
        /* Center text in footer */
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    .footer a {
        color: #007bff;
        text-decoration: none;
    }

    .footer a:hover {
        text-decoration: underline;
    }


    #login-center {
        margin: auto;
        /* Centering the login card */
    }

    .card {
        max-width: 100%;
        /* Make card responsive */
        width: 100%;
    }

    @media (max-width: 576px) {
        .card {
            width: 90%;
            /* Adjust width for small screens */
        }
    }


    .form-control {
        border-radius: 25px;
        /* Rounded input fields */
        padding: 10px 15px;
        /* More padding inside input fields */
        font-size: 16px;
        /* Larger text */
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        /* Add a focus effect */
    }

    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        color: #fff;
    }

    .background-video {
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%;
        min-height: 100%;
        z-index: -100;
        backdrop-filter: blur(5px);
    }

    .card-body {
        padding: 2rem;
        /* background: rgba(0, 0, 0, 0.7); */
        /* Semi-transparent background */
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .btn-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
        border: none;
        border-radius: 25px;
        padding: 10px 20px;
        font-size: 16px;
        transition: background 0.3s, transform 0.3s;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #0056b3, #003f7f);
        transform: scale(1.05);
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-radius: 5px;
        padding: 10px;
    }

    h3,
    h4 {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    .logo {
        width: 50px;
        height: 50px;
        /* background: white;
            border-radius: 50%; */
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 10px;
    }

    .logo img {
        max-width: 100%;
        max-height: 100%;
    }

    .fg {
        background: rgba(255, 255, 255, 0);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
</style>

<body class="bg-dark">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="logo">
            <img src="/rates/assets/uploads/indore.png" alt="">
        </div>
        <a class="navbar-brand" href="#">INDORE MUNICIPAL CORPORATION</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin/">Administrator Login</a>
                    <!-- <a class="nav-link" href="#">Administrator Login</a> -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Create Password</a>
                    <!-- <a class="nav-link" href="#">Create Password</a> -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <video autoplay muted loop class="background-video">
        <source src="/rates/assets/uploads/HomeScreenVideo.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <main id="main">

        <div class="align-self-center w-100">
            <!-- <h3 class="text-white text-center"><?php echo $_SESSION['system']['name'] ?></h3> -->
            <!-- <h4 class="text-white text-center"><b>Client Login  -->
                <!-- <a href="admin/">Administrator Login</a></b></h4> -->
            <div id="login-center" class="row justify-content-center">
                <div class="col-md-4 fg">
                    <div class="card-body">
                        <form id="login-form">
                            <div class="form-group">
                                <label for="username" class="control-label text-primary">Login ID</label>
                                <input type="text" id="username" name="username" class="form-control form-control-sm" placeholder="Username/Login ID" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label text-primary">Password</label>
                                <input type="password" id="password" name="password" class="form-control form-control-sm" placeholder="Password" required>
                            </div>
                            <div class="w-100 d-flex justify-content-center align-items-center">
                                <button class="btn-sm btn-block btn-wave col-md-4 btn-primary m-0 mr-1">Login</button>
                                <!-- <a href="register.php">Create Password</a> -->
                            </div>
                        </form>
                        <p><a href="passwordreset.php">Forgot Password</a></p>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer" style="text-align: center;">
        <strong>DevElites 2024 <a href="#">Revenue Managment System.</a>.</strong>
    </footer>
</body>
<?php include 'footer.php' ?>
<script>
    $('#login-form').submit(function(e) {
        e.preventDefault()
        $('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
        if ($(this).find('.alert-danger').length > 0)
            $(this).find('.alert-danger').remove();
        $.ajax({
            url: 'ajax.php?action=login',
            method: 'POST',
            data: $(this).serialize(),
            error: err => {
                console.log(err)
                $('#login-form button[type="button"]').removeAttr('disabled').html('Login');

            },
            success: function(resp) {
                if (resp == 1) {
                    location.href = 'index.php?page=home';
                } else {
                    $('#login-form').prepend(
                        '<div class="alert alert-danger">Username or password is incorrect.</div>')
                    $('#login-form button[type="button"]').removeAttr('disabled').html(
                        'Create Account');
                }
            }
        })
    })
</script>

</html>