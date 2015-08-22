<?php
/**
 * HumHub CMS - Edit Online Module
 *
 * PHP version >= 5.3
 *
 * @category  PHP
 * @package   hh_edit_online
 * @author    Andreas Holzer <palareas@gmail.com>
 * @copyright 2015 Andreas Holzer
 * @license   MIT
 * @link      http://web-crew.org
 */
session_start();
require_once('Login.php');


if (isset($_POST['Submit'])) {
    
if ($_REQUEST['filename']=="")

echo "<div class='attention'>Please enter a file name</div>";

else {

$filetype = $_REQUEST['filetype'];

if ($filetype=="HTML")

header('Location: newfile/createcontent.php?folder=' . $_REQUEST['folder'] . '&filename=' . $_REQUEST['filename'] . ".html" . '&filetype=' . $_REQUEST['filetype'] . '&location=' . $_GET['location']);

elseif ($filetype=="CSS")

header('Location: newfile/createcontent.php?folder=' . $_REQUEST['folder'] . '&filename=' . $_REQUEST['filename'] . ".css" . '&filetype=' . $_REQUEST['filetype'] . '&location=' . $_GET['location']);

elseif ($filetype=="PHP")

header('Location: newfile/createcontent.php?folder=' . $_REQUEST['folder'] . '&filename=' . $_REQUEST['filename'] . ".php" . '&filetype=' . $_REQUEST['filetype'] . '&location=' . $_GET['location']);

elseif ($filetype=="Javascript")

header('Location: newfile/createcontent.php?folder=' . $_REQUEST['folder'] . '&filename=' . $_REQUEST['filename'] . ".js" . '&filetype=' . $_REQUEST['filetype'] . '&location=' . $_GET['location']);

elseif ($filetype=="Other")

header('Location: newfile/createcontent.php?folder=' . $_REQUEST['folder'] . '&filename=' . $_REQUEST['filename'] . '&filetype=' . $_REQUEST['filetype'] . '&location=' . $_GET['location']);

}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create</title>

<link rel="stylesheet" type="text/css" href="css/style.css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){
	
$(".nav").click(function(){
    $("ul").toggle();
  });
  
$(document).click(function() {
    $("ul").hide();
});

$(".nav").click(function(e) {
    e.stopPropagation();
    return false;
}); 
  
});
</script>

</head>

<body>

<div id="navcontainer">


<div class="nav">ACTIONS</div>

<ul class="navpanel top">
<a href='create.php'><li class="first">Create File</li></a>
<a href='createdir.php'><li>Create Folder</li></a>
<a href='upload.php'><li>Upload File</li></a>
<a href='uploadzip.php'><li>Upload ZIP</li></a>
<a href='Logout.php'><li class="last">Logout</li></a>
</ul>

</div>

<div id="container">

<h2>Create</h2>

<div class="confirm">Filetype:</div>

<form class="edit" action="" method="post">

<select name="filetype">
  <option>HTML</option>
  <option>CSS</option>
  <option>PHP</option>
  <option>Javascript</option>
  <option>Other</option>
</select>

<div class="confirmsecond">Filename:</div>

<input type="text" class="filetype" name="filename" placeholder="Filename" />

<div class="confirmsecond">Location:</div>

<select name='folder'>

<?php

function ListFolder($path)
{
    //using the opendir function
    $dir_handle = @opendir($path) or die("Unable to open $path");
    
    //Leave only the lastest folder name
    $dirname = $path;
    
    //display the target folder.
    echo ("<option>$dirname\n</option>");
    while (false !== ($file = readdir($dir_handle))) 
    {
        if($file!="." && $file!="..")
        {
            if (is_dir($path."/".$file))
            {
                //Display a list of sub folders.
                ListFolder($path."/".$file);
            }
            else
            {
                //Display a list of files.

            }
        }
    }
    echo "</ul>\n";
    echo "</li>\n";
    
    //closing the directory
    closedir($dir_handle);
}

ListFolder("..");
?>

</select>

<input type="submit" class="filetype" name="Submit" value="Create">
</form>

<a class='return' href='index.php'>&larr; Back to root</a>

</div>

</body>
</html>
