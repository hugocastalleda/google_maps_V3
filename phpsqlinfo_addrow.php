<?php
require("phpsqlinfo_dbinfo.php");

// Gets data from URL parameters



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

// We're putting all our files in a directory called images.
$uploaddir = 'images/';

// The posted data, for reference
$pais = $_POST['pais'];
$departamento = $_POST['departamento'];
$municipio = $_POST['municipio'];
$barrio = $_POST['barrio'];
$direccion = $_POST['direccion'];
$type = $_POST['type'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$file = $_POST['value'];
$name = $_POST['name'];

// Get the mime
$getMime = explode('.', $name);
$mime = end($getMime);

// Separate out the data
$data = explode(',', $file);

// Encode it correctly
$encodedData = str_replace(' ','+',$data[1]);
$decodedData = base64_decode($encodedData);

// You can use the name given, or create a random name.
// We will create a random name!

$randomName = substr_replace(sha1(microtime(true)), '', 12).'.'.$mime;


if(file_put_contents($uploaddir.$randomName, $decodedData)) {


// Insert new row with user data
$query = sprintf("INSERT INTO markers " .
         " (id, pais, departamento, municipio, barrio, direccion, type, img, lat, lng) " .
         " VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
         mysql_real_escape_string(utf8_decode($pais)),
         mysql_real_escape_string(utf8_decode($departamento)),
		 mysql_real_escape_string(utf8_decode($municipio)),
		 mysql_real_escape_string(utf8_decode($barrio)),
		 mysql_real_escape_string(utf8_decode($direccion)),
		 mysql_real_escape_string(utf8_decode($type)),
		 mysql_real_escape_string(utf8_decode($randomName)),
         mysql_real_escape_string(utf8_decode($lat)),
         mysql_real_escape_string(utf8_decode($lng)));

$result = mysql_query($query);

if (!$result) {
  die('Invalid query: ' . mysql_error());
}




	echo $randomName.":uploaded successfully";
}
else {
	// Show an error message should something go wrong.
	echo "Something went wrong. Check that the file isn't corrupted";
}


?>