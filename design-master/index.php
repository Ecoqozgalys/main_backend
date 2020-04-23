<?php 
  session_start(); 

  if (!isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>EcoQozgalys</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>

    <div class="content">
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
            <h3>
            <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
            ?>
            </h3>
        </div>
        <?php endif ?>

        <!-- logged in user information -->
        <?php  if (isset($_SESSION['email'])) : ?>
            <p>Welcome <strong><?php echo $_SESSION['email']; ?></strong></p>
            <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
        <?php endif ?>
    </div>

	<ul class="nav justify-content-center">
		<li class="nav-item">
			<a class="nav-link active" href="#">Главная</a>
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
	<section class = "main">
		<div class="div1">
			<img src="images/logoo.png">
			<h4 class = "h5">Забота об экологии — это ответственность не только государства или общественных организаций, но и каждого отдельного члена общества.</h4>
			<a href="" class="p">Пункты сдачи</a>
			<!--Dropdown and choose city, here need backend 
				(to view list of cities from table)-->
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	Выберите город
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				    	<a class="dropdown-item" href="#">Action</a>
				   		<a class="dropdown-item" href="#">Another action</a>
				    	<a class="dropdown-item" href="#">Something else here</a>
				  	</div>
				</div>
		</div>
		<img src="images/p.jpg" class = "bigIm">
	</section>
</body>
</html>
