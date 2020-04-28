<?php
session_start();

// initializing variables
$email    = "";
$city     = "";
$material = "";

$errors = array(); 

// connect to the database
$db = oci_pconnect("ecoeco", "qwerty123", "//localhost/xe");

// REGISTER USER
if (isset($_POST['find_organization'])) {
  // receive all input values from the form
  $email = $_SESSION['email'];
  $city = $_POST['city'];
  $material = $_POST['material'];

  $_SESSION['material'] = $material;    

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($email)) { array_push($errors, "User have to be logged in"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  echo $city;
  echo $material;
  // Altynay here is sql_query
  // you have to get all organizations where city and material equal from organizations table
  $get_organizations = "something SELECT * FROM users WHERE FIRST_NAME = '$city' AND EMAIL = '$material'";
  // 

  //echo $user_check_query;
  
  $_SESSION['organizations_sql'] = $get_organizations;

  echo 'hi';
  // Finally, register user if there are no errors in the form
  if ( count($errors) == 0 ) {
   header('location: organizations.php');
  }
  else{
    var_dump($errors);
    echo 'Some errors!';
  }
}

  oci_close($db);
  ?>