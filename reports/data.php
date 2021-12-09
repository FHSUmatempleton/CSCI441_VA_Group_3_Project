<?php

//data.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

global $db;

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'model')
	{
		$query = "
		SELECT make, COUNT(id) AS Total 
		FROM mytable
		GROUP BY make
		";

		$result = $db->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'items'		=>	$row["make"],
				'total'			=>	$row["Total"],
				'color'			=>	'#000000'
			);
		}

		echo json_encode($data);
	}
	if($_POST["action"] == 'color')
	{
		$query = "
		SELECT color, COUNT(id) AS Total 
		FROM mytable
		GROUP BY color
		";

		$result = $db->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'items'		=>	$row["color"],
				'total'			=>	$row["Total"],
				'color'			=>	'#000000'
			);
		}

		echo json_encode($data);
	}
	if($_POST["action"] == 'body')
	{
		$query = "
		SELECT body, COUNT(id) AS Total 
		FROM mytable
		GROUP BY body
		";

		$result = $db->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'items'		=>	$row["body"],
				'total'			=>	$row["Total"],
				'color'			=>	'#000000'
			);
		}

		echo json_encode($data);
	}
}


?>