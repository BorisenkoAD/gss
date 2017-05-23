<?php
try 
{		
$name = substr(htmlspecialchars(trim($_POST['name'])), 0, 100);
$email = substr(htmlspecialchars(trim($_POST['email'])), 0, 30);
$text = substr(htmlspecialchars(trim($_POST['text'])), 0, 1500);

$message = "Имя: $name\ \nEmail: $email\nТекст: $text\n";
$subj = "Форма обратной связи с сайта gsst-spb.ru";
$to = "info@gsst-spb.ru"; 
$from="admin@gsst-spb.ru";
$headers = "From: $from\nReply-To: $from\n";

if(isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response']) {
	$secret = '6LfuYRUUAAAAAAx7j_m1IFvzkvLHDIfj2H3sGGut';
	$ip = $_SERVER['REMOTE_ADDR'];
	$response = $_POST['g-recaptcha-response'];
	$rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$ip");
	$arr = json_decode($rsp, TRUE);
	if($arr['success']){
		
		if (!mail($to, $subj, $message, $headers)){
			throw new RuntimeException('Ваше сообщение не отправлено.');
			}
			throw new RuntimeException('Ваше сообщение отправлено.');
		} 
	}
}


catch (RuntimeException $e) {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--Подключаем CSS Jasny Bootstrap -->
    <link href="css/jasny-bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/font.css" rel="stylesheet">	
	<link href="css/style.css" rel="stylesheet">
		<link href="css/index.css" rel="stylesheet">
	<link href="css/nav.css" rel="stylesheet">	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- Favicons
  ================================================== -->
  <link rel="shortcut icon" href="favicon.png">	
<script src='https://www.google.com/recaptcha/api.js'></script>  
  </head>
  <body>
	<div class="container">
		<section class="vacancy panel_all_pages">
			<div class="row">
				<div class="col-sm-1"></div>			
				<div class="col-sm-11">
				<p class="header_text"><?echo $e->getMessage();}?></p>
				</div>
			</div>
		</section>	
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<!-- Подключаем JavaScript Jasny Bootstrap -->
    <script src="js/jasny-bootstrap.min.js"></script>
        <script type="text/javascript">
            setTimeout('location.replace("/feedback.html")', 3000);
        </script>
  </body>
</html>