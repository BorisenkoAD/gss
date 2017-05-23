<?
include "dbLib.php";
$res = $connection->prepare("INSERT INTO reviews 
												(lastname,
												firstname,
												email,
												message,
												ip)
										VALUES	
												(:lastname,
												:firstname,
												:email,
												:message,
												:ip)"
							);
	$res->bindParam(':firstname', $firstname);
	$res->bindParam(':lastname', $lastname);
	$res->bindParam(':email', $email);
	$res->bindParam(':message', $message);
	$res->bindParam(':ip', $ip);	
	
try 
{
$firstname = substr(htmlspecialchars(trim($_POST['firstname'])), 0, 25);
$lastname= substr(htmlspecialchars(trim($_POST['lastname'])), 0, 50);
$email= substr(htmlspecialchars(trim($_POST['email'])), 0, 50);
$message= substr(trim(nl2br($_POST['message'])), 0, 1100);
$ip = $_SERVER['REMOTE_ADDR'];
$res->execute();

$mess = $message." отправлено с IP ".$ip." www.arkadaspb.ru/admin/";
$subj = "Отзыв с сайта www.gsst-spb.ru";
$to = "info@gsst-spb.ru"; 
$from="admin@gsst-spb.ru";
$headers = "From: $from\nReply-To: $from\n";
if (!mail($to, $subj, $mess, $headers)){
	throw new RuntimeException('Ваш отзыв не отправлен.');
    }
	throw new RuntimeException('Ваш отзыв отправлен. Через некоторое время от появится на сайте, спасибо.');
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
            setTimeout('location.replace("/rewiews.html")', 3000);
        </script>
  </body>
</html>