<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="back">
	<nav>
		<ul class="nav justify-content-center">
			<li class="nav-item">
				<a class="nav-link" href="index.html">Главная</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="locations.html">Пункты</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Блог</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">FAQ</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="login.php">Войти</a>
			</li>
		</ul>
	</nav>
    <form method="post" action="login.php" class = "login">
        <?php include('errors.php'); ?>
        <center>
      		<div class="rectangle">
		        <img src = "images/logoo.png" >
		        <h3>Ваш аккаунт</h3>
		        <input class="form-control mr-sm-2 email" type="email" placeholder="Эл. почта" aria-label="Search" name="email">
                <input class="form-control mr-sm-2 email" style="margin-top: 10px;" type="password" placeholder="Пароль" aria-label="Search" type="password" name="password">
                <button type="submit" class="p" name="login_user">Войти</button>
                <p class="regp">Ещё нету аккаунта?<a href="registration.php">Зарегистрироваться</a></p>
		    </div>
    	</center>
	</section>
</div>
</body>
</html>
