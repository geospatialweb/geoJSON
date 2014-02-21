<?php
require_once("database.php");

$sql = "select *
		from $table
			where $_GET[geometryfield].STIntersects(geography::STPolyFromText($_GET[geometryvalue], 4326)) = 1
				order by $_GET[titlefield]";

$result = $connect->prepare($sql);
		
$result->execute()
		or die('Invalid Query');

$array = $result->fetchAll();

echo json_encode($array);

$connect = null;
?>