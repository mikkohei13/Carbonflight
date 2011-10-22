<?php
header('Content-Type: text/html; charset=utf-8');    

// -----------------------------------------------------------------
// Calculations
   
//echo "<pre>"; // DEBUG

$co2 = (int) $_GET['co2'];

if (!is_int($co2))
{
	exit("co2 must be an integer.");
}

$footprint = 8400;

$percentage = round($co2 / ($footprint + $co2) * 100, 0);
$percentageAdd = round($co2 / $footprint * 100, 0);


// -----------------------------------------------------------------
// Comparisons

// Laptop
$url = "http://carbon.to/laptop.json?co2=$co2";
$json = file_get_contents($url);
$array = json_decode($json, TRUE);

//print_r ($array);

$years = round($array['conversion']['amount'] / 8 / 365, 1);
$comparison['laptop'] = "<p>" . $years . " years using a laptop, 8 h per day</p>";


// TV
$url = "http://carbon.to/tv.json?co2=$co2";
$json = file_get_contents($url);
$array = json_decode($json, TRUE);

//print_r ($array);

$years = round($array['conversion']['amount'] / 8 / 365, 1);
$comparison['tv'] = "<p>" . $years . " years of watching a TV, 8 hours a day (32-inch flatscreen)</p>";


// Car
$url = "http://carbon.to/car.json?co2=$co2";
$json = file_get_contents($url);
$array = json_decode($json, TRUE);

//print_r ($array);

$comparison['car'] = "<p>" . $array['conversion']['amount'] . " km driving by a car</p>";


// Beef
$url = "http://carbon.to/beef.json?co2=$co2";
$json = file_get_contents($url);
$array = json_decode($json, TRUE);

//print_r ($array);

$comparison['beef'] = "<p>" . $array['conversion']['amount'] . " kg of cooked beef</p>";


// Beers
$url = "http://carbon.to/beers.json?co2=$co2";
$json = file_get_contents($url);
$array = json_decode($json, TRUE);

//print_r ($array);

$comparison['beers'] = "<p>" . $array['conversion']['amount'] . " " . $array['conversion']['unit'] . "<br />";
$i = 0;
while ($i < $array['conversion']['amount'])
{
	$comparison['beers'] .= "<img src=\"bm.png\" /> ";
	$i++;
}



// -----------------------------------------------------------------

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>CO2 emissions</title>
	<meta name="description" content="" />

	<link href="style.css" rel="stylesheet" />
	<!--[if IE]>
	<link href="style_ie.css" rel="stylesheet" />
	<![endif]-->
</head>

	<header><div>

<?php

// echo "<h1><strong>$co2 kg CO<sub>2</sub></strong> is <strong>$percentage %</strong> of your yearly emissions<h1>";
echo "<h1><strong>$co2 kg CO<sub>2</sub></strong> adds <strong>$percentageAdd %</strong> to your yearly emissions*<h1>\n\n";

?>

	</div></header>

	<section><div>
	
<?php

echo "<h3>$co2 kg CO<sub>2</sub> equals to</h3>\n\n";

foreach ($comparison as $key => $p)
{
	echo $p . "\n";
}

?>
	
	</div></section>
	
	<footer><div>
	
	<p>*Sweden's carbon footprint is 8400 kg per capita</p>
	
	<h4>Sources</h4>
	
	<p>Flight emissions: <a href="https://www.carbonplanet.com/shop/offsets?offset_type=Flight">Carbon Planet</a></p>
	<p>Sweden's carbon footprint: <a href="http://www.wwf.se/source.php/1211289/An_Analysis_of_Swedens_Carbon_Footprint.pdf">WWF: An Analysis of Sweden's Carbon Footprint</a></p>
	<p>Carbon comparison: <a href="http://carbon.to/">Carbon.to</a></p>

	</div></footer>
	

</body>
</html>
