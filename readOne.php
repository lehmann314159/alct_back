<?PHP
	require('Data.php');
	$data = new Data();

	if (!array_key_exists('id', $_GET)) {
		echo json_encode([]);
		return;
	}

	if (!$row = $data->readOne($_GET['id'])) {
		echo json_encode([]);
		return;
	}

	echo json_encode($row);
	return;

?>
