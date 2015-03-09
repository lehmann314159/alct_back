<?PHP
	require('Data.php');
	$data = new Data();

	// We need an id
	if (!array_key_exists('id', $_GET)) {
		echo json_encode(['result' => 'failure']);
		return;
	}

	if (!$data->deleteOne($_GET['id'])) {
		echo json_encode(['result' => 'failure']);
		return;
	}

	echo json_encode(['result' => 'success']);
	return;

?>
