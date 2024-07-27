<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
  ob_start();
  // if(!isset($_SESSION['system'])){

    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
    foreach($system as $k => $v){
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
if(isset($_SESSION['login_id']))
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
    /*background: #007bff;*/
}

main#main {
    width: 100%;
    height: calc(100%);
    display: flex;
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

    .background-video {
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%;
        min-height: 100%;
        z-index: -100;
        backdrop-filter: blur(5px);
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
                <li class="nav-item active">
                    <!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
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
            <h4 class="text-white text-center"><b>Reset Account Password</b></h4>
            <div id="login-center" class="row justify-content-center">
                <div class="col-md-4 fg">
                    <div class="card-body">
                        <form id="vsr-frm" method="POST" action="">
                            <div class="form-group">
                                <label for="loginId" class="control-label text-primary">Login ID</label>
                                <input type="text" id="loginId" name="loginId" class="form-control form-control-sm" placeholder="Enter your login ID"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="clientId" class="control-label text-primary">Client ID</label>
                                <input type="clientId" id="clientId" name="clientId" class="form-control form-control-sm" placeholder="Enter your Client ID"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label text-primary">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-sm" placeholder="Enter your Email"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label text-primary">New Password</label>
                                <input type="password" id="password" name="pwd" class="form-control form-control-sm" placeholder="Type your new password"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary" id='button' name="reset">Reset Password</button>
                            <a href="login.php">Login</a>
                        </form>

                        <?php
include 'db_connect.php';

if(ISSET($_POST['reset'])){
$loginId  = $_POST['loginId'];
$clientId = $_POST['clientId'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];

$qry = $conn->query("SELECT
`client`.`ClientID`
, `client_login`.`ClientId` AS id
, `client`.`Email`
FROM
`client`
LEFT JOIN `client_login` 
    ON (`client`.`id` = `client_login`.`ClientId`) WHERE `client_login`.`ClientId` = '$loginId' AND `client`.`ClientID` = '$clientId' AND `client`.`Email` = '$email' ");
$rs = $qry->fetch_array();

if($rs > 0){
    $qry2 = $conn->query("UPDATE client_login SET Password = md5('$pwd') WHERE `client_login`.`ClientId` = '$loginId' ") or die(myqli($conn));

    if($qry2){
        $to = $email;
        $subject = 'PASSWORD RECOVERY';
        $from = 'revenuedepartments@rcs.com';
            
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();
            
        // Compose a simple HTML email message
        $message = '<html><body style="">';
        $message .= '<h3 style="color:;">PASSWORED RECOVERY</h3>';
        $message .= '<p style="font-size:18px;">Your Account Password has been updated to. <br/>NEW PASSWORD: <b>'.$pwd.'</b></p>
        
		  <hr style="border-style:dotted; border-color: black;" />
			  <center>&copy;2021, LAND/PROPERTY RATES DEPARTMENT</center>
		  <br/>
		  <i>
			  <center>If you didnt perform a password reset, please contact us as soon as possible.</center>
		  </i>';
		  $message .= '</div></body></html>';
            
        // Sending email
        if(mail($to, $subject, $message, $headers)){
            echo '<span style="color:green;text-align:center;">Success! Check your email for your Details</span>';
        } else{
            echo '<span style="color:green;text-align:center;">Success! You can login. Error! Email Not Sent</span>';
        }
    }else{

    }                
        }else{//Passwords dont match
        echo '<span style="color:red;text-align:center;">Error! Client Details Not Found</script>';
    }
}
?>



                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<?php include 'footer.php' ?>

</html>