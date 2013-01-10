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
$ofcomList['Mobile']     = array('prefix' => "07700 900 ", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['Free']       = array('prefix' => "0808 157 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['Premium']    = array('prefix' => "0909 879 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['National']   = array('prefix' => "0306 999 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['Leeds']      = array('prefix' => "0113 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['Sheffield']  = array('prefix' => "0114 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['Nottingham'] = array('prefix' => "0115 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['Leicester']  = array('prefix' => "0116 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['Bristol']    = array('prefix' => "0117 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['Reading']    = array('prefix' => "0118 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['Birmingham'] = array('prefix' => "0121 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['Edinburgh']  = array('prefix' => "0131 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['Glasgow']    = array('prefix' => "0141 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['Liverpool']  = array('prefix' => "0151 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['Manchester'] = array('prefix' => "0161 496 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['London']     = array('prefix' => "0207 946 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['Tyneside']   = array('prefix' => "0191 498 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['NI']         = array('prefix' => "028 9018 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['Cardiff']    = array('prefix' => "029 2018 0", 'suffixStart' => 0, 'suffixEnd' => 999, 'length' => 3);
$ofcomList['Generic']    = array('prefix' => "01632 ",     'suffixStart' => 0, 'suffixEnd' => 999999, 'length' => 6);

// ?area=XX
if (array_key_exists($_GET["area"], $ofcomList))
{
	$area = $_GET["area"];
}
else
{
	$area = array_rand($ofcomList);
}

$prefix = $ofcomList[$area]['prefix'];
$min    = $ofcomList[$area]['suffixStart'];
$max    = $ofcomList[$area]['suffixEnd'];
$length = $ofcomList[$area]['length'];

$randomPhoneSuffix = str_pad(rand($min , $max ),$length,'0',STR_PAD_LEFT);

$randomPhoneNumber = $prefix . $randomPhoneSuffix;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8 />
		<title>PlaceNumber.net - Generate A Random Placeholder Telephone Number</title>
	</head>
	<body>
		<?php 
			echo "Your random " . $area . " demo phone number is " . $randomPhoneNumber;
		?>
		<h2>API Use</h2>
		Calling this page will result in a random number. You can use these query strings to get a number from a specific geographic location.<br>
		<?php
		foreach ($ofcomList as $key => $value) {
		    echo "<a href=\"?area=$key\">?area=$key</a><br />\n";
		}
		?>

		<p>Information from <a href="http://stakeholders.ofcom.org.uk/telecoms/numbering/guidance-tele-no/numbers-for-drama">Ofcom's Demo Number Page</a>
		</p>
	</body>
</html>