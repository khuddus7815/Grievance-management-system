<?php
define('DB_SERVER','sdb-88.hosting.stackcp.net');
define('DB_USER','tranetra');
define('DB_PASS' ,'Du2cV6|)RqC=');
define('DB_NAME', 'tranetra-35313135a02b');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>