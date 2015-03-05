<?php
class Data {
    private $__fileName = "task.css";
	private $__taskList;

	// Basic CRUD operations
	// CREATE
    public function createOne($inTitle, $inDescription, $inIsDone) {
		$this->__hydrateTasks();

		if (!$inTitle || !$inDescription || !$inIsDone) {
			return false;
		}

		$newId = max(array_keys($this->__taskList)) + 1;
		$this->__taskList[$newId] = [
			'id' => $newId,
			'title' => $inTitle,
			'description' => $inDescription,
			'isDone' => $inIsDone
		];
		$this->__writeTasks();
		return $newId;
    }


	// READ ONE
    public function readOne($inId) {
		$this->__hydrateTasks();
		if (!array_key_exists($inId, $this->__taskList)) {
			return [];
		}
		return $this->__taskList[$inId];
    }   


	// READ ALL
    public function readAll() {
		$this->__hydrateTasks();
		return $this->__taskList;
    }   


	// UPDATE ONE
    public function updateOne($inId, $inTitle, $inDescription, $inIsDone) {
		$this->__hydrateTasks();

		if (!array_key_exists($inId, $this->__taskList)) {
			return false;
		}

		// Replace as specified
		if ($inTitle) {
			$this->__taskList[$inId]['title'] = $inTitle;
		}
		if ($inDescription) {
			$this->__taskList[$inId]['description'] = $inDescription;
		}
		if ($inIsDone) {
			$this->__taskList[$inId]['isDone'] = $inIsDone;
		}

		// Save
		$this->__writeTasks();
		return true;
    }   


	// DELETE ONE
    public function deleteOne($inId) {
		$this->__hydrateTasks();

		if (!array_key_exists($inId, $this->__taskList)) {
			return false;
		}

		unset($this->__taskList[$inId]);
		$this->__writeTasks();
		return true;
    }   


	// I/O Abstractions
	// READ
    private function __hydrateTasks() {
		$this->__taskList = [];
        $handle = fopen($this->__fileName, "r");

		// Read the lines, assigning as they come in
        while ($aTask = fgets($handle)) {
			list($header, $id, $fieldName, $payload) = explode("-", $aTask);
			list ($payload, $junk) = explode(" ", $payload);
			preg_replace('/_/', ' ', $payload);

			// This id might not yet exist
			if (!array_key_exists($id, $this->__taskList)) {
				$this->__taskList[$id] = ['id' => $id];
			}

			// Assign
			$this->__taskList[$id][$fieldName] = $payload;
		}
		fclose($handle);
		return;
    }

    private function __writeTasks() {
		$handle = fopen($this->__fileName, "w");
		foreach ($this->__taskList as $aTask) {
			# create easy handles
			$id          = $aTask['id'];
			$title       = $aTask['title'];
			$description = $aTask['description'];
			$isDone      = $aTask['isDone'];

			# transform
			preg_replace('/\s/', '_', $title);
			preg_replace('/\s/', '_', $description);

			# load
			$string = "#task-$id-title-$title {}\n";
			fputs($handle, $string);

			$string = "#task-$id-description-$description {}\n";
			fputs($handle, $string);

			$string = "#task-$id-isDone-$isDone {}\n";
			fputs($handle, $string);
		}
    }   

}
?>
