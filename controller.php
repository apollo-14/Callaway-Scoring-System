<html>
  <head>
    <title>Submitting Score</title>
    <META http-equiv="refresh" content="10;URL=http://localhost/TheCrannyOpen/dev/index.php">
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

<?php 

if (isset ($_REQUEST['save'])) { 
	
  	if (isset ($_GET['newRound'])) {

		echo "<p>Ready for Insert</p>";
		echo "<p>".$_GET["playerName"]." : Final score of "
				  .$_GET["netScore"]." : (" 
				  .$_GET["grossScore"]." - "
				  .$_GET["handicap"] . ")</p>";

		try 
	    {
	        $db = new PDO("mysql:host=localhost; dbname=canaan", 'root', 'root'); 
	        if ($db->connect_error) { die("Connection failed: " . $db->connect_error); } 

	        $pn = $_GET['playerName'];

	        $q = $db->exec("INSERT INTO tmp (id,
	                                    	 player_name,
	                                    	 gross_score,
	                                    	 handicap,
	                                    	 final_score,
	                                    	 round_date,
	                                    	 tournament_id)
			                        VALUES  ('',  
			                                 '".$_GET["playerName"]."', 
			                                 '".$_GET["grossScore"]."',
			                                 '".$_GET["handicap"]."',
			                                 '".$_GET["netScore"]."',
			                                 '".date('Y/m/d:h:m:s')."',
			                                 '' );");
	        
	        $db = NULL;

	        echo "<p>Inserted :" . $q . ": rows.</p>";
	    }   

	    catch (PDOException $e) 
	    {    
	        echo "Error!: " . $e->getMessage() . "<br/>";
	        die();
	    }

	} else {
		echo "<p>Leaderboard</p>";
	}

} else { echo "<p>NO SUBMIT</p>"; }

try 
{
    $db = new PDO("mysql:host=localhost; dbname=canaan", 'root', 'root');

    $rounds = $db->query('SELECT * FROM tmp order by final_score asc, gross_score asc, handicap asc;');

    $db = NULL;  

    echo "<table class=\"table table-striped\"><tr>";

    echo 
         "<th>#</th>" .
         "<th>player name</th>" .
         "<th>score</th>" .
         "<th>gross</th>" .
         "<th>handicap</th>" .
         "<th>entry date</th>";

    echo "</tr><tr>";

    $pos = 1;

    while ($rows = $rounds->fetch())
    {   
        echo "<td>"  . $pos . "</td>" .
             "<td>"  . $rows['player_name'] . "</td>" .
             "<td>"  . $rows['final_score'] . "</td>" .
             "<td>"  . $rows['gross_score'] . "</td>" .
             "<td>"  . $rows['handicap']    . "</td>" .
             "<td>"  . $rows['round_date']  . "</td></tr>";
        $pos = $pos + 1;
    };
        
    echo "</tr></table>";    
} catch (PDOException $e) {    
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>

</div>

<div class="col-xs-2">
</div>
</center>

  </body>
</html>

