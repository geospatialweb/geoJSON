<?php
require_once('database.php');

$sql = "select COLUMN_NAME, DATA_TYPE
		from INFORMATION_SCHEMA.Columns
			where TABLE_NAME = '$table'";

$result = $connect->prepare($sql);
		
$result->execute()
		or die('Invalid Query');

$array = $result->fetchAll();

echo json_encode($array);

$connect = null;
?>