

var gross = "grossScore";
var grossDisp = "grossDisplay";
var hcapDisp = "hcapDisplay";
var netDisp = "netDisplay";
var player = "playerName";

var worstHolesArray = // worst holes id's (textboxes)
    ['wh_1'
    ,'wh_2'
    ,'wh_3'
    ,'wh_4'
    ,'wh_5'
    ,'wh_6' ];

var worstHolesLabelArray = // worst holes labels ()
    ['wl_1'
    ,'wl_2'
    ,'wl_3'
    ,'wl_4'
    ,'wl_5'
    ,'wl_6' ];

/* HELPER FUNCTIONS */
function set(id, val) {
    document.getElementById(id).value = val;
}

/* CALCULATION FUNCTIONS */
function calculateScore(adjustment) {
    if(!adjustment) {
        var score = document.getElementById(gross).value;
        set(grossDisp, score);
        set(hcapDisp, "0");
        set(netDisp, score);
    } else {
        var grossScore = document.getElementById(gross).value;
        var numToRemove = numHolesToRemove(grossScore);
        var handicap = calculateHandicap(numToRemove) + handicapAdjustment(grossScore);
        
        document.getElementById(grossDisp).value = grossScore;
        document.getElementById(hcapDisp).value = handicap;
        document.getElementById(netDisp).value = grossScore - handicap;

    }
}

function calculateHandicap(holes) {
    var ret = 0;
    var count = 0;
    var last = 0;
    var i = holes;
    while(i >= 1) {
        ret += parseInt(document.getElementById(worstHolesArray[count]).value);
        count++;
        i--;
    }
    if(i == 0.5) {
        ret += Math.ceil(parseInt(document.getElementById(worstHolesArray[count]).value) / 2);
    }
    return ret;
}

function handicapAdjustment(score) {
    var ret;
         if (score == 73 || score % 5 == 1) { ret = -2; } 
    else if (score == 74 || score % 5 == 2) { ret = -1; } 
    else if (score == 75 || score % 5 == 3) { ret =  0; } 
    else if (score % 5 == 4)                { ret =  1; } 
    else                                    { ret =  2; }
    return ret;
}

function numHolesToRemove(score) {
    var ret = 0;
         if(score <= 75) { ret = 0.5; } 
    else if(score <= 80) { ret = 1.0; } 
    else if(score <= 85) { ret = 1.5; } 
    else if(score <= 90) { ret = 2.0; } 
    else if(score <= 95) { ret = 2.5; } 
    else if(score <= 100) { ret = 3.0; } 
    else if(score <= 105) { ret = 3.5; } 
    else if(score <= 110) { ret = 4.0; } 
    else if(score <= 115) { ret = 4.5; } 
    else if(score <= 120) { ret = 5.0; } 
    else if(score <= 125) { ret = 5.5; } 
    else                  { ret = 6.0; }
    return ret;
}

function grossChanged() {
    var gScore = document.getElementById(gross).value;
    if (gScore <= 72) { // no handicap adjustment
        calculateScore(false);
    } else if (gScore <= 80) { // handicap adjust 0.5 or 1 hole
        displayWorstHoles(1);
    } else if (gScore <= 130) { // handicap adjust 1.5 to 6 holes
        displayWorstHoles(Math.ceil((gScore - 70) / 10));
    } else { // handicap adjust 6 holes
        displayWorstHoles(6);
    }
}

function displayWorstHoles(num) {
    for(i = 0; i < num; i++) {
        document.getElementById(worstHolesArray[i]).disabled = false;
        document.getElementById(worstHolesArray[i]).value = "";
        document.getElementById(worstHolesArray[i]).style.display = "inline";
        document.getElementById(worstHolesLabelArray[i]).style.display = "inline";
    }
    for(i = num; i < worstHolesArray.length; i++) {
        document.getElementById(worstHolesArray[i]).disabled = true;
        document.getElementById(worstHolesArray[i]).value = "";
        document.getElementById(worstHolesArray[i]).style.display = "none";
        document.getElementById(worstHolesLabelArray[i]).style.display = "none";
    }
    setFocus(num);
}

function setFocus(holes) {
    if(holes == 0) {
        document.getElementById(player).focus();
        document.getElementById(player).select();
    } else {
        document.getElementById(worstHolesArray[0]).focus();
        document.getElementById(worstHolesArray[0]).select();
    }
}

/*
function insertNewRound(allowed) {
    if (allowed) {
        
    }
}*/

function clear() {
    // set up page to calculate score
    document.getElementById(gross).value = "XX";
    document.getElementById(player).value = "name";
    // clear and remove worst holes text boxes
    displayWorstHoles(0);
    // clear display text boxes
    document.getElementById(grossDisp).value = "";
    document.getElementById(hcapDisp).value = "";
    document.getElementById(netDisp).value = "";
}