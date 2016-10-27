<html>
<head>
<title><?php print($comicname);?> archives</title>
</head>
<body>
<div align="center">
<?php
$str = dirname($_SERVER['PHP_SELF']);
$arr = split('/', $str);
$num = count($arr) - 1;
$comicdir = $arr[$num];

$files = scandir("./");
$files = preg_grep("/$filetype/",$files); 
sort($files);
//print_r($files);


foreach($files as $comic)
{
  preg_match("/[0-9]+/", $comic, $comicnum);
  print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
  print "  <tr>\n";
  print "    <td bgcolor=\"black\" align=\"center\">\n";
  print "      <font color=\"white\"><b>$comicname #$comicnum[0]</b></font>\n";
  print "    </td>\n";
  print "  </tr>\n";
  print "  <tr>\n";
  print "    <td align=\"center\">\n";
  print "      <img src=\"" . $fileprefix . $comicnum[0] . "." . $filetype . "\" />\n";
  print "    </td>\n";
  print "  </tr>\n";
  print "</table>\n";
  print "<br />\n";
}

print "<br />\n";
print "<a href=\"../../archives/$comicdir/\">Continue to dated strips</a>\n";

?>
</div>

</body>
</html>
