<?php

function get_uri_dir()
{
	return preg_replace('/[^\/]+\.php(.*)?(\?.*)?$/i', '', $_SERVER['REQUEST_URI']);
}

function goto_index()
{
	$uri_dir = preg_replace('/[^\/]+\.php(.*)?(\?.*)?$/i', '', $_SERVER['REQUEST_URI']);
	header("Location: ".$uri_dir."index.php");
	exit();
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>