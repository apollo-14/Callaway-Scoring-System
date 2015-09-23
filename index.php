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
<h1>The Cranny Open 2015 <small>43<sup>rd</sup> year</small></h1>
</div>
</div> 
<!-- End Page-Header -->

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
        <form action="controller.php" method="post">

        <!-- Score Calculator -->
        <div class="row"> 
        <div class="col-xs-12">
        <div class="scoreCalculator">
        <div class="container">
        <table>
        
        <tr class="tableHeader">
        <td><label id="playerHeader">Player name</label></td>
        <td><label id="grossHeader">Gross Score</label></td>
        <td rowspan="2">
            <table class="worstHoles">
            <tr>
            <td><label id="wl_1">Worst Hole</label></td>
            <td><label id="wl_2">2<sup>nd</sup> Worst</label></td>
            <td><label id="wl_3">3<sup>rd</sup> Worst</label></td>
            <td><label id="wl_4">4<sup>th</sup> Worst</label></td>
            <td><label id="wl_5">5<sup>th</sup> Worst</label></td>
            <td><label id="wl_6">6<sup>th</sup> Worst</label></td>
            </tr>
            <tr>
            <td><input type="text" id="wh_1" class="calculator"></td>
            <td><input type="text" id="wh_2" class="calculator"></td>
            <td><input type="text" id="wh_3" class="calculator"></td>
            <td><input type="text" id="wh_4" class="calculator"></td>
            <td><input type="text" id="wh_5" class="calculator"></td>
            <td><input type="text" id="wh_6" class="calculator"></td>
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
        <td><p>Save Mode : <input type="checkbox" id="admin_mode" name="admin_mode" /></p></td>
        <td><input type="button" id="calculate" value="Calculate Score" onclick="calculateScore(true)"></td>
        <td><input type="submit" action="submit" id="new_round" name="new_round" value="Save Round"></td>
        </tr>
        <tr>
        <td>Tournament : 
<?php 
try {
    
    $db = new PDO("mysql:host=localhost; dbname=canaan", 'root', 'root'); 
    $tourneys = $db->query('SELECT * FROM tournaments');
    $db = NULL;

    echo "<select id='tournament_select' name='tournament_select'>";
    
    while ($options = $tourneys->fetch()) {   
        
        echo "<option value='".$options['tournament_id']."'>".$options['name']."</option>";
    
    };  
    
    echo "</select>";
}   

catch (PDOException $e) { 
    print "Error!: " . $e->getMessage();
    die();

}
?>         

            <a href="new_tournament.php">
                <span class="glyphicon glyphicon-plus" aria-hidden="false"></span>
            </a>
        </td>
        <td>Round : 
            <select name="round_select">
                <option value="2">2</option>
            </select>
        </td>
        <td></td>
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

            <div class="col-xs-4">
            <h2>The 43rd Cranny Open</h2>
                <?php /*
                try 
                {   
                    $db = new PDO("mysql:host=localhost; dbname=canaan", 'root', 'root'); 
                    $players = $db->query('
                                            select distinct(player_name) from tmp
                                            where tournament_id = 4;
                                          ');
                    $db = NULL;
                    $pos = 1;

                    echo "<table class=\"table table-striped\">".
                         "<tr>".
                             "<th>#</th>".
                             "<th>Player</th>".
                             "<th>Gross</th>".
                             "<th>H-cap</th>".
                             "<th>Final</th>".
                         "</tr>";

                    while ($d1 = $day1->fetch()) {
                        
                        echo "<tr>".
                             "<td>".$pos."</td>".
                             "<td>".$d1['player_name']."</td>".
                             "<td>".$d1['gross_score']."</td>".
                             "<td>".$d1['handicap']."</td>".
                             "<td>".$d1['final_score']."</td>".
                             "</tr>";
                        
                        $pos = $pos + 1;  

                    };  

                    echo "</table>";  
                } 

                catch (PDOException $e) {    

                    print "Error!: " . $e->getMessage() . "<br/>";
                    die();

                } 
                */
                ?>
            </div>

            <div class="col-xs-4">
                <h2>Day 1</h2>
                <?php 
                try 
                {   
                    $db = new PDO("mysql:host=localhost; dbname=canaan", 'root', 'root'); 
                    $day1 = $db->query('SELECT * FROM tmp
                                                WHERE tournament_id = 4
                                                  AND round_id = 1
                                             ORDER BY final_score, gross_score;');
                    $db = NULL;
                    $pos = 1;

                    echo "<table class=\"table table-striped\">".
                         "<tr>".
                             "<th>#</th>".
                             "<th>Player</th>".
                             "<th>Gross</th>".
                             "<th>H-cap</th>".
                             "<th>Final</th>".
                         "</tr>";

                    while ($d1 = $day1->fetch()) {
                        
                        echo "<tr>".
                             "<td>".$pos."</td>".
                             "<td>".$d1['player_name']."</td>".
                             "<td>".$d1['gross_score']."</td>".
                             "<td>".$d1['handicap']."</td>".
                             "<td>".$d1['final_score']."</td>".
                             "</tr>";
                        
                        $pos = $pos + 1;  

                    };  

                    echo "</table>";  
                } 

                catch (PDOException $e) {    

                    print "Error!: " . $e->getMessage() . "<br/>";
                    die();

                } 

                ?>

            </div>

            <div class="col-xs-4">
                <h2>Day 2</h2>
                <?php 
                try 
                {   
                    $db = new PDO("mysql:host=localhost; dbname=canaan", 'root', 'root'); 
                    $day2 = $db->query('SELECT * FROM tmp
                                                WHERE tournament_id = 4
                                                  AND round_id = 2
                                             ORDER BY final_score, gross_score;');
                    $db = NULL;
                    $pos = 1;

                    echo "<table class=\"table table-striped\">".
                         "<tr>".
                             "<th>#</th>".
                             "<th>Player</th>".
                             "<th>Gross</th>".
                             "<th>H-cap</th>".
                             "<th>Final</th>".
                         "</tr>";

                    while ($d2 = $day2->fetch()) {
                        
                        echo "<tr>".
                             "<td>".$pos."</td>".
                             "<td>".$d2['player_name']."</td>".
                             "<td>".$d2['gross_score']."</td>".
                             "<td>".$d2['handicap']."</td>".
                             "<td>".$d2['final_score']."</td>".
                             "</tr>";
                        
                        $pos = $pos + 1;  

                    };  

                    echo "</table>";  
                } 

                catch (PDOException $e) {    

                    print "Error!: " . $e->getMessage() . "<br/>";
                    die();

                } 

                ?>

            </div>

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
            </div>
        </div>
    </div>
</div> 
<!-- End Footer -->






</body> 
<!-- end body-->
</html> <!-- end html-->