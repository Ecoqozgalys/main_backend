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

<?php

    if (isset($_GET['org_id'])) {
        
        $org_id = $_GET['org_id'];

        $db = oci_pconnect("ecoeco", "qwerty123", "//localhost/xe");
        // Altynay sql query
        // Get organization by org_id
        //$sql_query = "SELECT * from organizations where id = '$org_id'"; // something
        $sql_query = "SELECT * from users where ID = '$org_id'"; // something

        $result = oci_parse($db, $sql_query);
        oci_execute($result);

        $row = oci_fetch_array($result, OCI_BOTH);

        //var_dump($row);

        $org_name = $row['FIRST_NAME'];
        //$address = $row['ADDRESS'];
        $address = "";
        $contacts = $row['EMAIL'];
        
        // Altynai sql query
        // get all types of materials, save as string or something
        $type_of_materials = "";

        // Altynai sql query
        // get sale for this organization
        $sale = "";

        // Altynai chto tut?
        //$work_time = $row['??????'];
        $work_time = "";

        $url_request = "send_email.php?email=$contacts&org_id=$org_id";

    }

?>

<!DOCTYPE php>
<php>
<head>
  <title>FAQ</title>
  <link rel="stylesheet" type="text/css" href="style.css?ver=<?php echo rand(111,999)?>">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body class="back" style="background-color: #d3f0e0">
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
    </nav>

    <div class="row no-gutters profile-block">
        <div class="photo-card">
            <div class="col-md-4">
                <!--Upload image-->
                <img src="images/4.jpg" class="card-img" alt="Profile image">
            </div>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <!--Need data from table-->
                <h1 class="card-title">Brand Name <?php echo $org_name; ?></h1>
                <div class="sp_around">
                    <h4 class="card-text">Адрес: <?php echo $address; ?></h4>
                    <!--address--><h4></h4>
                </div>
                <div class="sp_around">
                    <h4 class="card-text">Контакты: <?php echo $contacts; ?></h4>
                    <!--contacts--><h4></h4>
                </div>
                <div class="sp_around">
                    <h4 class="card-text">Материалы: <?php echo $type_of_materials; ?></h4>
                    <!--материалы--><h4></h4>
                </div>
                <div class="sp_around">
                    <h4 class="card-text">При сдаче старых вещей, вы получаете скидку: </h4>
                    <!--Инфо о скидках--><h4>%<?php echo $sale; ?></h4>
                </div>
                <div>
                    <h4 class="card-text">График работы: <?php echo $work_time; ?></h4>
                    <!--working time--><h4></h4>
                </div>

                <div style="display: flex; justify-content: center; margin-top: 3vh;">
                    <?php echo "<a href = '$url_request' class='change' style='color: white; padding: 5px; margin-top: 5vh;'> Оставить запрос </a>\n"; ?>
                </div>
                    <p style="display: flex; justify-content: center; margin-top: 3vh;" class="card-text"><small class="text-muted">Информация о организации</small></p>

            </div>
        </div>
    </div>
    
  	
</body>
</html>
