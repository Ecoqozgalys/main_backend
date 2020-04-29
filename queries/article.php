
<?php
  session_start();
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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Article</title>
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
   <center >

    <?php

        if( isset($_GET['blog_id']) ){

            $blog_id = $_GET['blog_id'];

            $db = oci_pconnect("ecoeco", "qwerty123", "//localhost/xe");

            // Altynay sql query
            // Get article by blog_id
            //$sql_query = "SELECT main_content from blog where blog_id = '$blog_id'";
            $sql_query = "SELECT * from users where ID = '$blog_id'"; // something

            $result = oci_parse($db, $sql_query);
            oci_execute($result);

            $row = oci_fetch_array($result, OCI_BOTH);

            //var_dump($row);

            $topic = $row['FIRST_NAME'];
            $header = $row['SECOND_NAME'];
            $text = $row['SECOND_NAME'];

            $random_image_number = rand(1, 10);

        }

    ?>

   <section class="back2">
    <h5 class="l-heading" style="margin-bottom: 5vh;">Читайте интересные статьи на нашем блоге</h5>
    <div style="display: flex;justify-content: center;flex-direction: column; margin: 5vh 15vw; background-color: white; padding: 20px;
    text-align: left">

        <?php echo "<img src='images/".$random_image_number.".jpg' style='width: 30vw; margin-left: 15vw;''>"; ?>
        <!--Article from blog-->
            <h4> <?php echo $topic; ?> </h4>
            <p style="margin-top: 5vh; color: rgb(33,92,34);">

                <?php echo $header; ?>
                <br>
                <?php echo $text; ?>

            </p>
      </div>
      <a href="blog.php" class="change">Назад</a>
    </section>
  </center>
</body>
</html>
