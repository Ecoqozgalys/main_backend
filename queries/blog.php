
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
	<title>BLOG</title>
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
    <section class="back2">
      <h5 class="l-heading" style="margin-bottom: 5vh;">Читайте интересные статьи на нашем блоге</h5>

      <?php

        $db = oci_pconnect("ecoeco", "qwerty123", "//localhost/xe");
        
        // Altynay sql query
        // SELECT * FROM BLOG;
        // Get all data from Blog

        $sql_query = " SELECT * from users";

        $result = oci_parse($db, $sql_query);
        oci_execute($result);

        $cnt = 1;

        while (($row = oci_fetch_array($result, OCI_BOTH)) != false) {

            echo "<div class='faq-block'>\n";

            if( $cnt % 2 == 1 ){
              $img_cnt = $cnt % 10;
              if( $img_cnt == 0 ){
                $img_cnt = 10;
              }
              echo "<img src='images/".strval($img_cnt) .".jpg'>";
            }

            echo "<div class='faq-div'>";

            echo "<h4>".$row['FIRST_NAME']."</h4>\n"; // topic of artice
            echo "<p style='margin-top: 5vh; color: rgb(33,92,34);'>".$row['SECOND_NAME']."</p>"; // first paragraph

            // $blog_id = $row['BLOG_ID'];
            $blog_id = $row['ID'];
            $url = "article.php?blog_id=$blog_id";
            echo "<a href='$url' class='change'>Читать статью</a>";

            echo "  </div>";

            if( $cnt % 2 == 0 ){
              $img_cnt = $cnt % 10;
              if( $img_cnt == 0 ){
                $img_cnt = 10;
              }
              echo "<img src='images/".strval($img_cnt) .".jpg'>";
            }

            echo "</div>";

            $cnt ++;
        }

      ?>

    </section>
  </center>
</body>
</html>
