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
  // get top users
  // Sort by number of requests sent to organizations
  // Number of asked questions
  $sql_query = "SELECT * FROM users FETCH FIRST 5 ROWS ONLY";
  // 

  //echo $user_check_query;
  $top_users = oci_parse($db, $sql_query);
  oci_execute($top_users);

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
        <a class="nav-link" href="#">Блог</a>
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
    
    <form method="post" action="user_search.php" class="login">
		<center>
      		<div class="rectangle">
		        <img src = "images/logoo.png" >
		        <!--Input data-->
		        <h3>Поиск пользователя</h3>
		        <input class="form-control mr-sm-2 email" type="search" name="first_name" placeholder="Имя" aria-label="Search" value="<?php echo $first_name; ?>">
		        <input class="form-control mr-sm-2 email" type="search" name="second_name" placeholder="Фамилия" aria-label="Search" value="<?php echo $second_name; ?>">
            
                <button class="p" type="submit" name="search_user">Поиск</button>
		    </div>
    	</center>
    </form>

	<center>
    	<section style = "margin-top: 100px">
    		<div class="brands-section">
    			<h5 class = "change" style="margin-bottom: 5vh;">Самые активные пользователи</h5>
    			<img src="images/2.jpg" >
				
				<?php  

                    echo "<table border='1' style='margin-top: 25px; font-size: 18px;'>\n";

                    echo "<tr> 
                        <td><b>Name</b></td> 
                        <td><b>Number of requests</b></td> 
                        <td><b>Number of questions</b></td> 
                        <td><b>email</b></td> 
                        <td><b>city</b></td> 
                        </tr>";

                    while (($row = oci_fetch_array($top_users, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                        echo "<tr>\n";

                        $user_id = $row['ID'];
                        $url_profile = "profile.php?user_id=$user_id";
                        
                        // Altynay here is sql query
                        // get number of requests made by user by user_id
                        $sql_query = "";

                        $number_of_requests = 0;

                        // Altynay here is sql query
                        // get number of questions made by user by user_id
                        $sql_query = "";

                        $number_of_questions = 0;

                        echo "    <td><a href = '$url_profile'>".$row['FIRST_NAME']." ".$row['SECOND_NAME']."</a></td>\n";
                        echo "    <td>".$number_of_requests."</td>\n";
                        echo "    <td>".$number_of_questions."</td>\n";
                        echo "    <td>".$row['EMAIL']."</td>\n";
                        echo "    <td>".$row['CITY']."</td>\n";
                        echo "</tr>\n";
                    }
                    echo "</table>\n";  

				?>  

    		</div>
    	</section>
	</center>

</body>
</html>
