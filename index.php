<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<script>
	// Gets all the tasks, then makes a list of links
	var makeTaskList = function() {
		$.getJSON("readAll.php", function(data) {
			var doneItems = [];
			var liveItems = [];
			$.each(data, function(key, val) {
				if (val.isDone == 'true') {
					doneItems.push("<li class='done' id='" + val.id + "'>");
					doneItems.push("<a href='#' onclick='deleteTask(" + val.id + ")'>(delete)</a> ");
					doneItems.push( val.title + "</li>");
				} else {
					liveItems.push("<li class='live' id='" + val.id + "'>");
					liveItems.push("<a href='#' onclick='editTaskForm(" + val.id + ")'>(update)</a> ");
					liveItems.push( val.title + "</li>");
				}
			});

			$("body").append("<h2>Finished tasks</h2>");
			$("<ul/>", {
				html: doneItems.join("")
			}).appendTo("body");
			$("body").append("<hr><h2>Outstanding tasks</h2>");
			$("<ul/>", {
				html: liveItems.join("")
			}).appendTo("body");
			$("body").append("<hr><h2><a href='#' onclick='createTaskForm()'>Create Task</a></h2>");
		});
	};

	// deletes the task associated with the passed id
	var deleteTask = function(id) {
		$.getJSON("deleteOne.php?id=" + id, function(data) {
			$("body").empty();
			makeTaskList();
		});
	};

	// gets a single task, and creates a form for it
	// I'm reading all because I can't make the optional json query strong thing work
	var editTaskForm = function(id) {
		$.getJSON("readAll.php", function(data) {
		$("body").empty();
		$("body").append("<h2>Edit Task</h2>");
			$form = $("<form id='task'></form>");
			$.each(data, function(key, val) {
				if (val.id == id) {
					$form.append("<input type='hidden' name='id' value='" + val.id + "' />");
					$form.append("Title<br>");
					$form.append("<input name='title' value='" + val.title + "' /><br><br>");
					$form.append("Description<br>");
					$form.append("<textarea rows=5 cols=40 name='description'>" + val.description + "</textarea><br><br>");
					$form.append("Is Done<br>");
					$form.append("<input name='isDone' value='" + val.isDone + "' /><br><br>");
					$form.append("<input type='button' onclick='updateTask()' name='bob' value='Update' />");
				}
			});
			$("body").append($form);
		});
	};

	// Connects the update to the back end
	var updateTask = function() {
		console.dir($("form").serialize());
		var pList = {};
		$.each($("form").serializeArray(), function(key, value) {
			pList[value.name] = value.value;
		});
		//console.dir(pList);
		$.getJSON("updateOne.php?" + $("form").serialize(), function(data) {
			$("body").empty();
			makeTaskList();
		});
	}

	// creates an empty form for creation
	var createTaskForm = function() {
		$("body").empty();
		$("body").append("Create Task<div class='new_task_form'>");
		$form = $("<form id='task'></form>");
		$form.append("<input type='hidden' name='id'/>");
		$form.append("Title<br>");
		$form.append("<input name='title'/><br><br>");
		$form.append("Description<br>");
		$form.append("<textarea rows=5 cols=40 name='description'></textarea><br><br>");
		$form.append("Is Done<br>");
		$form.append("<input name='isDone'/><br><br>");
		$form.append("<input type='button' onclick='createTask()' name='bob' value='Create' />");
		$("body").append($form);
		$("body").append("</div>");
	};

	var createTask = function() {
		console.dir($("form").serialize());
		var pList = {};
		$.each($("form").serializeArray(), function(key, value) {
			pList[value.name] = value.value;
		});
		console.dir(pList);
		$.getJSON("createOne.php?" + $("form").serialize(), function(data) {
			$("body").empty();
			makeTaskList();
		});
	}


	// Runs when the page is all loaded
	$(document).ready(function() {
		makeTaskList();
	});

	</script>

</body>
