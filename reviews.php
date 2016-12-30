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
        <meta charset="UTF-8">
        <title></title>
	<link href="css/normalize.css" rel="stylesheet"/>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
	<link href='https://fonts.googleapis.com/css?family=Roboto&subset=latin,cyrillic' rel='stylesheet' type='text/css'/>	
    <link href="css/style.css" rel="stylesheet"/>	
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">			
					<h2 class="text-center" style="color: #fff"><strong><?echo $e->getMessage();}?></strong></h2>
                </div>
            </div>
        </div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
           setTimeout('location.replace("/rewiews.html")', 3000);
        </script>

    </body>
</html>