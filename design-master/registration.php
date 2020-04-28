<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration page</title>
    <link rel="stylesheet" type="text/css" href="style.css?ver=<?php echo rand(111,999)?>">
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
			<a class="nav-link" href="index.php">Главная</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="locations.php">Пункты</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">Блог</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="faq.php">FAQ</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="registration.php">Войти</a>
		</li>
		</ul>
	</nav>
    <form method="post" action="registration.php" class="login">
		<center>
      		<div class="rectangle">
		        <img src = "images/logoo.png" >
		        <!--Input data-->
		        <h3>Регистрация</h3>
		        <input class="form-control mr-sm-2 email" type="search" name="first_name" placeholder="Имя" aria-label="Search" value="<?php echo $first_name; ?>">
		        <input class="form-control mr-sm-2 email" type="search" name="second_name" placeholder="Фамилия" aria-label="Search" value="<?php echo $second_name; ?>">
                
                <label for="cars">Статус  </label>
				<select class="form-control select">
  					<option value="volvo">Организация</option>
				  	<option value="saab">Пользователь</option>
				</select>
                
                <input class="form-control mr-sm-2 email" type="search" name="username" placeholder="Имя пользователя" aria-label="Search" value="<?php echo $username; ?>">
                <input class="form-control mr-sm-2 email" type="search" name="email" placeholder="Эл. почта" aria-label="Search" value="<?php echo $email; ?>">
                <input class="form-control mr-sm-2 email" style="margin-top: 10px;" type="search" name="password" placeholder="Пароль" aria-label="Search">
        
                <button class="p" type="submit" name="reg_user">Регистрация</button>
                <p class="regp">Уже есть акканут? <a href="login.php">Войти</a></p>
		    </div>
    	</center>
</form>
</div>
</body>
</html>
