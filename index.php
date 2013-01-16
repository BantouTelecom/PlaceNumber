<?php
// http://stakeholders.ofcom.org.uk/telecoms/numbering/guidance-tele-no/numbers-for-drama
/*
Geographic Area 	Geographic Area Code 	Telephone Number Range
Leeds	0113	496 0000 to 496 0999
Sheffield	0114	496 0000 to 496 0999
Nottingham	0115	496 0000 to 496 0999
Leicester	0116	496 0000 to 496 0999
Bristol	0117	496 0000 to 496 0999
Reading	0118	496 0000 to 496 0999
Birmingham	0121	496 0000 to 496 0999
Edinburgh	0131	496 0000 to 496 0999
Glasgow	0141	496 0000 to 496 0999
Liverpool	0151	496 0000 to 496 0999
Manchester	0161	496 0000 to 496 0999
London	020	7946 0000 to 7946 0999
Tyneside/Durham/Sunderland	0191	498 0000 to 498 0999
Northern Ireland 	028	9018 0000 to 9018 0999
Cardiff	029 	2018 0000 to 2018 0999
Mobile	07700 900000 to 900999
Freephone	08081 570000 to 570999
Premium Rate Services	0909 8790000 to 8790999
UK Wide 	03069 990000 to 990999
*/

$ofcomList =  array();
//	Name - Prefix - Suffix Start - Suffix End - Length
$ofcomList['mobile']     = array('prefix' => "07700 900 ", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['free']       = array('prefix' => "0808 157 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['premium']    = array('prefix' => "0909 879 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['national']   = array('prefix' => "0306 999 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['leeds']      = array('prefix' => "0113 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['sheffield']  = array('prefix' => "0114 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['nottingham'] = array('prefix' => "0115 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['leicester']  = array('prefix' => "0116 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['bristol']    = array('prefix' => "0117 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['reading']    = array('prefix' => "0118 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['birmingham'] = array('prefix' => "0121 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['edinburgh']  = array('prefix' => "0131 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['glasgow']    = array('prefix' => "0141 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['liverpool']  = array('prefix' => "0151 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['manchester'] = array('prefix' => "0161 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['london']     = array('prefix' => "0207 946 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['tyneside']   = array('prefix' => "0191 498 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['ni']         = array('prefix' => "028 9018 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['cardiff']    = array('prefix' => "029 2018 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['generic']    = array('prefix' => "01632 ",     'suffixStart' => 0, 'suffixEnd' => 999999, 'length' => 6);

// area= /index.php/uk/$area
//	If the "API" is called (/uk/$area) send the number and nothing else.
$request_parts = explode('/', $_SERVER['REQUEST_URI']);
if (array_key_exists(strtolower($request_parts{3}), $ofcomList))
{
	$area = strtolower($request_parts{3});

	$prefix = $ofcomList[$area]['prefix'];
	$min    = $ofcomList[$area]['suffixStart'];
	$max    = $ofcomList[$area]['suffixEnd'];
	$length = $ofcomList[$area]['length'];

	$randomPhoneSuffix = str_pad(rand($min , $max ),$length,'0',STR_PAD_LEFT);

	$randomPhoneNumber = $prefix . $randomPhoneSuffix;
	echo $randomPhoneNumber;
	die();
}

//	If no API is called, return the index page.

function createDropdown() {
	echo '<select name="area" id="area" onchange="getNumber(this)">
			<option value="">Select an area code</option>';
	global $ofcomList;
	foreach ($ofcomList as $key => $value) {
		if (strlen($key) == 2)	//	Catches NI.
		{
			$displayName = strtoupper($key);
		}
		else
		{
			$displayName = ucfirst($key);
		}
		echo '<option value="'.$key.'">'.$displayName.'</option>';
	}
	echo '</select>';
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8 />
		<title>PlaceNumber.net - Generate A Random Placeholder Telephone Number</title>
		<script>
		function getNumber(name) {
			var number = null;
			var area = name.options[name.selectedIndex].value;
			var xmlHttp = null;
		    xmlHttp = new XMLHttpRequest();
		    xmlHttp.open( "GET", 'UK/' + area, false );
		    xmlHttp.send( null );
			number = xmlHttp.responseText;
			document.getElementById('number').innerHTML = 'Your Random Telephone Number is: ' +number;		}
		</script>
	</head>
	<body>
		<h1>PlaceNumber<h1>
		<h4>Generate UK Demo Numbers for Placeholders</h4>
		<h2>Generate a Number</h2>
		<label for="area">Select an Area:</label>
		<?php createDropdown();?>
		<div id=number></div>
		<h2>API Use</h2>
		You can request a random number by calling <pre>http://<?php echo $_SERVER['SERVER_NAME'];?>/uk/[area]</pre>
	
		<p>Information is from <a href="http://stakeholders.ofcom.org.uk/telecoms/numbering/guidance-tele-no/numbers-for-drama">Ofcom's Demo Number Page</a>
		</p>
	</body>
</html>