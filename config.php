<?php

$DB_SERVER = '//localhost/xe';
$DB_USERNAME = 'ecoeco';
$DB_PASSWORD = 'qwerty123'; 

$conn = oci_connect($DB_USERNAME, $DB_PASSWORD, $DB_SERVER);

if($conn === false){
    echo ("ERROR: Could not connect. " );
}
else{
    echo 'Succes'; 
}

oci_close($conn);

?>