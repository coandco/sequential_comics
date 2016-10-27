<html>
<head>
<title><?php print($comicname);?> archives</title>
</head>
<?php
if (!isset($backcolor))
{
  $backcolor = "black";
}

print '<body bgcolor="' . $backcolor . '">' . "\n";
print '<div align="center">' . "\n";

if (!$archivestart)
{
  $archivestart = "0";
}

//print_r($files);
if ($_GET['p'] != '')
{
  $startpage = $_GET['p'];
}
else
{
  $startpage = '1';
}

$filelist = scandir("./");
$filelist = preg_grep("/$filetype/", $filelist);
$uniqlen = strlen($fileprefix) + $padamount;
$filterlist = array_map(function($x) use($uniqlen) {return substr($x,0,$uniqlen);}, $filelist);
$numcomics = count(array_unique($filterlist));

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
  $files = preg_grep("/$fileprefix$padded/",$filelist); 

  print "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
  print "  <tr>\n";
  print "    <td bgcolor=\"black\" align=\"center\">\n";
  print "      <font color=\"white\"><b>$comicname #$currentcomic</b></font>\n";
  print "    </td>\n";
  print "  </tr>\n";
  print "  <tr>\n";
  print "    <td align=\"center\">\n";

  foreach ($files as $file)
  {
    print "      <img src=\"" . $file . "\" /><br />\n";
  }

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
