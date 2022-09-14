<?php
mysql_connect("193.203.39.73","linkmania_panel","tF2gEfEZGsVkgVME");@mysql_select_db("linkmania215") or die( "Unable to select database. Be sure the databasename exists and online is.");
$query="SELECT * FROM livemap";$result=mysql_query($query);header('Content-Type: image/png;');$im = @imagecreatefromjpeg('assets/images/map_full.jpg');
for($x = 0; $x < 200; $x++)
{
	$xd = mysql_result($result,$x,"X")/4.9;
	$y = mysql_result($result,$x,"Y")/2.0;
	$s = mysql_result($result,$x,"Skin");
	$xd = $xd + 768;$y = -($y - 768);
	$icon = @imagecreatefrompng("assets/a/$s.png");
	imagecopyresized($im,$icon,$xd,$y,0,0,60,60,300,300);
}
imagepng($im);imagedestroy($im);mysql_close();
?>