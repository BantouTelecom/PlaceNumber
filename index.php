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

function createApiList() {
	global $ofcomList;
	$server = $_SERVER['SERVER_NAME'];
	
	foreach ($ofcomList as $key => $value) {
		echo "<a href='http://$server/index.php/uk/$key'>$key</a>, ";
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		
		<link rel="shortcut icon" type="image/png" href="images/favicon.png">
		
		<!-- Set the viewport width to device width for mobile -->
		<meta name="viewport" content="width=device-width" />

		<title>Place Number || The Lab</title>

		<!-- Included CSS Files (Compressed) -->
		<link rel="stylesheet" href="stylesheets/foundation.min.css">
		<link rel="stylesheet" href="stylesheets/app.css">

		<script src="javascripts/modernizr.foundation.js"></script>

		<!-- IE Fix for HTML5 Tags -->
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		<script>
		function getNumber(name) {
			var number = null;
			var area = name.options[name.selectedIndex].value;
			var xmlHttp = null;
		    xmlHttp = new XMLHttpRequest();
		    xmlHttp.open( "GET", 'index.php/UK/' + area, false );
		    xmlHttp.send( null );
			number = xmlHttp.responseText;
			document.getElementById('number').innerHTML = 'Your Random Placeholder Telephone Number is: ' +number;		}
		</script>
	</head>
	<body>

		<header class="row">
			<div class="two columns">
				<a title="Return to theLab home page" href="https://thelab.o2.com/" target="_blank"><img class="logo" src="images/The_Lab.png" /></a>
			</div>
			<img class="beta" src="images/img-lab-beta-tag.png" alt="Beta Image">
			<nav class="ten columns" role="navigation">
				<a href="https://thelab.o2.com/who-we-are/">Who we are</a>
				<a href="https://thelab.o2.com/category/projects/">Projects</a>
				<a href="https://thelab.o2.com/category/events/">Events</a>
				<a href="https://thelab.o2.com/category/opinion/">Opinion</a>
				<a href="https://thelab.o2.com/category/case-studies/">Case Studies</a>
				<a href="https://thelab.o2.com/category/about-us/">About Us</a>
			</nav>
		</header>

		<div class="row">
			<section id="main-content" class="twelve columns">
				<h2><a class="title-link" href="#">Place Number</a></h2>
				<h3 class="topic">Generate UK Demo Numbers for Placeholders</h3>
				<p class="post-content">
					This service allows you to quickly generate UK telephone numbers suitable to use as placeholders.  
					The numbers are <em>guaranteed never to be routed</em>.  They are suitable for use in demo apps, as well as in videos, advertising campaigns, TV shows, and movies.<br>
					Confused? <a href="https://thelab.o2.com/2013/01/introducing-place-number/">Read the blog post about Place Number</a></p>
				<section class="post-section">

					<form class="custom">
						<!-- Custom Selects -->
						<label for="area">Generate a random demo phone number:</label>
						<?php createDropdown();?>
					</form>

					<div class="number">
						<p class="post-content" id="number"></p>
					</div>

					<h6>API Use</h6>
					<p class="post-content">You can request a random phone number by calling <pre>http://<?php echo $_SERVER['SERVER_NAME'];?>/uk/<code>$area</code></pre></p>
					<p class="post-content">Where <code>$area</code> is one of the following: 
						<?php createApiList();?>
					</p>
					<p class="post-content">These numbers are generated based on information from: <a href="http://stakeholders.ofcom.org.uk/telecoms/numbering/guidance-tele-no/numbers-for-drama">Ofcom's Demo Number Page</a></p>
				</section>
			</section>
		</div>

		<footer class="row">
			<div class="twelve columns">
				<p>All content &copy; 2013, theLab is a trade mark of Telefónica UK Limited. Telefónica UK Limited, 260 Bath Road, Slough, Berkshire SL14DX. Registered in England No. 1743099.</p>
			</div>
		</footer>

		<!-- Included JS Files (Compressed) -->
		<script src="javascripts/jquery.js"></script>
		<script src="javascripts/foundation.min.js"></script>

		<!-- Initialize JS Plugins -->
		<script src="javascripts/app.js"></script>


		<script>
			$(window).load(function(){
				$("#featured").orbit();
			});
		</script> 
	</body>
</html>