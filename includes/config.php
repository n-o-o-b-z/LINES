<?php 
// DB credentials.
define('DB_HOST','cpanel08wh');
define('DB_USER','kchaqayw_admin');
define('DB_PASS','June26,2022c');
define('DB_NAME','kchaqayw_bbdms');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>