<?php
require_once('database.php');

$array = explode(',', $_GET['array']);

$filtervalue = $connect->quote($_GET['filtervalue']);

$sql = "select longitude, latitude, $_GET[primarykey], $_GET[titlefield], $_GET[linkfield], $_GET[array]
		from $table
			where $_GET[filterfield] = $filtervalue
				order by $_GET[sortfield]";

$result = $connect->prepare($sql);
		
$result->execute()
		or die('Invalid Query');

$assets = '{"type": "FeatureCollection", "features": [';

while ($record = $result->fetch())
{
	$features = '{"type": "Feature", "geometry": {"type": "Point", "coordinates": [' . round($record['longitude'], 5) . ', ' . round($record['latitude'], 5) . ']}, "properties": {"' . $_GET['primarykey'] . '": "' . $record[$_GET['primarykey']] . '", "' . $_GET['titlefield'] . '": "' . $record[$_GET['titlefield']] . '", "' . $_GET['linkfield'] . '": "' . $record[$_GET['linkfield']] . '"';

	foreach ($array as $value)
	{
		$features .= ', "' . $value . '": "' . $record[$value] . '"';
	}

	$assets .= $features . '}},';
}

$assets = substr($assets, 0, -1) . ']}';

echo $assets;

$connect = null;
?>