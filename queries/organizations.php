<?php 
  session_start(); 

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

  <center style= "margin-top: 3vh;">
    <h5 class="l-heading">Пункты приема второсырья, результаты</h5>
		<img src="images/sort.jpg" style="width: 30vw; ">
    <!--Results of search-->
    
    <div class="org-table">;

      <?php 

        $db = oci_pconnect("ecoeco", "qwerty123", "//localhost/xe");
        $get_organizations = $_SESSION['organizations_sql'];

        $result = oci_parse($db, $get_organizations);
        oci_execute($result);

        while (($row = oci_fetch_array($result, OCI_BOTH)) != false) {
  
            $org_email = $row['EMAIL'];
            $org_id = $row['ID'];

            echo "<div class = 'org-card'>\n";
            
            echo "<h5>".$row['FIRST_NAME']."</h5>\n";
            echo "<p>Address: ".$row['SECOND_NAME']."</p>\n";
            echo "<p>Contacts: ".$row['EMAIL']."</p>\n";

            $url_request = "send_email.php?email=$org_email&org_id=$org_id";
            $url_profile = "org_profile.php?org_id=$org_id";

            echo "<a href = '$url_profile' class='change' style='color: white; padding: 5px; margin-top: 5vh;'> Подробнее </a>\n"; 
            echo "<a href = '$url_request' class='change' style='color: white; padding: 5px; margin-top: 5vh;'> Leave request </a>\n";

            echo "</div>";
        }

        echo "</table>\n";

      ?>  
			
		</div>

	</center>
</body>
</html>
