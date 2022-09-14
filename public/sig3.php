<?php
$player_name=$_GET['player_name'];
mysql_connect("193.203.39.73", "linkmania_panel","tF2gEfEZGsVkgVME");@mysql_select_db("linkmania215") or die( "Unable to select database. Be sure the databasename exists and online is.");
$player_name = stripslashes($player_name);$player_name = mysql_real_escape_string($player_name);$result=mysql_query("SELECT * FROM players WHERE user='$player_name' LIMIT 1");
if(mysql_num_rows($result))
{
    $Hours=number_format(mysql_result($result,0,"HoursPlayed")/3600);$Mar=mysql_result($result,0,"Mar");$Warns=mysql_result($result,0,"Warns");$Score=mysql_result($result,0,"Score");$Ph=mysql_result($result,0,"PhoneNumber");$Rp=mysql_result($result,0,"RPoints");$Sc=mysql_result($result,0,"SkinID");$Rpd=$Score*3;header('Content-Type: image/png;');$im = @imagecreatefrompng('ph3.png');$text_color = imagecolorclosest($im, 255,255,255);$im2 = @imagecreatefrompng("assets/s/Skin_$Sc.png");imagecopyresized($im, $im2, -5, 135, 0, 0, 100, 160, imagesx($im2), imagesy($im2));imagettftext($im, 16, 0, 88, 23, imagecolorclosest($im, 0,0,0), 'assets/fonts/arc.otf', mysql_result($result,0,"user"));
    if(mysql_result($result,0,"Status") == 0) imagettftext($im, 12, 50, 10, 29, imagecolorallocate($im, 219,0,0), 'assets/fonts/arc.otf', "OFF"); else imagettftext($im, 12, 50, 10, 27, imagecolorallocate($im, 0,209,0), 'assets/fonts/arc.otf', "ON");
    imagettftext($im, 12, 0, 88, 48, $text_color, 'assets/fonts/arc.otf', "Level: $Score");
    imagettftext($im, 12, 0, 88, 64, $text_color, 'assets/fonts/arc.otf', "Respect: $Rp/$Rpd");
    imagettftext($im, 12, 0, 88, 80, $text_color, 'assets/fonts/arc.otf', "Hours Played: $Hours");
    imagettftext($im, 12, 0, 88, 96, $text_color, 'assets/fonts/arc.otf', $Ph == 0 ? ("Phone: No") : ("Phone: $Ph"));
    switch(mysql_result($result,0,"Job"))
    {
        case 0: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: Unemployed"); break;
        case 1: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: Detective"); break;
        case 2: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: Courier"); break;
        case 3: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: Farmer"); break;
        case 4: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: Trucker"); break;
        case 5: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: Pizza Boy"); break;
        case 6: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: Garbage Man"); break;
        case 7: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: Arms Dealer"); break;
        case 8: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: Drugs Dealer"); break;
        case 9: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: StuntMan"); break;
        case 10: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: Mechanic"); break;
        case 11: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: Miner"); break;
        case 12: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: Fisher"); break;
        case 13: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: Grass Mower"); break;
        case 14: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: Airport Worker"); break;
        case 15: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: Ammo Transporter"); break;
        case 16: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: Pilot"); break;
        case 17: imagettftext($im, 12, 0, 88, 112, $text_color, 'assets/fonts/arc.otf', "Job: Lawyer"); break;
    }
    $Rn = mysql_result($result,0,"Rank");
    switch(mysql_result($result,0,"Member"))
    {
        case 0: imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: Civilian"); break;
        case 1: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: Los Santos Police Department ($Rn2)"); break;
        case 19: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: Las Venturas Police Department ($Rn2)"); break;
        case 2: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: Federal Bureau of Investigations ($Rn2)"); break;
        case 3: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: National Guard ($Rn2)"); break;
        case 4: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: Paramedics Department LS ($Rn2)"); break;
        case 18: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: Paramedics Department LV ($Rn2)"); break;
        case 5: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: Taxi LS ($Rn2)"); break;
        case 16: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: Taxi LV ($Rn2)"); break;
        case 6: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: News Reporters ($Rn2)"); break;
        case 7: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: School Instructor LS ($Rn2)"); break;
        case 17: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: School Instructor LV ($Rn2)"); break;
        case 8: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: Hitman Agency ($Rn2)"); break;
        case 9: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: Grove Street ($Rn2)"); break;
        case 10: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: The Ballas Family ($Rn2)"); break;
        case 11: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: Camorra Family ($Rn2)"); break;
        case 12: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: Sicilian Mafia ($Rn2)"); break;
        case 13: imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: Mayor of San Andreas City"); break;
        case 14: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: Insomnia Racing Club ($Rn2)"); break;
        case 15: $Rn2 = $Rn == 10 ? ("Rank: Leader") : ("Rank: $Rn"); imagettftext($im, 12, 0, 88, 128, $text_color, 'assets/fonts/arc.otf', "Faction: Midnight Racers Club ($Rn2)"); break;
    }
    imagettftext($im, 12, 0, 88, 144, $text_color, 'assets/fonts/arc.otf', "Warns: $Warns/3");
    imagettftext($im, 12, 0, 88, 160, $text_color, 'assets/fonts/arc.otf', "Marriage: $Mar");
    imagepng($im);imagedestroy($im);
} else echo('Username is not in our database. Please try again.');
mysql_close();
?>