<?php
header('Content-Type: text/html; charset=utf-8'); 
   
   
//echo "<pre>"; // DEBUG

$from = ($_GET['from']);
$to = ($_GET['to']);


require_once "../testdata.php";

// Generates data-array
if (is_array($to))
{
	foreach ($to as $key => $singleTo)
	{
		$result[$singleTo] =  $distance[$from][$singleTo] * $carbonKgPerKm;
	}
}
else
{
	$result[$to] =  $distance[$from][$to] * $carbonKgPerKm;	
}

$json = json_encode($result);

// Wraps as JSONP...
if (isset($_GET['callback']))
{
	$callback = $_GET['callback'];
	echo $callback . "(" . $json . ");";
}
// ..or echoes simple JSON
else
{
	echo $json;
}



?>