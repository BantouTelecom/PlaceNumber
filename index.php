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

$ofcomList =  array(
'Mobile',
'Free',
'Premium',
'National',
'Leeds',
'Sheffield',
'Nottingham',
'Leicester',
'Bristol',
'Reading',
'Birmingham',
'Edinburgh',
'Glasgow',
'Liverpool',
'Manchester',
'London',
'Tyneside',
'NI',
'Cardiff',
'Generic'
);

function createDropdown($arr, $frm) {
	echo '<select name="'.$frm.'" id="'.$frm.'" onchange="getNumber(this)"><option value="">Select one…</option>';
	foreach ($arr as $key => $value) {
		echo '<option value="'.$value.'">'.$value.'</option>';
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
		    xmlHttp.open( "GET", '/api.php/UK/' + area, false );
		    xmlHttp.send( null );
			number = xmlHttp.responseText;
			document.getElementById('number').innerHTML = 'Your Random Number is: ' +number;		}
		</script>
	</head>
	<body>
		<h2>Get a Random Phone Number</h2>
		<label for="area">Select an Area:</label>
		<?php createDropdown($ofcomList, 'area');?>
		<div id=number></div>
		<h2>API Use</h2>
		You can request a random number by calling http://<?php echo $_SERVER['SERVER_NAME'];?>/api.php/uk/[area]
	
		<p>Information from <a href="http://stakeholders.ofcom.org.uk/telecoms/numbering/guidance-tele-no/numbers-for-drama">Ofcom's Demo Number Page</a>
		</p>
	</body>
</html>