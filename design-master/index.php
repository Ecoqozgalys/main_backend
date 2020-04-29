<?php include('server.php') ?>
<?php 
		
	// echo $_SESSION['user_id'];

  if (!isset($_SESSION['email'])) {
	  $_SESSION['msg'] = "You must log in first";
	  $_SESSION['user_id'] = 'None';
  }
  if (!isset($_SESSION['user_id'])) {
	$_SESSION['user_id'] = "None";
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
	unset($_SESSION['email']);
	$_SESSION['user_id'] = 'None';
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
        <a class="nav-link" href="community.php">Сообщество</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="blog.php">Блог</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="faq.php">FAQ</a>
      </li>
      
		<!-- logged in user information -->
		<?php  
			if (isset($_SESSION['email'])) {
				echo "<li class='nav-item'><a class='nav-link' href='profile.php?user_id=".$_SESSION['user_id']."'>".$_SESSION['email']."</a></li>";
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

	<center >
    	<section>
    		<div class="brands-section">
    			<h5 class = "change" style="margin-bottom: 5vh;">Бренды, принимающие вещи</h5>
    			<img src="images/3.jpg" >
				
				<?php  

					$db = oci_pconnect("ecoeco", "qwerty123", "//localhost/xe");
					// Altynay sql query
					// Get all brands, join tables organizations and sales
					$sql_query = " SELECT * from users";

					$result = oci_parse($db, $sql_query);
					oci_execute($result);

					while (($row = oci_fetch_array($result, OCI_BOTH)) != false) {
			
						echo "<div class='sp_around' style='margin: 2vh 5vw 2vh 7vw; border:2px solid rgb(123, 222, 164);'>\n";
						
						echo "  <div>\n";
						echo "		<h4>".$row['FIRST_NAME']."</h4>\n"; // brand _ name
						echo "	</div>\n";

						$org_id = $row['ID'];
						$url_profile = "org_profile.php?org_id=$org_id";

						echo "	<a href = '$url_profile' class='change'>Подробнее</a>"; // detailed organizations link

						echo "</div>";
						
					}

				?>  

    		</div>

    	</section>
	</center>

</body>
</html>
