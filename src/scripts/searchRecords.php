<?php
require_once("database.php");

if ($_GET['condition'] == "=")
{
	$sql = "select *
			from $table
				where $_GET[filter] = :value
					order by $_GET[filter]";
}
else
{
	$sql = "select *
			from $table
				where $_GET[filter] like :value
					order by $_GET[filter]";
}

$result = $connect->prepare($sql);

$result->bindValue(':value', $_GET['value']);

$result->execute()
		or die('Invalid Query');

$array = $result->fetchAll();

echo json_encode($array);

$connect = null;
?>