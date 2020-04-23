<?php

$conn = oci_connect("ecoeco", "qwerty123", "//localhost/xe");

$s = oci_parse($c, 'select * from employees');
oci_execute($s);
oci_fetch_all($s, $res);
var_dump($res);

?>
Compare this code to the code in the query_nonpooled.php file in the $HOME/public_html directory.

<?php

$c = oci_pconnect("phphol", "welcome", "//localhost/orcl");

$s = oci_parse($c, 'select * from employees');
oci_execute($s);
oci_fetch_all($s, $res);
var_dump($res);

?>