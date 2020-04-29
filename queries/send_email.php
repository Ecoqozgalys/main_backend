<?php
  session_start();
  $org_id = $_GET['org_id'];
  $email = $_GET['email'];

  $db = oci_pconnect("ecoeco", "qwerty123", "//localhost/xe");

  $type_of_material = $_SESSION['material'];
  $user_id = $_SESSION['user_id'];

  // Altynay here is sql_query
  // You have to insert request id, org _id, type of _material and so on to requests table;
  // (req_date DATE DEFAULT SYSDATE,
                  //  material_type varchar2(100) constraint req_type_nn not null,
                  //  user_id number(20) not null,
                  //  org_id number(20) not null,
                  //  constraint req_user_id FOREIGN KEY(user_id) references users,
                  //  constraint req_org_id FOREIGN KEY(org_id) references organizations)

  // $query = "INSERT INTO REQUEST VALUES(DEFAULT, '$type_of_material','$user_id','$org_id')"

  echo 'inserting for you a';
  $query = "ываы INSERT INTO requests (id, org_id, type_of_material, date)
                VALUES('$user_id', '$org_id', '$type_of_material', .... DEFAULT DATE)";

  $result = oci_parse($db, $query);
  oci_execute($result, OCI_DEFAULT);

  // Content-Type helps email client to parse file as HTML
  // therefore retaining styles
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "From: Your name <gimtimes@gmail.com>" . "\r\n";
  $message = "<html>
  <head>
  	<title>New message from website contact form</title>
  </head>
  <body>
  	<h1> I'd like to visit and leave some materials </h1>
  	<p> You can mail me ".$_SESSION['email']."</p>
  </body>
  </html>";
  if (mail('website_owner@example.com', 'subject', $message, $headers)) {
   echo "Email sent";
   echo "<a href='index.php'> Go home </a>";
  }else{
   echo "Failed to send email. Please try again later";
  }

?>
