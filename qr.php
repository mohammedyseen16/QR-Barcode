<?php
// servername => localhost 
		// username => root 
		// password => empty 
		// database name => staff 
		$conn = mysqli_connect("localhost", "root", "", "demo"); 
		
		// Check connection 
		if($conn === false){ 
			die("ERROR: Could not connect. "
				. mysqli_connect_error()); 
		} 
		
		// Taking all 5 values from the form data(input) 
		$mail = $_REQUEST['mail']; 
		$subject = $_REQUEST['subject']; 
		$msg = $_REQUEST['msg']; 
	  
	 
		$sql = "INSERT INTO barcode VALUES ('$mail','$subject','$msg')"; 
		echo"<br/><br/>";
		echo"<center>";
		if(mysqli_query($conn, $sql)){ 
			 
			echo nl2br("\n Mail: $mail\n Subject: $subject\n"
				.  "Messge: $msg"); 
		} else{ 
			echo "ERROR: Hush! Sorry $sql. "
				. mysqli_error($conn); 
		} 
		
		// Close connection 
		mysqli_close($conn); 
        echo"</center>";

$f = "visit.php";
if(!file_exists($f)){
	touch($f);
	$handle =  fopen($f, "w" ) ;
	fwrite($handle,0) ;
	fclose ($handle);
}
 
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
<html lang="en-US">
	<head>
  
	
	 
	<link rel="stylesheet" href="libs/css/bootstrap.min.css">
	<link rel="stylesheet" href="libs/style.css">
	<script src="libs/navbarclock.js"></script>
	</head>
    <center>
	<body >
	 
			 
			 
		<div class="myoutput">
			<h3><strong>Please Scan Your QR code to get Link</strong></h3>
			<div class="input-field">
			 
			</div>
			<?php
			if(!isset($filename)){
				$filename = "author";
			}
			?>
            <br>
            <br>
            <br>
			<div class="qr-field">
				<h2 style="text-align:center">QR Code</h2>
			 
					<div class="qrframe" style="border:2px solid black; width:210px; height:210px;">
							<?php echo '<img src="temp/'. @$filename.'.png" style="width:200px; height:200px;"><br>'; ?>
					</div>
					<a class="btn btn-primary submitBtn" style="width:210px; margin:5px 0;" href="download.php?file=<?php echo $filename; ?>.png ">Download QR Code</a>
			 
			</div>
			 
		</div>
        </center>
	</body>
 
</html>