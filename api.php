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

// area= /api/uk/$area
$request_parts = explode('/', $_SERVER['REQUEST_URI']);
if (array_key_exists(strtolower($request_parts{3}), $ofcomList))
{
	$area = strtolower($request_parts{3});
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
echo $randomPhoneNumber;
?>