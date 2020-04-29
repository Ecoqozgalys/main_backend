<?php
session_start();

// initializing variables
$username    = "";
$email       = "";
$first_name  = "";
$second_name = "";
$errors = array(); 

if( !isset($_SESSION['user_id']) ){
  $_SESSION['user_id'] = 'None';
}

// connect to the database
$db = oci_pconnect("ecoeco", "qwerty123", "//localhost/xe");

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $first_name = $_POST['first_name'];
  $second_name = $_POST['second_name'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  
  // Altynay here is sql_query
  // Get all distinct users where username or email equals, to check if user has been registered before
  $user_check_query = "SELECT DISTINCT username, email FROM users WHERE username='$username' OR email='$email'";
  //$user_check_query = "SELECT * FROM users";
  //echo $user_check_query;
  $result = oci_parse($db, $user_check_query);
  oci_execute($result);
  oci_fetch_all($result, $user);

  var_dump($user);

  if ($user) { // if user exists
    if ($user['USERNAME'][0] === $username) {
      echo $user['USERNAME'][0];
      echo $username;
      array_push($errors, "Username already exists");
    }

    if ($user['EMAIL'][0] === $email) {
      array_push($errors, "email already exists");
    }
  }

  var_dump($errors);

  echo 'hi';
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password);//encrypt the password before saving in the database
    echo 'inserting for you a';
    // Altynay here is sql_query
    // Insert new user to users table, do not forget about auto incrementing user_id
  	$query = "INSERT INTO users (id, username, first_name, second_name, email, password)
                VALUES(user_seq.NEXTVAL, '$username', '$first_name', '$second_name', '$email', '$password')";

    $result = oci_parse($db, $query);
    oci_execute($result, OCI_DEFAULT);

    //var_dump($cq);

  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
    
    echo 'hello ad';

    header('location: index.php');
  }
  else{
    echo 'Some errors!';
  }
}

// ... 
if (isset($_POST['login_user'])) {
    $email =  $_POST['email'];
    $password =  $_POST['password'];
  
    if (empty($email)) {
        array_push($errors, "email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        // Altynay here is sql_query
        // Get users where email and password equals, to check email and password, 
        $query = "SELECT id FROM users WHERE email='$email' AND password='$password'";
        
        $results = oci_parse($db, $query);
        oci_execute($results);
        oci_fetch_all($results, $results);

        //var_dump($results);
        
        $_SESSION['user_id'] = $results['ID'][0];
        if ( sizeof( $results['ID'] ) >= 1) {
          $_SESSION['email'] = $email;
          $_SESSION['success'] = "You are now logged in";
          header('location: index.php');
        }else {
            array_push($errors, "Wrong email/password combination");
        }
    }
  }
  oci_close($db);
  ?>