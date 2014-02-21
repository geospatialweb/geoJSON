<?php
require_once('database.php');

$geometry = array();

$recordCount = array();

$array = json_decode($_GET['json'], true);

$geometryField = $_GET['geometryfield'];

$latField = $_GET['latfield'];

$lngField = $_GET['lngfield'];

$primaryKey = $_GET['primarykey'];

for ($i = 0; $i < sizeof($array); $i++)
{
	$boolean = $array[$i]['geometryvalue'];
	$dataField = $array[$i]['datafield'];
	$id = $array[$i]['id'];
		
	$sql = "update $table
			set $dataField = :value
				where $primaryKey = $id";
					
	$result = $connect->prepare($sql);
	
	$result->bindValue(':value', $array[$i]['value']);
		
	$result->execute()
			or die('Invalid Query');
	
	if ($boolean == true)
	{
		$sql = "update $table
				set $geometryField = NULL
					where $primaryKey = $id";
		
		$result = $connect->prepare($sql);
		
		$result->execute()
				or die('Invalid Query');
	}

	if (!in_array($id, $recordCount))
	{
		$recordCount[] = $id;
	}
}

$sql = "select $primaryKey, $lngField, $latField
		from $table
			where $geometryField is NULL";

$result = $connect->prepare($sql);

$result->execute()
		or die('Invalid Query');

while ($record = $result->fetch())
{
	$geometry[$record[$primaryKey]] = "'POINT(" . $record[$lngField] . " " . $record[$latField] . ")'";
}

foreach ($geometry as $key => $value)
{
	$sql = "update $table
			set $geometryField = geography::STPointFromText($value, 4326)
				where $primaryKey = $key";
	
	$result = $connect->prepare($sql);
		
	$result->execute()
			or die('Invalid Query');
}

echo sizeof($recordCount);

$connect = null;
?>