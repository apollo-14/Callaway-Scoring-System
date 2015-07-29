<html>
  <head>
    <title>New Tournament Setup</title>
    <META http-equiv="refresh" content="URL=http://localhost/TheCrannyOpen/dev/index.php">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">
</head> <!-- end head-->

<body bgcolor="#ffffff">
<!-- include jquery and bootstrap -->
<script src="bootstrap/js/jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="callawaySystem.js"></script>
  	
<center>
<div class="col-xs-2">
</div>

<div class="col-xs-8">

<!-- form for new tournament -->

<p>Enter info for new Tournament</p>
<form action="controller.php" method="get" id="values">
<table class="table">
<tr>
<th>Tournament Name</th>
<th>Start Date</th>
<th>End Date</th>
<th>attr1</th>
<th>attr2</th>
<th></th>
</tr>

<tr>
<td><input type="text" name="new_t_name" id="new_t_name" placeholder="(Name)" ></td>
<td><input type="date" name="new_t_start_date" id="new_t_start_date" placeholder="Start date" ></td>
<td></td>
<td></td>
<td></td>
<td>
	<button type="submit" name="create_new_tournament" id="submit">
		<span class="glyphicon glyphicon-floppy-save" aria-hidden="false"></span>
	</button>
</td>

</form>
</div>

<div class="col-xs-2">
</div>
</center>

  </body>
</html>

