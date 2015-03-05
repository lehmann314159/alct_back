<?PHP
	require('Data.php');
	$data = new Data();

	// We need an id
	if (!array_key_exists('id', $_GET)) {
		echo "{'result': 'failure'}";
		return;
	}

	if (!$data->deleteOne($_GET['id'])) {
		echo "{'result': 'failure'}";
		return;
	}

	echo "{'result': 'success'}";
	return;

?>
