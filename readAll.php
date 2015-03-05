<?PHP
	require('Data.php');

	$data = new Data();
	if (!$rows = $data->readAll($_GET['id'])) {
		echo "[]";
		return;
	}

	echo json_encode(array_values($rows));
	return;

?>
