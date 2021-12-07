<?php

//data.php

$connect = new PDO("mysql:host=localhost;dbname=testing", "root", "");

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'model')
	{
		$query = "
		SELECT make, COUNT(id) AS Total 
		FROM mytable
		GROUP BY make
		";

		$result = $connect->query($query);

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

		$result = $connect->query($query);

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

		$result = $connect->query($query);

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