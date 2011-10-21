<?php
header('Content-Type: text/html; charset=utf-8'); 
   
   
//echo "<pre>"; // DEBUG

$from = ($_GET['from']);
$to = ($_GET['to']);


require_once "../testdata.php";

if (is_array($to))
{
	foreach ($to as $key => $singleTo)
	{
		$result[$key] =  $distance[$from][$singleTo] * $carbonKgPerKm;
	}
}
else
{
	$result[0] =  $distance[$from][$to] * $carbonKgPerKm;	
}

$json = json_encode($result);


//echo "<hr />";
//print_r ($result);
print_r ($json);

?>