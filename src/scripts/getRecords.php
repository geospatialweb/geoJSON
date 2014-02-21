<?php
require_once("database.php");

$titlevalue = $connect->quote($_GET['titlevalue']);

$sql = "select *
		from $table
			where $_GET[titlefield] = $titlevalue
				order by $_GET[titlefield]";

$result = $connect->prepare($sql);
		
$result->execute()
		or die('Invalid Query');

$array = $result->fetchAll();

echo json_encode($array);

$connect = null;
?>