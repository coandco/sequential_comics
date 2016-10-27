<html>
<head>
<title><?php print($comicname);?> archives</title>
</head>
<body>
<div align="center">
<?php

if (!$archivestart)
{
  $archivestart = "0";
}


$files = scandir("./");
$files = preg_grep("/$filetype/",$files); 
$numcomics = count($files);

//print_r($files);
if ($_GET['p'] != '')
{
  $startpage = $_GET['p'];
}
else
{
 $startpage = '1';
}

print '<a href="index.php?p=1">First Page</a> ';

if ($startpage > 1)
{
  print "<a href=\"index.php?p=" . ($startpage - 1) . "\">Previous Page</a> ";
}

if ($archivename != "")
{
  print "<a href=\"../../archives/$archivename/\">Continue to dated strips</a> ";
}

if ($startpage < ceil($numcomics/$perpage))
{
  print "<a href=\"index.php?p=" . ($startpage + 1) . "\">Next Page</a>";
}

print ' <a href="index.php?p=' . ceil($numcomics/$perpage) . '">Last Page</a>';
print "<br />\n";

$currentcomic = ((($startpage - 1) * $perpage) + 1) + $archivestart;

for ($i = 1; $i <= $perpage; $i++)
{
  if ($currentcomic > ($numcomics + $archivestart))
  {
    break;
  }
  $padded = sprintf("%0" . $padamount . "d", $currentcomic);
  print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
  print "  <tr>\n";
#  print "    <td bgcolor=\"black\" align=\"center\">\n";
#  print "      <font color=\"white\"><b>$comicname #$currentcomic</b></font>\n";
#  print "    </td>\n";
  print "  </tr>\n";
  print "  <tr>\n";
  print "    <td align=\"center\">\n";
  print "      <img src=\"" . $fileprefix . $padded . "." . $filetype . "\" />\n";
  print "    </td>\n";
  print "  </tr>\n";
  print "</table>\n";
  print "<br />\n";
  
  $currentcomic = $currentcomic + 1;
}

print "<br />\n";
print '<a href="index.php?p=1">First Page</a> ';

if ($startpage > 1)
{
  print "<a href=\"index.php?p=" . ($startpage - 1) . "\">Previous Page</a> ";
}

if ($archivename != "")
{
  print "<a href=\"../../archives/$archivename/\">Continue to dated strips</a> ";
}

if ($startpage < ceil($numcomics/$perpage))
{
  print "<a href=\"index.php?p=" . ($startpage + 1) . "\">Next Page</a>";
}

print ' <a href="index.php?p=' . ceil($numcomics/$perpage) . '">Last Page</a>';
print "<br />\n";

?>
</div>
</body>
</html>
