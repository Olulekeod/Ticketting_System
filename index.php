<?php
session_start();
include 'masterDB.php';



if(isset($_POST['btnlogin'])){
//sanitize User Inputs
$loginemail = $database->sanitize($_POST['txtemail']);
$loginpassword = $database->sanitize($_POST['txtpassword']);

	//check if email exist
	$AdminLogin = $database->Admin_CheckCredentials($loginemail,MD5($loginpassword));

	if ($AdminLogin > 0){

		$_SESSION['FND_Admin_Email'] = $loginemail;
		echo '<script> window.location="Dashboard"</script>';



	}else{

		$loginerrormessage = "Invalid Email or Password";


	}
    




}






?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="icon" href="img/Prananet_Logo.png" sizes="32x32" />
      <link rel="icon" href="img/Prananet_Logo.png" sizes="192x192" />
      <link rel="apple-touch-icon" href="img/Prananet_Logo.png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=" assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href=" assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href=" assets/libs/css/style.css">
    <link rel="stylesheet" href=" assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="#"><img class="logo-img" src="img/Prananet_Logo.png" width="50%" alt="logo"></a><span class="splash-description">Administrator Login</span></div>
            <div class="card-body">
                <form method="post">
                <p style="color:red;"> <?php 
                    
                    if (isset($loginerrormessage)){
                        
                        echo $loginerrormessage;

}
                    
                      ?> </p>
               <p style="color:green;">
                    <?php 
                    
                    if (isset($loginsuccessmessage)){
                        
                        echo $loginsuccessmessage;

}
                    
                      ?> </p>
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="txtemail" type="Email" placeholder="Email" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="txtpassword" type="password" placeholder="Password">
                    </div>
                    <!-- <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
                        </label>
                    </div> -->
                    <button type="submit" name="btnlogin" class="btn btn-primary btn-lg btn-block">Login</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <!-- <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Create An Account</a></div> -->
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src=" assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src=" assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
 
</html>