<?php
mysql_connect("193.203.39.73","linkmania_panel","tF2gEfEZGsVkgVME");@mysql_select_db("linkmania215") or die( "Unable to select database. Be sure the databasename exists and online is.");
$query="SELECT * FROM houses";$result=mysql_query($query);header('Content-Type: image/png;');$im = @imagecreatefromjpeg('assets/images/map_full.jpg');
for($x = 0; $x < 227; $x++) { $xd = mysql_result($result,$x,"EnterX")/3.9;$y = mysql_result($result,$x,"EnterY")/3.9;$xd = $xd + 768;$y = -($y - 768);if(mysql_result($result,$x,"HPrice") > 0 || mysql_result($result,$x,"Owner") == 'TheState' ? ($icon = imagecreatefromgif('v.gif')) : ($icon = imagecreatefromgif('s.gif')))imagecopyresized($im,$icon,$xd,$y,0,0,26,26,16,16); }
$query="SELECT * FROM business";$result=mysql_query($query);
for($x = 0; $x < 76; $x++) { $xd = mysql_result($result,$x,"EnterX")/3.9;$y = mysql_result($result,$x,"EnterY")/3.9;$xd = $xd + 768;$y = -($y - 768);if(mysql_result($result,$x,"BPrice") > 0 || mysql_result($result,$x,"Owner") == 'TheState' ? ($icon = imagecreatefromgif('a.gif')) : ($icon = imagecreatefrompng('x.png')))imagecopyresized($im,$icon,$xd,$y,0,0,26,26,16,16); }
$query="SELECT * FROM clans";$result=mysql_query($query);
for($x = 0; $x < 13; $x++) if(mysql_result($result,$x,"HQ") == 2) { $xd = mysql_result($result,$x,"ExtX")/3.9;$y = mysql_result($result,$x,"ExtY")/3.9;$xd = $xd + 768;$y = -($y - 768);$icon = imagecreatefromgif('cl.gif');imagecopyresized($im,$icon,$xd,$y,0,0,26,26,16,16); }
$xd = 1553.8625/3.9;$y = -1675.6571/3.9;$xd = $xd + 768;$y = -($y - 768);$icon = imagecreatefromgif('h.gif');imagecopyresized($im,$icon,$xd,$y,0,0,26,26,16,16);
$xd = 1043.5427/3.9;$y = 1011.9614/3.9;$xd = $xd + 768;$y = -($y - 768);$icon = imagecreatefromgif('h.gif');imagecopyresized($im,$icon,$xd,$y,0,0,26,26,16,16);
$xd = 2034.1545/3.9;$y = -1402.7700/3.9;$xd = $xd + 768;$y = -($y - 768);$icon = imagecreatefromgif('h.gif');imagecopyresized($im,$icon,$xd,$y,0,0,26,26,16,16);
$xd = 1768.8511/3.9;$y = -2021.0103/3.9;$xd = $xd + 768;$y = -($y - 768);$icon = imagecreatefromgif('h.gif');imagecopyresized($im,$icon,$xd,$y,0,0,26,26,16,16);
$xd = -329.6332/3.9;$y = 1536.7391/3.9;$xd = $xd + 768;$y = -($y - 768);$icon = imagecreatefromgif('h.gif');imagecopyresized($im,$icon,$xd,$y,0,0,26,26,16,16);
$xd = 865.2123/3.9;$y = -1634.9445/3.9;$xd = $xd + 768;$y = -($y - 768);$icon = imagecreatefromgif('h.gif');imagecopyresized($im,$icon,$xd,$y,0,0,26,26,16,16);
$xd = 1073.1022/3.9;$y = -345.0618/3.9;$xd = $xd + 768;$y = -($y - 768);$icon = imagecreatefromgif('h.gif');imagecopyresized($im,$icon,$xd,$y,0,0,26,26,16,16);
$xd = 2495.3015/3.9;$y = -1690.3706/3.9;$xd = $xd + 768;$y = -($y - 768);$icon = imagecreatefromgif('h.gif');imagecopyresized($im,$icon,$xd,$y,0,0,26,26,16,16);
$xd = 690.7156/3.9;$y = -1275.9753/3.9;$xd = $xd + 768;$y = -($y - 768);$icon = imagecreatefromgif('h.gif');imagecopyresized($im,$icon,$xd,$y,0,0,26,26,16,16);
$xd = 1124.2053/3.9;$y = -2036.8785/3.9;$xd = $xd + 768;$y = -($y - 768);$icon = imagecreatefromgif('h.gif');imagecopyresized($im,$icon,$xd,$y,0,0,26,26,16,16);
$xd = 2481.8521/3.9;$y = 1525.9922/3.9;$xd = $xd + 768;$y = -($y - 768);$icon = imagecreatefromgif('h.gif');imagecopyresized($im,$icon,$xd,$y,0,0,26,26,16,16);
$xd = 1457.5857/3.9;$y = 2773.3047/3.9;$xd = $xd + 768;$y = -($y - 768);$icon = imagecreatefromgif('h.gif');imagecopyresized($im,$icon,$xd,$y,0,0,26,26,16,16);
$xd = 1454.5293/3.9;$y = 750.7880/3.9;$xd = $xd + 768;$y = -($y - 768);$icon = imagecreatefromgif('h.gif');imagecopyresized($im,$icon,$xd,$y,0,0,26,26,16,16);
$xd = 1480.9657/3.9;$y = -1769.6687/3.9;$xd = $xd + 768;$y = -($y - 768);$icon = imagecreatefromgif('h.gif');imagecopyresized($im,$icon,$xd,$y,0,0,26,26,16,16);
imagepng($im);imagedestroy($im);mysql_close();
?>