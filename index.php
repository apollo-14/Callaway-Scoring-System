<html>
<head>
<title>The Cranny Open</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
</head> <!-- end head-->

<body onload="clear()">
<!-- include jquery and bootstrap -->
<script src="bootstrap/js/jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="callawaySystem.js"></script>






<!-- Page Header -->
<div class="header"> 
<div class="container">
<h1>The Cranny Open 2014 <small>43<sup>rd</sup> year</small></h1>
</div>
</div> 
<!-- End Page-Header -->


<!--<?php
    
    /*$username = root;
    $password = root;
    
    try {
    // Create database connection using PHP Data Object (PDO)
    $db = new PDO("mysql:host=localhost; dbname=db01", $username, $password);
    // Identify name of table within database
    $playersTable = 't_country_names2';
    // Create the query - here we grab everything from the table
    $players = $db->query('SELECT * FROM ' . $playersTable . ';');
    // Close connection to database
    $db = NULL;

    while ($rows = $players->fetch())
            {echo "<p>"  . $rows['r_english_name'] . "</p>";
        };
    }

    catch (PDOException $e) {    print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }*/
?>-->


<!-- Tabs -->
<div class="container tabs">
<ul class="nav nav-tabs" role="tablist">
<li class="active"><a href="#calculators" role="tab" data-toggle="tab">Calculator</a></li>
<li><a href="#leaderboard" role="tab" data-toggle="tab">Leaderboards</a></li>
<li><a href="#callawaySystemRules" role="tab" data-toggle="tab">Callaway System Rules</a></li>
</ul>
</div>
<!-- End Tabs -->



<!-- Tab Content -->
<div class="tab-content">

    <!-- Calculators Tab -->
    <div class="tab-pane active" id="calculators">
        <form action="controller.php" method="get" id="values">

        <!-- Score Calculator -->
        <div class="row"> 
        <div class="col-xs-12">
        <div class="scoreCalculator">
        <div class="container">
        <table>
        <tr>
        <td>
            <label id="tourneyName">Tournament:   </label>
<?php try {
    $db = new PDO("mysql:host=localhost; dbname=canaan", 'root', 'root'); 
    $tourneys = $db->query('SELECT * FROM tournaments');
    $db = NULL;

        echo "<select>";
        while ($options = $tourneys->fetch())
        {   
            echo "<option value='".$options['name']."'>".$options['name']."</option>";
        };  
        echo "</select>";
}   catch (PDOException $e) {    
        print "Error!: " . $e->getMessage();
        die();
}?>  
        </td>
        <td></td>
        <td></td>
        </tr>

        <tr class="tableHeader">
        <td><label id="playerHeader">Player name</label></td>
        <td><label id="grossHeader">Gross Score</label></td>
        <td rowspan="2">
            <table class="worstHoles">
            <tr>
            <td><label id="worstLabel">Worst Hole</label></td>
            <td><label id="secondLabel">2<sup>nd</sup> Worst</label></td>
            <td><label id="thirdLabel">3<sup>rd</sup> Worst</label></td>
            <td><label id="fourthLabel">4<sup>th</sup> Worst</label></td>
            <td><label id="fifthLabel">5<sup>th</sup> Worst</label></td>
            <td><label id="sixthLabel">6<sup>th</sup> Worst</label></td>
            </tr>
            <tr>
            <td><input type="text" id="theWorst" class="calculator"></td>
            <td><input type="text" id="secondWorst" class="calculator"></td>
            <td><input type="text" id="thirdWorst" class="calculator"></td>
            <td><input type="text" id="fourthWorst" class="calculator"></td>
            <td><input type="text" id="fifthWorst" class="calculator"></td>
            <td><input type="text" id="sixthWorst" class="calculator"></td>
            </tr>
            </table>
        </td>
        </tr>
        
        <tr>
        <td><input type="text" id="playerName" name="playerName" class="playerAttribute"></td>
        <td><input type="text" id="grossScore" name="grossScore" onchange="grossChanged()" class="calculator"></td>
        <td></td>
        </tr>
        
        <tr>
        <td>Save New ?  : <input type="checkbox" id="newRound" name="newRound" /></td>
        <td><input type="button" id="calculate" value="Calculate Score" onclick="calculateScore(true)"></td>
        <td><input type="submit" action="submit" id="save" name="save" value="Save Round"></td>
        </tr>
        
        </table>
        </div>
        </div>
        </div>
        </div> 
        <!-- End Score Calculator -->

        <!-- Score Display -->
        <div class="row"> 
        <div class="col-xs-12">
        <div class="scoreDisplay">
        <div class="container">
        <table>
        <tr>
        <td class="display"><label>Gross</label></td>
        <td class="display"></td>
        <td class="display"><label>Handicap</label></td>
        <td class="display"></td>
        <td class="display"><label>Net</label></td>
        </tr>
        <tr>
        <td><input type="text" class="displayNum" id="grossDisplay"></td>
        <td class="display"><label>-</label></td>
        <td><input type="text" class="displayNum" id="hcapDisplay" name="handicap"></td>
        <td class="display"><label>=</label></td>
        <td><input type="text" class="displayNum" id="netDisplay" name="netScore"></td>
        </tr>
        </table>
        <p></p>
        </div>
        </div>
        </div>
        </div> 


        </form>
        <!-- End Score Display -->
    </div> 
    <!-- End Calculators Tab -->



    <!-- Leaderboard -->
    <div class="tab-pane rules" id="leaderboard">
        <div class="container">
        <div class="row">
            <div class="col-xs-2"></div>
            
            <div class="col-xs-8">

