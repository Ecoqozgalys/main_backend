<?php include('server.php') ?>
<?php 
  if (!isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "You must log in first";
  }
  if (!isset($_SESSION['user_id'])) {
	$_SESSION['user_id'] = "None";
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
  }

  $db = oci_pconnect("ecoeco", "qwerty123", "//localhost/xe");

  // Altynay here is sql_query
  // get all organizations
  $get_organizations = "SELECT * FROM users";
  // 

  //echo $user_check_query;
  $result = oci_parse($db, $get_organizations);
  oci_execute($result);
  oci_fetch_all($result, $organizations);

?>

<!DOCTYPE html>
<html>
<head>
	<title>EcoQozgalys</title>
	<link rel="stylesheet" type="text/css" href="style.css?ver=<?php echo rand(111,999)?>">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>

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
      
		<!-- logged in user information -->
		<?php  
			if (isset($_SESSION['email'])) {
				echo "<li class='nav-item'><a class='nav-link' href='user_page.php?user_id=".$_SESSION['user_id']."'>".$_SESSION['email']."</a></li>";
				echo "<li class='nav-item'><a class='nav-link' href='index.php?logout='1'' style='color: red;'>logout</a></li>";
			}
			else{
				echo "<a class='nav-link' href='login.php'>Войти</a></li>";
			}
		?>
    </ul>
	<form method="post" action="booking.php" class="main">
		
		<div class="div1">
			<img src="images/logoo.png">
			<h4 class = "h5">Забота об экологии — это ответственность не только государства или общественных организаций, но и каждого отдельного члена общества.</h4>
			<!--Dropdown and choose city, here need backend 
				(to view list of cities from table)-->
				
			<?php
					
				echo "<select class='form-control select' name='city' type='city'>\n";
				foreach ($organizations['FIRST_NAME'] as $item) {
					echo "<option class='option' value=\"".($item !== null ? htmlentities($item, ENT_QUOTES) : "")."\">".($item !== null ? htmlentities($item, ENT_QUOTES) : "")."</option>";
				}
				echo "</select>\n";

				echo "<select class='form-control select' name='material' type='material'>\n";
				foreach ($organizations['EMAIL'] as $item) {
					echo "<option class='option' value=\"".($item !== null ? htmlentities($item, ENT_QUOTES) : "")."\">".($item !== null ? htmlentities($item, ENT_QUOTES) : "")."</option>";
				}
				echo "</select>\n";

			?>

			<button class="p" type="submit" name="find_organization">Поиск</button>
		</div>

		<img src="images/p.jpg" class = "bigIm">
		</form>
</body>
</html>
