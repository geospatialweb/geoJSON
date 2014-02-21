<?php
require_once('database.php');

$dom = new DOMDocument('1.0', 'utf-8');
$dom->formatOutput = true;
$node = $dom->createElement('columns');
$root_node = $dom->appendChild($node);

$sql = "select COLUMN_NAME, DATA_TYPE
		from INFORMATION_SCHEMA.Columns
			where TABLE_NAME = '$table'";

$result = $connect->prepare($sql);
		
$result->execute()
		or die('Invalid Query');

while ($record = $result->fetch())
{
	$node = $dom->createElement('column', $record['COLUMN_NAME']);
	$node = $root_node->appendChild($node);
	$node->setAttribute('type', $record['DATA_TYPE']);
}

header('Content-type: text/xml');
echo $dom->saveXML();

$connect = null;
?>