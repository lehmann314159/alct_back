<?PHP
	require('Data.php');
	$data = new Data();

	if (!array_key_exists('id', $_GET)) {
		echo "{}";
		return;
	}

	if (!$row = $data->readOne($_GET['id'])) {
		echo "{}";
		return;
	}

	echo json_encode($row) . "<br>\n";
	return;

?>
