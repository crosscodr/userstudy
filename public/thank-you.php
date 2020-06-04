<?php
require_once '../config.inc.php';
//letzte Seite, Danke fürs Mitmachen
// remove all session variables
session_unset();
session_destroy();

// Unset the cookie on the client-side.
setcookie("PHPSESSID", "", 1); // Force the cookie to expire.
?>

<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="site.css">
	<title>BA Benutzerstudie - Ende</title>
</head>
<body>
	<h1><?=STUDYNAME?></h1>
	<h3><?=STUDYAUTHOR?></h3>

	<div id="outro">
		<h2>Herzlichen Dank fürs Mitmachen!!</h2>
		<p>Das wars auch schon :)</p>
	</div>

</body>
</html>
