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

  
  $errors = array(); 

  echo $_SESSION['user_id'];
    // initializing variables
  if( $_SESSION['user_id'] === 'None' ){
    array_push($errors, "Not logged in !");
    echo "<a class='nav-link' href='login.php'>Войдите чтобы задать вопрос</a></li>";
  }

  $user_id = $_SESSION["user_id"];

  $topic     = "";
  $question = "";

  // connect to the database
  $db = oci_pconnect("ecoeco", "qwerty123", "//localhost/xe");


  if (isset($_POST['ask_question']) && $_SESSION['user_id'] != 'None') {
    // receive all input values from the form
    $topic = $_POST['topic'];
    $question = $_POST['question'];

    if (empty($question)) { array_push($errors, "Where is question ?"); }

    echo "Sending your question...";

    // Altynay here is sql_query
    // You have to insert to questions table -> values - id, topic, question, org_id.
    $sql_query = "somtehn INSERT into questions (user_id, topic, question) values('$user_id', '$topic', '$question')";

    $result = oci_parse($db, $sql_query);
    oci_execute($result, OCI_DEFAULT);

    
    if ( count($errors) == 0 ) {
      //header('location: faq.php');
    }
    else{
      var_dump($errors);
      echo 'Some errors!';
    }
  }

  oci_close($db);
  ?>