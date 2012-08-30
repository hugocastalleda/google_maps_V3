<?php
require("phpsqlinfo_dbinfo.php");

// Gets data from URL parameters
$pais = $_GET['pais'];
$departamento = $_GET['departamento'];
$municipio = $_GET['municipio'];
$barrio = $_GET['barrio'];
$direccion = $_GET['direccion'];
$type = $_GET['type'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];


// Opens a connection to a MySQL server
$connection = mysql_connect ("localhost", $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Insert new row with user data
$query = sprintf("INSERT INTO markers " .
         " (id, pais, departamento, municipio, barrio, direccion, type, lat, lng) " .
         " VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
         mysql_real_escape_string($pais),
         mysql_real_escape_string($departamento),
		 mysql_real_escape_string($municipio),
		 mysql_real_escape_string($barrio),
		 mysql_real_escape_string($direccion),
		 mysql_real_escape_string($type),
         mysql_real_escape_string($lat),
         mysql_real_escape_string($lng));

$result = mysql_query($query);

if (!$result) {
  die('Invalid query: ' . mysql_error());
}

?>
