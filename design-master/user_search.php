<?php
session_start();

// initializing variables
$first_name  = "";
$second_name = "";

$errors = array(); 

// connect to the database
$db = oci_pconnect("ecoeco", "qwerty123", "//localhost/xe");

// REGISTER USER
if (isset($_POST['search_user'])) {
    
  // receive all input values from the form
  $first_name = $_SESSION['first_name'];
  $second_name = $_POST['second_name'];

  // Altynay here is sql_query
  // you have to get all user that has substtring frist_name or second name,
  // example $first_name = 'bek', from DB you get = ['bekz', 'bekzat', 'bek', 'orynbek', ..] 
  $sql_query = "SELECT * FROM users WHERE FIRST_NAME = '$first_name' AND EMAIL = '$second_name'";
  // 

  //echo $user_check_query;
  
  $_SESSION['users_sql'] = $sql_query;

  // Finally, register user if there are no errors in the form
  if ( count($errors) == 0 ) {
   header('location: found_users.php');
  }
  else{
    var_dump($errors);
    echo 'Some errors!';
  }
}

  oci_close($db);
  ?>