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
<script src="new_tournament.js"></script>

<div class="col-xs-2"></div>

<div class="col-xs-8">

<div class="panel panel-default">

<div class="panel-heading">

	<h2>Create a new Tournament</h2>
	<a href="index.php"><span class="glyphicon glyphicon-remove" aria-hidden="false"></span></a>
	
</div>

<form action="controller.php" method="post" id="values">

<table class="table">
	<tr>
		<th></th>
		<th>Tournament Name</th>
		<th>Start Date</th>
		<th>Number Of Rounds</th>
	</tr>

	<tr>
		<td><center>
			<button type="submit" name="create_new_tournament" id="submit">
				<span class="glyphicon glyphicon-floppy-save" aria-hidden="false"></span>
			</button></center>
		</td>
		<td>
			<input type="text" name="t_name" id="t_name" placeholder="(name)" >
		</td>
		<td>
			<input type="date" name="t_start_date" id="t_start_date" placeholder="Start date" >
		</td>
		<td>
			<select name="t_num_rounds" id="t_num_rounds" placeholder="-">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
			</select>
		</td>
	</tr>
</table>

</form>

</div>

</div>

<div class="col-xs-2"></div>

</body>

</html>

