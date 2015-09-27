<?php
$dbhost="localhost";
$dbname="ecolearning_sumaton";
$dbuser="sumaton";
$dbpass="3quipo3mpowerL4bs";
$db = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

if (isset($_POST) && count($_POST)>0)
{
	if ($db->connect_errno) 
	{
		die ("<span class='ko'>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</span>");
	}
	else
	{
		$query=$db->query("update activities set ".$_POST["campo"]."='".$_POST["valor"]."' where ID_Logs='".intval($_POST["id"])."' limit 1");
		if ($query) {echo "<span class='ok'>Valores modificados correctamente.</span>";}
		else {echo "<span class='ko'>".$db->error."</span>";}
	}
}
if (isset($_GET) && count($_GET)>0)
{
	if ($db->connect_errno) 
	{
		die ("<span class='ko'>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</span>");
	}
	else
	{
		$query=$db->query("select * from activities order by Week ASC ,Day ASC, startime ASC");//SELECT * FROM activities WHERE '$Programa' = Program ORDER BY Week ASC ,Day ASC, startime ASC
		$datos=array();
		while ($usuarios=$query->fetch_array())
		{
			$datos[]=array(	'id'=>utf8_encode($resultados['ID_Activities']),
				'Name'=>utf8_encode($resultados['Name']),
				'Program'=>utf8_encode($resultados['Program']),
				'Coach'=>utf8_encode($resultados['Coach']),
				'Description'=>utf8_encode($resultados['Description']),
				'Type'=>utf8_encode($resultados['Type']),
				'Goals'=>utf8_encode($resultados['Goals']),
				'Day'=>utf8_encode($resultados['Day']),
				'Time'=>utf8_encode($resultados['startime']),
				'endTime'=>utf8_encode($resultados['endtime']),
				'Week'=>utf8_encode($resultados['Week'])
			);
		}
		echo json_encode($datos);
	}
}

?>