<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>

<body>
	<script>
	// Gets all the tasks, then makes a list of links
	var makeTaskList = function() {
		$.getJSON("readAll.php", function(data) {
			//alert(JSON.stringify(data));
			var items = [];
			$.each(data, function(key, val) {
				items.push("<li id='" + key + "'>" + "<a href='#' onclick='editTask(" + key + ")'>" + val.title + "</a></li>");
			});

			$("<ul/>", {
				"class": "tasklist",
				html: items.join("")
			}).appendTo("body");
		});
	};

	// gets a single task, and creates a form for it
	// I'm reading all because I can't make the optional json query strong thing work
	var makeTaskForm = function(id) {
		$.getJSON("readAll.php", function(data) {
			$form = $("<form id='task'></form>");
			$.each(data, function(key, val) {
				if (key == id) {
					$form.append("<input type='hidden' name='id' value='" + val.id + "' />");
					$form.append("Title<br>");
					$form.append("<input name='title' value='" + val.title + "' /><br><br>");
					$form.append("Description<br>");
					$form.append("<input name='description' value='" + val.description + "' /><br><br>");
					$form.append("Is Done<br>");
					$form.append("<input name='isDone' value='" + val.isDone + "' /><br><br>");
					$form.append("<input type='button' onclick='updateTask()' name='bob' value='Update' />");
				}
			});
			$('body').append($form);
		});
	};

	var updateTask = function() {
		alert(JSON.stringify(data));
		$.getJSON("updateOne.php", JSON.stringify($("form").serializeArray()), function(data) {
		});
		$("body").empty();
		makeTaskList();
	}


	var editTask = function(id) {
		$("body").empty();
		makeTaskForm(id);
	};

	// Runs when the page is all loaded
	$(document).ready(function() {
		makeTaskList();
	});

	</script>

</body>
