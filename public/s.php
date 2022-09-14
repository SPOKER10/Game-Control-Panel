<?php
mysql_connect("193.203.39.73","linkmania_panel","tF2gEfEZGsVkgVME");@mysql_select_db("linkmania215") or die( "Unable to select database. Be sure the databasename exists and online is.");$query="SELECT * FROM clanwar";$result=mysql_query($query);header('Content-Type: image/png;');$im = @imagecreatefromjpeg('assets/images/map_full.jpg');
for($x = 0; $x < 30; $x++) { $xd = mysql_result($result,$x,"PosX")/3.9;$y = mysql_result($result,$x,"PosY")/3.9;$xd = $xd + 768;$y = -($y - 768);$icon = imagecreatefromgif('ca.gif');imagecopyresized($im,$icon,$xd,$y,0,0,31,31,16,16); }
imagepng($im);imagedestroy($im);mysql_close();
?>