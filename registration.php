<html>

<body>

<?php session_start();
?> 

<?php $con=oci_connect("scott", "tiger", "localhost/orcl"); //connection string 

if ( !$con) {
    $m=oci_error();
    echo $m['message'],
    "\n";
    //error fuction returns an oracle message.
    exit;
    $query="SELECT ID  FROM users WHERE employee_id =: user_bv and name =: name and password =: pwd ";
    //query is sent to the db to fetch row id.
    $stid=oci_parse($con, $query);

    /*oci_parse fuction prepares the db to execute the statement.
    requires two parameters resource($con)and sql string.*/
    if (isset($_POST['user']) || isset($_POST['name']) || isset($_POST['pwd'])) {
        $user=$_POST['user'];
        $name=$_POST['name'];
        $pass=$_POST['pwd'];
    }

    oci_bind_by_name($stid, ':user_bv', $user);
    oci_bind_by_name($stid, ':name', $name);
    oci_bind_by_name($stid, ':pwd', $pass);
    /*oci_bind_by_name function tells php which variable to use.
    They are references of the original variables.*/
    oci_execute($stid);
    $row=oci_fetch_array($stid, OCI_ASSOC);
    //oci_fetch_array returns a row from the db.

    if ($row) {
        $_SESSION['user']=$_POST['user'];
        echo "log in successful";
    }

    else {
        echo("The person ".$name. " is not found .
Please check the spelling and try again or check password ");
exit;
        }

        $ID=$row['ID'];
        oci_free_statement($stid);
        oci_close($con);
        header('Location: wel.php');
        //header function locates you to a welcome page saved s wel.php
        
?> </body> </html>