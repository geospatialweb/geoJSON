<?php
require_once('database.php');

$count = 0;

$array = json_decode($_GET['json'], true);

foreach ($array as $value)
{	
	$sql = "delete from $table
			where $_GET[primarykey] = $value";
	
	$result = $connect->prepare($sql);
		
	$result->execute()
			or die('Invalid Query');
	
	$count++;
}

echo $count;

$connect = null;
?>