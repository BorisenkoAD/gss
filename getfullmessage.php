<?php
include "dbLib.php";
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" href="favicon.png" type="image/png">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Отзывы о Компании АРКАДА</title>

    <!-- Bootstrap -->
    <link href="css/normalize.css" rel="stylesheet">	
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/font.css">	
	<link rel="stylesheet" href="css/style.css"> <!-- общие стили -->
	<link rel="stylesheet" href="css/rewiews.css"> <!-- стили конкретной страницы -->


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- HTML-код модального окна -->
<div id="myModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Заголовок модального окна -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title form-heder">Ваш отзыв:</h4>
      </div>
      <!-- Основное содержимое модального окна -->
      <div class="modal-body">
        <!-- основное содержимое (тело) модального окна -->
        <div class="container-fluid">
          <!-- Контейнер, в котором можно создавать классы системы сеток -->
	  		<form class="form-horizontal" action="reviews.php" method="post">
			<div class="row">
				<div class="col-xs-6">
					<div class="form-group">
						<label for="lastname" class="col-xs-4 control-label">Фамилия:</label>
						<div class="col-xs-8">
							<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Введите Фамилию">
						</div>
					</div>
					<div class="form-group">
						<label for="firstname" class="col-xs-4 control-label">Имя: <span style="color:red;">*</span></label>
						<div class="col-xs-8">
							<input type="text" class="form-control" name="firstname" required id="firstname" placeholder="Введите Имя">
						</div>
					</div>		
					<div class="form-group">
						<label for="email" class="col-xs-4 control-label">Адрес email:</label>
						<div class="col-xs-8">
							<input type="email" class="form-control" name="email" id="email" placeholder="Введите email">
						</div>
					</div>		
				</div>
				<div class="col-xs-6">
					<div class="form-group center-block">
						<label for="message" class="col-xs-0 control-label pull-left">Ваше сообщение: <span style="color:red;">*</span></label>
						<div class="col-xs-8">
							Осталось символов: <span id="counter">1000</span><br />
							<textarea  id="my_area" class="form-control" required name="message" id="message" cols="30" rows="6" placeholder="Не более 1000 знаков." maxlength="1100" onkeyup="check()"></textarea>
							<!-- <input type="textarea" class="form-control"  placeholder="Введите email"> -->
						</div>
					</div>			
				</div>
			</div>
		</div>	  
      <!-- Футер модального окна -->
    <div class="modal-footer">
	<!-- поля обозначенные * обязательны для заполнения<br> -->
		<button type="submit" class="btn btn-primary">Отправить
		</form>			
    </div>
    </div>
  </div>
</div>	
</div>
<!-- /HTML-код модального окна -->
<div class="container">
	<header>
	<section class="header-top">
		<div class="row">
			<div class="col-sm-2">
				<a href="\"><img src="img/logo.png" class="center-block" style="padding-top: 9px;"></a>
			</div>		
			<div class="col-sm-4 text-left">
			<div  style="padding-top: 9px;">
				<a href="\"><span class="nameOfCompany">Arkada</span></a>
			</div>
			</div>
			<div class="col-sm-6 text-right" style="padding-top: 31px; padding-right: 30px;">
				<span class="writeToUs">Напишите нам</br><a href="mailto:info@arkadaspb.ru">info@arkadaspb.ru</a></span>
			</div>
		</div>	
	</section>
	<section class="header-second">	
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-2 navigationBox text-uppercase">
				<a href="index.html">
				<span class="fa-stack fa-2x navigationIcon">
					<i class="fa fa-circle-thin fa-stack-2x"></i>
					<i class="fa fa-home fa-stack-1x"></i>
				</span>	
				</br><span class="navigationText">Главная</span>
				</a>
			</div>
			<div class="col-sm-2 navigationBox text-uppercase">
				<a href="project.html">
				<span class="fa-stack fa-2x navigationIcon">
					<i class="fa fa-circle-thin fa-stack-2x"></i>
					<i class="fa fa-globe fa-stack-1x"></i>
				</span>	
				</br><span class="navigationText">проекты</span>	
				</a>
			</div>
			<div class="col-sm-2 navigationBox text-uppercase">
				<a href="vacancy.html">
				<span class="fa-stack fa-2x navigationIcon">
					<i class="fa fa-circle-thin fa-stack-2x"></i>
					<i class="fa fa-cog fa-stack-1x"></i>
				</span>	
				</br><span class="navigationText">вакансии</span>	
				</a>				
			</div>
			<div class="col-sm-2 navigationBoxActive text-uppercase">
				<a href="rewiews.html">			
				<span class="fa-stack fa-2x navigationIconActive">
					<i class="fa fa-circle-thin fa-stack-2x"></i>
					<i class="fa fa-commenting fa-stack-1x"></i>
				</span>	
				</br><span class="navigationText">отзывы</span>		
				</a>				
			</div>
			<div class="col-sm-2 navigationBox text-uppercase">
				<a href="contact.html">
				<span class="fa-stack fa-2x navigationIcon">
					<i class="fa fa-circle-thin fa-stack-2x"></i>
					<i class="fa fa-envelope fa-stack-1x"></i>
				</span>	
				</br><span class="navigationText">контакты</span>	
				</a>				
			</div>		
			<div class="col-sm-1"></div>		
		</div>
	</section>
	<section class="header-bar">		
		<div class="row">
			<div class="col-sm-2">
				<span class="characterOfCompany">O</span>
			</div>
			<div class="col-sm-10">
				<h2><p class="text-left">Здесь вы можете оставить <span class="blueNameCompany">Свой Отзыв о Компании!</span></p></h2>
				<p class="text-left">Вы можете прочитать, что думают о Компании сотрудники и партнёры. А также оставить своё мнение о работе или сотрудничестве с ООО Аркада. С нетерпением ждём Ваших отзывов!</p>
			</div>
		</div>
	</section>
	</header>
