<meta charset="UTF-8">

<form action="#" method="post">

Name: <input type='text' id='name' name='name' />
Meta: <input type='text' id='dname' name='dname' />
<br />
Typ: <select type='text' id='type' name='type'>
	<option value="active">Active</option>
	<option value="passive">Passive</option>
</select>
<br />
Popis lvl1: <textarea id='d1' name='d1'></textarea>
<br />
Popis lvl2: <textarea id='d2' name='d2'></textarea>
<br />
Popis lvl3: <textarea id='d3' name='d3'></textarea>
<br />
Stat: <input type='text' id='attr' name='attr' />
OR
Stat: <input type='text' id='altattr' name='altattr' />
<br />
Požadavek1 název: <input type='text' id='req1' name='req1' />
Požadavek1 hodnota: <input type='text' id='req1v' name='req1v' />
OR
Požadavek1 název: <input type='text' id='altreq1' name='altreq1' />
Požadavek1 hodnota: <input type='text' id='altreq1v' name='altreq1v' />
OR
Požadavek1 název: <input type='text' id='altaltreq1' name='altaltreq1' />
Požadavek1 hodnota: <input type='text' id='altaltreq1v' name='altaltreq1v' />
<br />
Požadavek2 název: <input type='text' id='req2' name='req2' />
Požadavek2 hodnota: <input type='text' id='req2v' name='req2v' />
OR
Požadavek2 název: <input type='text' id='altreq2' name='altreq2' />
Požadavek2 hodnota: <input type='text' id='altreq2v' name='altreq2v' />
<br />
Požadavek3 název: <input type='text' id='req3' name='req3' />
Požadavek3 hodnota: <input type='text' id='req3v' name='req3v' />
OR
Požadavek3 název: <input type='text' id='altreq3' name='altreq3' />
Požadavek3 hodnota: <input type='text' id='altreq3v' name='altreq3v' />
<br />
Požadavek4 název: <input type='text' id='req4' name='req4' />
Požadavek4 hodnota: <input type='text' id='req4v' name='req4v' />
OR
Požadavek4 název: <input type='text' id='altreq4' name='altreq4' />
Požadavek4 hodnota: <input type='text' id='altreq4v' name='altreq4v' />
<br />
<input type="submit" value="Submit" />
</form>


<?php
require ("./inc/init.php");


if(Tools::get('name')){
	$name= Tools::get('name');
	$dname= Tools::get('dname');
	if(Tools::get('attr')){
		array_push($attributeArray, Tools::get('attr'));
		$attributeArray = array();
		if(Tools::get('alterattr'))array_push($attributeArray, Tools::get('altattr'));
	}
	$type= Tools::get('type');
	$description=array(
	 'lvl1' => Tools::get('d1'),
	 'lvl2' => Tools::get('d2'),
	 'lvl3' => Tools::get('d3')
	);
	$req = array(array(), array());
	if(Tools::get('req1'))$req[0][Tools::get('req1')]=Tools::get('req1v');
	if(Tools::get('altreq1'))$req[0][Tools::get('altreq1')]=Tools::get('altreq1v');
	if(Tools::get('altaltreq1'))$req[0][Tools::get('altaltreq1')]=Tools::get('altaltreq1v');
	if(Tools::get('req2'))$req[1][Tools::get('req2')]=Tools::get('req2v');
	if(Tools::get('altreq2'))$req[1][Tools::get('altreq2')]=Tools::get('altreq2v');
	if(Tools::get('req3'))$req[2][Tools::get('req3')]=Tools::get('req3v');
	if(Tools::get('altreq3'))$req[3][Tools::get('altreq3')]=Tools::get('altreq3v');
	if(Tools::get('req4'))$req[4][Tools::get('req4')]=Tools::get('req4v');
	if(Tools::get('altreq4'))$req[4][Tools::get('altreq4')]=Tools::get('altreq4v');

	Ability::addAbility($name, $type, $description, $req, $dname, $attributeArray);
	echo('success');

}

/*


$name = "Sandal";
$type = "passive";
$description = array(
'lvl1' => "SANDAL",
'lvl2' => "SANDAL level2",
'lvl3' => "SANDAL level3"
);

$req = array(
'strength' => "2"
);
Ability::addAbility($name, $type, $description, $req);
echo "Succesful";

*/
?>
