<?php 
 
include('libs/phpqrcode/qrlib.php'); 

function getUsernameFromEmail($email) {
	$find = '@';
	$pos = strpos($email, $find);
	$username = substr($email, 0, $pos);
	return $username;
}

if(isset($_POST['submit']) ) {
	$tempDir = 'temp/'; 
	$email = $_POST['mail'];
	$subject =  $_POST['subject'];
	$filename = getUsernameFromEmail($email);
	$body =  $_POST['msg'];
	$codeContents = 'mailto:'.$email.'?subject='.urlencode($subject).'&body='.urlencode($body); 
	QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5);
}
 
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Barcode Scan</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="libs/navbarclock.js"></script>
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>

<body>
    <div class="myoutput">
        <div class="input-field">

            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-login100">
                        <div class="login100-pic js-tilt" data-tilt>
                            <img src="images/img-01.png" alt="IMG">
                        </div>

                        <form class="login100-form validate-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <span class="login100-form-title">
                                Generate Barcode 
                            </span>
                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>"">
                            <div class="form-group">
                                <div  class="wrap-input100 validate-input" data-validate="Valid email is required" value="<?php echo @$email; ?>">
                                    <input class="input100" type="email" name="mail"  class="form-control" value="<?php echo @$email; ?>" placeholder="Email">
                                    <span class="focus-input100"></span>
                                     <span class="symbol-input100">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                            </div>

                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>"">
                            <div class="form-group">
                                <div  class="wrap-input100 validate-input" data-validate="Valid email is required">
                                    <input class="input100" type="subject" name="subject"  class="form-control" value="<?php echo @$subject; ?>" placeholder="Subject">
                                    <span class="focus-input100"></span>
                              
                                    <span class="symbol-input100">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                            </div>

                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>"">
                            <div class="form-group">
                                <div  class="wrap-input100 validate-input" data-validate="Valid email is required">
                                    <input class="input100" type="text" name="msg"  class="form-control" value="<?php echo @$body; ?>" placeholder="Message">
                                    <span class="focus-input100"></span>
                              
                                    <span class="symbol-input100">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                            </div>

                            <div class="form-group">
                                <div class="container-login100-form-btn">
                                  
                                    
                                    <input type="submit" formaction="qr.php" name="submit" class="login100-form-btn">
                                 </div>
                            </div>
                            <br><br><br><br><br><br>
                            </form>
                            <?php
                            if(!isset($filename)){
                                $filename = "author";
                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>

</html>