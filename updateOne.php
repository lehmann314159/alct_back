<?PHP
	require('Data.php');
	$data = new Data();

	// We need at least an id
	if (!array_key_exists('id', $_GET)) {
		echo "{'result': 'failure'}";
		return;
	}

	// Better safe than sorry
	$id          = array_key_exists('id', $_GET)          ? $_GET['id']          : null;
	$title       = array_key_exists('title', $_GET)       ? $_GET['title']       : null;
	$description = array_key_exists('description', $_GET) ? $_GET['description'] : null;
	$isDone      = array_key_exists('isDone', $_GET)      ? $_GET['isDone']      : null;

	if (!$data->updateOne($id, $title, $description, $isDone)) {
		echo "{'result': 'failure'}";
		return;
	}

	echo "{'result': 'success'}";
	return;

?>
