<?php
mysql_connect("193.203.39.73","linkmania_panel","tF2gEfEZGsVkgVME");@mysql_select_db("linkmania215") or die( "Unable to select database. Be sure the databasename exists and online is.");$query="SELECT * FROM bpack";$result=mysql_query($query);header('Content-Type: image/png;');$im = @imagecreatefrompng('map.png');
imagefilledellipse($im, (mysql_result($result,0,"X")) / 7.5 + 400, -(mysql_result($result,0,"Y") / 7.5 - 400), 160, 160, imagecolorallocatealpha($im, 255, 0, 0, 50));
imagepng($im);imagedestroy($im);mysql_close();
?>