</div>	
<div class="container">
 	<section class="rewiews">

		<div class="row" style="padding-top: 10px;  padding-bottom: 10px;">

			<?php $stmt = $connection->prepare('SELECT * FROM reviews WHERE id = ?');
			$stmt->bindValue(1, $id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC)?>		
			
					<div class="col-sm-1"></div>
					<div class="col-sm-10" style="text-align:left;">
			<span class="title"><?php echo $row["firstname"]?></span></br>
					<span class="title" style="	text-align:left;"><?php echo $row["date"] ?>

					<div class="text-left" style="text-align: justify; text-indent: 25px; padding-left: 15px; padding-right: 15px;">
							<span class="p2"><?php echo $row["message"]?></span>
					</div>	
					</div>
					<div class="col-sm-1">

					</div>
			

		</div>
		<div class="row" style="padding-top: 10px;  padding-bottom: 10px;">
		<div class="col-sm-9"></div>
		<div class="col-sm-2">
		<button type="submit" class="btn btn-primary" onclick="history.back();" value="Назад"/>Назад</div>
		</div>
	</section> 
</div>
<div class="container">
	<footer>
		<div class="row" style="margin-left: 0px; margin-right: 0px; padding-top: 22px;">
			<div class="col-sm-3  footerBoxText">
				Меню сайта
			</div>
			<div class="col-sm-6  footerBoxText">
				Контактные данные
			</div>
			<div class="col-sm-3 ">
				<span class="nameOfCompanyFooter">Arkada</span>
			</div>
		</div>
		<div class="row" style="padding-top: 22px;">
			<div class="col-sm-3">
				<div class="row">
					<div class="col-sm-6 text-right footerBoxTextMenu">
					<i class="fa fa-angle-double-right" aria-hidden="true"></i>
					</div>
					<div class="col-sm-6 text-left footerBoxTextMenu"><a href="index.html">главная</a></div>					
				</div>
				<div class="row">
					<div class="col-sm-6 text-right">
					<i class="fa fa-angle-double-right footerBoxTextMenu" aria-hidden="true"></i>
					</div>
					<div class="col-sm-6 text-left footerBoxTextMenu"><a href="project.html">проекты</a></div>					
				</div>
				<div class="row">
					<div class="col-sm-6 text-right">
					<i class="fa fa-angle-double-right footerBoxTextMenu" aria-hidden="true"></i>
					</div>
					<div class="col-sm-6 text-left footerBoxTextMenu"><a href="vacancy.html">вакансии</a></div>					
				</div>
				<div class="row">
					<div class="col-sm-6 text-right">
					<i class="fa fa-angle-double-right footerBoxTextMenu" aria-hidden="true"></i>
					</div>
					<div class="col-sm-6 text-left footerBoxTextMenu"><a href="rewiews.html">отзывы</a></div>					
				</div>
				<div class="row">
					<div class="col-sm-6 text-right">
					<i class="fa fa-angle-double-right footerBoxTextMenu" aria-hidden="true"></i>
					</div>
					<div class="col-sm-6 text-left footerBoxTextMenu"><a href="contact.html">контакты</a></div>					
				</div>				
			</div>
			<div class="col-sm-6">
				<div class="row">
				<ins><span class="footerBoxTextMenu">Адрес</span></ins></br>
				Санкт-Петербург, м. Ладожская, </br>Проспект Косыгина, 21 лит. А </br>
				<ins><span class="footerBoxTextMenu">Email</span></ins></br>
				<a href="mailto:info@arkadaspb.ru">info@arkadaspb.ru</a></br>
				<ins><span class="footerBoxTextMenu">Телефон</span></ins></br>
				8(812)577-24-99
				</div>
			</div>
			<div class="col-sm-3">
				<a href="\"><img src="img/logo.png" class="center-block" style="padding-top: 15px;"></a>
			</div>			
		</div>		
	</footer>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js" type="text/javascript"></script>	
	<script src="js/myscripts.js" type="text/javascript"></script>	
	
  </body>
</html>