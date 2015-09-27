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
		$query=$db->query("update logs set ".$_POST["campo"]."='".$_POST["valor"]."' where ID_Logs='".intval($_POST["id"])."' limit 1");
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
		$query=$db->query("select * from logs order by 'Date' asc");

		$datos=array();
		while ($usuarios=$query->fetch_array())
		{
			$datos[]=array(	'id'=>utf8_encode($resultados['ID_Logs']),
			'programs'=>utf8_encode($resultados['Programs']),
			'activities'=>utf8_encode($resultados['Activities']),
			'usuario'=>utf8_encode($resultados['usuario']),
			'stage'=>utf8_encode($resultados['Stage']),
			'Status'=>utf8_encode($resultados['Status']),
			'Comments'=>utf8_encode($resultados['Comments']),
			'Goals'=>utf8_encode($resultados['Goals']),
			'date'=>utf8_encode($resultados['Date']),
			'StartTime'=>utf8_encode($resultados['StartTime']),
			'Week'=>utf8_encode($resultados['Week']),
			'Day'=>utf8_encode($resultados['Day'])
				 
			);

		}
		echo json_encode($datos);
	}
}


?>