<?php try {
    
        $db = new PDO("mysql:host=localhost; dbname=canaan", 'root', 'root'); 
        $rounds = $db->query('SELECT x.player_name player_name,
                                     x.final_score final_score,
                                     x.gross_score gross_score,
                                     x.handicap handicap,
                                     t.name 
                                FROM tmp x, tournaments t
                                WHERE x.tournament_id = t.tournament_id
                                order by final_score asc, 
                                         gross_score asc,
                                         handicap asc;');
        $db = NULL;

        echo "<label>".$trnys['name']."</label>\n";
        echo "<table class=\"table table-striped\">\n<tr>\n";
        echo     "<th>#</th>".
                 "<th>Player Name</th>".
                 "<th>Final Score</th>".
                 "<th>Gross</th>".
                 "<th>Handicap</th>".
                 "<th>Tournament<th>";
        echo "</tr><tr>";

        $pos = 1;
        while ($rows = $rounds->fetch())
        {   
            echo "<td>".$pos."</td>".
                 "<td>".$rows['player_name']."</td>".
                 "<td>".$rows['final_score']."</td>".
                 "<td>".$rows['gross_score']."</td>".
                 "<td>".$rows['handicap']."</td>".
                 "<td>".$rows['name']."</td></tr>";
            $pos = $pos + 1;
        };  
        echo "</tr></table>";    

} 
catch (PDOException $e) {    
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}?>

        
                </div>
            <div class="col-xs-2"> </div>
        </div>
        </div>
    </div>
    <!-- End - Leaderboard -->



    <!-- Callaway System Rules Tab -->
    <div class="tab-pane rules" id="callawaySystemRules">
        <div class="container">
        <div class="row">
        <div class="col-xs-4">
        <div class="callawayChart">
        <div class="container">
        <table>
        <tr>
        <td colspan="5" class="black">Gross Score</td>
        <td colspan="3" class="black">Handicap</td>
        </tr>
        <tr>
        <td class="blue" colspan="5">72 or less</td>
        <td class="red" colspan="3">No Handicap</td>
        </tr>
        <tr>
        <td class="blue">73</td>
        <td class="blue">74</td>
        <td class="blue">75</td>
        <td class="blue">-</td>
        <td class="blue">-</td>
        <td class="red" colspan="3">1/2 worst hole</td>
        </tr>
        <tr>
        <td class="blue">76</td>
        <td class="blue">77</td>
        <td class="blue">78</td>
        <td class="blue">79</td>
        <td class="blue">80</td>
        <td class="red" colspan="3">1 worst hole</td>
        </tr>
        <tr>
        <td class="blue">81</td>
        <td class="blue">82</td>
        <td class="blue">83</td>
        <td class="blue">84</td>
        <td class="blue">85</td>
        <td class="red" colspan="3">1 1/2 worst holes</td>
        </tr>
        <tr>
        <td class="blue">86</td>
        <td class="blue">87</td>
        <td class="blue">88</td>
        <td class="blue">89</td>
        <td class="blue">90</td>
        <td class="red" colspan="3">2 worst holes</td>
        </tr>
        <tr>
        <td class="blue">91</td>
        <td class="blue">92</td>
        <td class="blue">93</td>
        <td class="blue">94</td>
        <td class="blue">95</td>
        <td class="red" colspan="3">2 1/2 worst holes</td>
        </tr>
        <tr>
        <td class="blue">96</td>
        <td class="blue">97</td>
        <td class="blue">98</td>
        <td class="blue">99</td>
        <td class="blue">100</td>
        <td class="red" colspan="3">3 worst holes</td>
        </tr>
        <tr>
        <td class="blue">101</td>
        <td class="blue">102</td>
        <td class="blue">103</td>
        <td class="blue">104</td>
        <td class="blue">105</td>
        <td class="red" colspan="3">3 1/2 worst holes</td>
        </tr>
        <tr>
        <td class="blue">106</td>
        <td class="blue">107</td>
        <td class="blue">108</td>
        <td class="blue">109</td>
        <td class="blue">110</td>
        <td class="red" colspan="3">4 worst holes</td>
        </tr>
        <tr>
        <td class="blue">111</td>
        <td class="blue">112</td>
        <td class="blue">113</td>
        <td class="blue">114</td>
        <td class="blue">115</td>
        <td class="red" colspan="3">4 1/2 worst holes</td>
        </tr>
        <tr>
        <td class="blue">116</td>
        <td class="blue">117</td>
        <td class="blue">118</td>
        <td class="blue">119</td>
        <td class="blue">120</td>
        <td class="red" colspan="3">5 worst holes</td>
        </tr>
        <tr>
        <td class="blue">121</td>
        <td class="blue">122</td>
        <td class="blue">123</td>
        <td class="blue">124</td>
        <td class="blue">125</td>
        <td class="red" colspan="3">5 1/2 worst holes</td>
        </tr>
        <tr>
        <td class="blue">126</td>
        <td class="blue">127</td>
        <td class="blue">128</td>
        <td class="blue">129</td>
        <td class="blue">130</td>
        <td class="red" colspan="3">6 worst holes</td>
        </tr>
        <tr>
        <td class="black">-2</td>
        <td class="black">-1</td>
        <td class="black">0</td>
        <td class="black">+1</td>
        <td class="black">+2</td>
        <td colspan="3" class="black">H'CAP Adjustment</td>
        </tr>
        </table>
        </div>
        </div>
        </div>
        <div class="col-xs-4">
        <h3>What is it</h3>
        <p>Callaway is a popular scoring system used for one-time events where a number of competitors   don't have an established handicap. 
        Without having established handicaps from all competitors, how can an organizer score a tournament fairly?</p>
        <h5>The Callaway Method has these steps:</h5>
        <ol>
        <li>Calculate "Adjusted Gross" by applying Double-Par stroke control to all holes
        Cross off the 9<sup>th</sup> and 18<sup>th</sup> holes.</li>
        <li>Apply "Adjusted Gross" to the table to determine the Callaway Handicap entitlement (purple column)</li>
        <li>Identify the worst hole(s) on the score card to determine the Callaway Handicap</li>
        <li>Adjust the Callaway Handicap according to the bottom row of the chart</li>
        <li>Apply the adjusted Callaway Handicap to the "Gross" Score to obtain "Net"</li>
        </ol>
        <h6>Here are some additional rules</h6>
        <ol>
        <li>Half-Stroke Entitlements are rounded up</li>
        <li>Half-Hole Entitlement is applied to the smallest of the worst holes</li>
        <li>9th and 18th holes cannot be deducted</li>
        <li>Tie for lowest net is won by player with lowest Gross</li>
        </ol>
        </div>
        <div class="col-xs-4">
        <h3>Examples:</h3>
        <p>Howard shoots <b>74</b>.<br/>
        According to the chart, his handicap will be 1/2 of his worst hole. If his worst hole was <b> 5</b> (excluding the 9<sup>th</sup> and 18<sup>th</sup> hole), his handicap will be <b>3</b>.<br/>
        Now look at the chart. The handicap adjustment is <b>-1</b>. His handicap changes: <b>3 - 1 = 2</b>.<br/>
        Take the adjusted handicap off of his worst hole and Howard's net score is <b>74 - 2 = 72</b></p>
        <p>Cletus shoots <b>90</b>.<br/>
        According to the chart, his handicap will be his 2 worst holes. If his worst hole was <b> 9</b> and his second worst hole was <b>8</b> (excluding the 9<sup>th</sup> and 18<sup>th</sup> hole), his handicap will be <b>17</b>.<br/>
        Now look at the chart. The handicap adjustment is <b>+2</b>. His handicap changes: <b>17 + 2 = 19</b>.<br/>
        Take the adjusted handicap off of his worst hole and Howard's net score is <b>90 - 19 = 71</b></p>
        </div>
        </div>
        </div>
    </div>
    <!-- End Callaway System Rules Tab -->



</div>
<!-- End Tab Content -->







<!-- Footer -->
<div class="footer">
<div class="row">
<div class="col-xs-12">
<div class="panel panel-default">
<h3>Thanks everyone for another great year.</h3>
<h4>Special thanks to: Randy Richards, Craig Richards, Ray Swartz</h4>
</div>
</div>
</div>
</div> 
<!-- End Footer -->



</body> 
<!-- end body-->
</html> <!-- end html-->