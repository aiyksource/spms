<?php
	define( 'DB_USER', 'root');
	define( 'DB_PASS', '');
	define( 'DB_NAME', 'spms');
	define( 'DB_HOST', 'localhost');
	define( 'DB_ENCODING', '');

	include_once "sql/ezsql/shared/ez_sql_core.php";
	include_once "sql/ezsql/mysqli/ez_sql_mysqli.php";

	$db = new ezSQL_mysqli(DB_USER, DB_PASS, DB_NAME, DB_HOST, DB_ENCODING);
?>