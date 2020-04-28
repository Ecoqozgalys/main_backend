<?php
session_start();

// initializing variables

if( $_SESSION['user_id'] === 'None' ){
  echo "<a class='nav-link' href='login.php'>Войдите чтобы задать вопрос</a></li>";
}

$user_id = $_SESSION["user_id"];

$topic     = "";
$question = "";

$errors = array(); 

// connect to the database
$db = oci_pconnect("ecoeco", "qwerty123", "//localhost/xe");


if (isset($_POST['ask_question']) && isset($_SESSION['email'])) {
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
    header('location: faq.php');
  }
  else{
    var_dump($errors);
    echo 'Some errors!';
  }
}

  oci_close($db);
  ?>