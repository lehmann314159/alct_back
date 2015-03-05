<?PHP
	require('Data.php');
	$data = new Data();

	// We need every field except id
	if (!array_key_exists('title', $_GET))       { echo "{'result': 'failure'}"; return; }
	if (!array_key_exists('description', $_GET)) { echo "{'result': 'failure'}"; return; }
	if (!array_key_exists('isDone', $_GET))      { echo "{'result': 'failure'}"; return; }

	$title       = $_GET['title'];
	$description = $_GET['description'];
	$isDone      = $_GET['isDone'];
	if (!$newId = $data->createOne($title, $description, $isDone)) {
		echo "{'result': 'failure'}";
		return;
	}

	echo "{'id': $newId} ";
	return;

?>
