<?php
	$uploaddir = '/var/www/vhosts/22/137870/webspace/httpdocs/gsst-spb.ru/tmp/';
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
	$namefile =  basename($_FILES['userfile']['name']);
	$mes = " ";
	$send = false;

try {
    
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES['userfile']['error']) ||
        is_array($_FILES['userfile']['error'])
    ) {
        throw new RuntimeException('Неверные параметры. повторите операцию.');
    }

    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['userfile']['error']) {
        case UPLOAD_ERR_OK:	
            break;
        case UPLOAD_ERR_NO_FILE:
			echo 'Файл не отправлен.';		
            throw new RuntimeException('Файл не отправлен.');
        case UPLOAD_ERR_INI_SIZE:	
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Превышен размер файла.');
        default:
            throw new RuntimeException('Неизвестная ошибка.');
    }

    // You should also check filesize here. 
    if ($_FILES['userfile']['size'] > 1900000) {
        throw new RuntimeException('Превышен размер файла.');
    }

    // DO NOT TRUST $_FILES['userfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['userfile']['tmp_name']),
        array(
			'pdf' => 'application/pdf',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
			'doc' => 'application/msword',
			'docx'=> 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
		),
        true
    )) {
        throw new RuntimeException('Неверный формат.');	
    }

    // You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    if (!move_uploaded_file(
        $_FILES['userfile']['tmp_name'],$uploadfile
  /*      sprintf('/var/www/vhosts/22/137870/webspace/httpdocs/istria-spb.ru/istria2/tmp/%s.%s', sha1_file($_FILES['userfile']['tmp_name']), $ext)*/
    )) {
        throw new RuntimeException('Перемещение файла невозможно.');
    }
		$send = true;
        throw new RuntimeException('Ваше сообщение успешно отправлено.');
		

 } catch (RuntimeException $e) {
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
            setTimeout('location.replace("/vacancy.html")', 3000);
        </script>
  </body>
</html>
<?
if ($send) {
	//---------------------------------
	$filename = $uploadfile; // $_FILES['userfile']['name']; //Имя файла для прикрепления $uploadfile;
	$to = "info@gsst-spb.ru"; 
	$from="admin@gsst-spb.ru";
	$subject = "Прикрепленное резюме с сайта";
	$message = $_POST['message'];
	$subj = "=?utf-8?B?".base64_encode($subject)."?=";
	$boundary = uniqid('np');
	$nl = "\n";
	$file = fopen($filename, "r");
	$blob = fread($file, filesize($filename));
	fclose($file);

	$headers = "MIME-Version: 1.0" . $nl;
	$headers .= "From: " . $from . $nl . "Reply-To: " . $from . $nl;
	$headers .= "Content-Type: multipart/mixed;boundary=" . $boundary . $nl;

	$msg = "This is a MIME encoded message."; 
	$msg .= $nl . $nl . "--" . $boundary . $nl;
	$msg .= "Content-type: text/html;charset=utf-8" . $nl . $nl;
	$msg .= $message;
	$msg .= $nl . $nl . "--" . $boundary . $nl;
	$msg .= "Content-Type: application/octet-stream" . $nl;
	$msg .= "Content-Transfer-Encoding: base64" . $nl;
	$msg .= "Content-Disposition: attachment; " .
	 "filename=\"=?utf-8?B?".base64_encode($filename)."?=\"" . $nl . $nl;
	$msg .= chunk_split(base64_encode($blob)) . $nl;
	$msg .= $nl . $nl . "--" . $boundary . "--";

	mail($to, $subj, $msg, $headers);
	//---------------------------------	
		// теперь этот файл нужно переименовать желательно в дату_время отправки
		// потом его отправить по почте админу и удалить его.
}
?>