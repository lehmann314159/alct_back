<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>

<body>
	<script>
	$(document).ready(function() {
		$.getJSON("readAll.php", function(data) {
			var items = [];
			$.each(data, function(key, val) {
				console.log(key);
				console.log(val);
				items.push("<li id='" + key + "'>" + val.title + "</li>");
			});
	
			$("<ul/>", {
				"class": "my-new-list",
				html: items.join("")
			}).appendTo("body");
		});
	});
	</script>

<div id="task_list">
	<h1>Tasks</h1>
    <ul class="tasks">
    </ul>
</div>
</body>
