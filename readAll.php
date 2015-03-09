<?PHP
	require('Data.php');

	$data = new Data();
	if (!$rows = $data->readAll()) {
		echo json_encode([]);
		return;
	}

	echo json_encode(array_values($rows));
	return;

?>
